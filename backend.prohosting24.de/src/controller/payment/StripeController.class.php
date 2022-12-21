<?php


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class StripeController extends BaseController
{
    public function completed(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        \Stripe\Stripe::setApiKey($this->container->get('dependencyInjector')->getConfig()->getconfigvalue("stripe_secret"));

        $endpoint_secret = $this->container->get('dependencyInjector')->getConfig()->getconfigvalue("stripe_whsecret");
        $payload = @file_get_contents('php://input');
        if(!isset($_SERVER['HTTP_STRIPE_SIGNATURE'])){
            return $this->container->get('dependencyInjector')->getNewResponse()->getError($response, 400, "Invalid HTTP_STRIPE_SIGNATURE");
        }
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException | \Stripe\Exception\SignatureVerificationException $e) {
            return $this->container->get('dependencyInjector')->getNewResponse()->getError($response, 404, "Payment not found");
        }
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $paymentselect = $this->container->get('dependencyInjector')->getDatabase()->select("main_payments", [
                    "id",
                    "userid",
                    "amount",
                    "paymentid"
                ], [
                    "status" => 0,
                    "paymentid" => $session->id,
                ]);
                if (count($paymentselect) != 1) {
                    return $this->container->get('dependencyInjector')->getNewResponse()->getError($response, 200, "Payment not found");
                }
                $user = new User();
                $user->load_id($this->container->get('dependencyInjector')->getDatabase(), $paymentselect[0]["userid"]);
                $payment = new Payment($this->dedependencyInjector->getConfig(), $this->dedependencyInjector);
                $payment->finish('stripecheckout', $this->dependencyInjector->getDatabase(), ["id" => $paymentselect[0]["id"], "payer" => ""], $user,$this->dependencyInjector);
                break;
            default:
                return $this->container->get('dependencyInjector')->getNewResponse()->getError($response, 404, 'Received unknown event type');
        }
        return $this->container->get('dependencyInjector')->getNewResponse()->getResponse($response, 200, ["success"]);
    }
}
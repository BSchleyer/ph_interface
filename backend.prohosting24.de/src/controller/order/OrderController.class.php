<?php


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
class OrderController extends BaseController
{
    public function order(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        if(!isset($_POST["data"])){
            
            return $this->dependencyInjector->getNewResponse()->getError($response,400, $this->dependencyInjector->getLang()->getStringWithData("missingvariable",["data"]));
        }
        $orderData = json_decode($_POST["data"], true);
        
        if(!isset($orderData)){
            return $this->dependencyInjector->getNewResponse()->getError($response,400, $this->dependencyInjector->getLang()->getStringWithData("missingvariable",["data"]));
        }
        
        if(count($orderData) == 0 || !isset($orderData["products"]) || count($orderData["products"]) == 0){
            return $this->dependencyInjector->getNewResponse()->getError($response,400, $this->dependencyInjector->getLang()->getStringWithData("missingvariable",["data"]));
        }
        $order = new \PH24\order\Order($this->dependencyInjector, null);
        $order->setValue("id", Functions::gen_uuid());
        $order->setValue("userid", $this->dependencyInjector->getUser()->getValue("id"));
        $order->setValue("status", "orderCreated");
        $order->create();

        $order->createProducts($orderData["products"]);
        if($this->dependencyInjector->isFail()){
            return $this->dependencyInjector->getNewResponse()->getError($response, $this->dependencyInjector->getResponseCode(), $this->dependencyInjector->getMessage());
        }
        return $this->container->get('dependencyInjector')->getNewResponse()->getResponse($response, 200, ["id" => $order->getValue("id")]);
    }
    public function info(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $order = new \PH24\order\Order($this->dependencyInjector, $args["id"]);
        return $this->container->get('dependencyInjector')->getNewResponse()->getResponse($response, 200, []);
    }
}
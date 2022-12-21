<?php


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PublicVServerController extends BaseController
{
    public function getSpecialOffers(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $offerList = new \Ph24\service\SpecialOffer($this->dedependencyInjector, null);
        $offerList = $offerList->getAll(["start_on[<]" => Functions::getCurrentDatePGSQL(), "finish_on[>]" => Functions::getCurrentDatePGSQL()]);

        $offerListReturn = [];

        foreach ($offerList as $offer){
            $offerListReturn[] = $offer->getData();
        }

        return $this->container->get('dependencyInjector')->getNewResponse()->getResponse($response, 200, $offerListReturn);
    }
}
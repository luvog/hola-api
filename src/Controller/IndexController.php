<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class IndexController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/")
     */
    public function index(): Response
    {
        return $this->json([
            "service"   => "API Rest for Hola Test",
            "version"   => "0.0.0",
            "status"    => "OK",
            "path"      => "/",
            "controller"=> "IndexController",
            "action"    => "index"
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LoginController.php',
        ]);
    }

    /**
     * @Route("/api", name="api")
     */
    public function api(): Response
    {
        return $this->json([
            //'message' => sprintf('Logged in as %s', $this->getUser()->getUsername()),
            'path' => 'src/Controller/LoginController.php',
        ]);
    }
}

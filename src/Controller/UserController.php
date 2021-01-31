<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    /**
     * @Rest\Get("/user/{username}", name="user")
     */
    public function user(string $username, UserRepository $repository): Response
    {
        $user = $repository->findOneBy([
            'username' => $username,
        ]);
        if (is_null($user)) throw new NotFoundHttpException("User {$username} not found");
        return $this->json([
            'user' => [
                "id"        => $user->getId(),
                "name"      => $user->getName(),
                "username"  => $user->getUserName(),
                "roles"     => $user->getRoles()
            ],
            'path' => 'src/Controller/UserController.php',
        ]);
    }

    /**
     * @Rest\Put("/user", name="new_user")
     */
    public function new(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            $user = new User();
            $user->setName($data['name']);
            $user->setUsername($data['username']);
            $user->setPassword($data['password']);
            $user->setRoles($data['roles']);
        } catch(Exception $e) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json([
            'message' => "The user {$user->getName()} has been created",
            'user' => [
                "id"        => $user->getId(),
                "name"      => $user->getName(),
                "username"  => $user->getUserName(),
                "roles"     => $user->getRoles()
            ],
            'path' => 'src/Controller/UserController.php',
        ]);
    }
    
    /**
     * @Rest\Post("/user/{usermane}", name="update_user")
     */
    public function update(Request $request): Response
    {        
        try {
            $data = json_decode($request->getContent(), true);
            $user = new User();
            $user->setName($data['name']);
            $user->setUsername($data['username']);
            $user->setPassword($data['password']);
            $user->setRoles($data['roles']);
        } catch(Exception $e) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->json([
            'message' => "The user {$user->getName()} has been updated",
            'user' => [
                "id"        => $user->getId(),
                "name"      => $user->getName(),
                "username"  => $user->getUserName(),
                "roles"     => $user->getRoles()
            ],
            'path' => 'src/Controller/UserController.php',
        ]);
    }
    
    /**
     * @Rest\Delete("/user/{usermane}", name="delete_user")
     */
    public function delete(string $usermane, UserRepository $repository): Response
    {
        $user = $repository->findOneBy([
            'username' => $usermane,
        ]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->json([
            'message' => "The user {$user->getName()} has been deleted",
            'user' => [
                "id"        => $user->getId(),
                "name"      => $user->getName(),
                "username"  => $user->getUserName(),
                "roles"     => $user->getRoles()
            ],
            'path' => 'src/Controller/UserController.php',
        ]);
    }
}
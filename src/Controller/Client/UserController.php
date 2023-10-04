<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/monCompte', name: 'app_client_account')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_client_user_account')]
    public function index(): Response
    {
        return $this->render('client/user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}

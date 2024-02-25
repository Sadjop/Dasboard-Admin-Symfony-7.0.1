<?php
// src/Controller/ProfileController.php

namespace App\Controller;

use App\Entity\Favlist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {

        $user = $this->getUser();

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        // Passer les informations de l'utilisateur à la vue
        return $this->render('profile/index.html.twig', [
            'user'      => $user,
            'favlist'   => $user->getFavlists(),
        ]);
    }
}

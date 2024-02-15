<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class ErrorController
{
    public function accessDenied(): Response
    {
        return new Response('Accès refusé. Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.', 403);
    }
}


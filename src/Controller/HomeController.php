<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route(path: '/', name: 'app_index')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_store');
    }
}

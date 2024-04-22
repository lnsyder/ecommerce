<?php

namespace App\Controller;

use App\Entity\TblOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route(path: '/order', name: 'app_order')]
    public function index(): Response
    {
        $doctrine = $this->getDoctrine();
        $orders = $doctrine->getRepository(TblOrder::class)->findAll();

        return $this->render('order/index.html.twig', [
            'orders' => $orders ?? null,
        ]);
    }
}

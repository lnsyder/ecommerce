<?php

namespace App\Controller;

use App\Entity\LkpCategory;
use App\Entity\TblCart;
use App\Entity\TblCartProduct;
use App\Entity\TblProduct;
use App\Entity\TblProductCategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route('/store', name: 'app_store')]
    public function index(Request $request): Response
    {
        $doctrine = $this->getDoctrine();
        $products = $doctrine->getRepository(TblProduct::class)
            ->findAll();
        $categories = $doctrine->getRepository(LkpCategory::class)->findBy([], ['orderNumber' => 'ASC']);
        $cart = $doctrine->getRepository(TblCart::class)
            ->findOneBy(['user' => $this->getUser(), 'isActive' => 1]);

        if ($cart instanceof TblCart) {
            $cartProducts = $doctrine->getRepository(TblCartProduct::class)
                ->findBy(['user' => $this->getUser(), 'cart' => $cart]);
        }
        return $this->render('store/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'cartProducts' => $cartProducts ?? null,
            'cart' => $cart ?? null,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\TblCart;
use App\Entity\TblCartProduct;
use App\Entity\TblProduct;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CartController extends AbstractController
{
    /**
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return Response
     */
    #[Route('/cart/save', name: 'app_cart_save')]
    public function save(Request $request, ValidatorInterface $validator): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('You are not authorized to perform this action');
        }
        $data = json_decode($request->getContent(), true);

        $cart = $this->getDoctrine()->getRepository(TblCart::class)
            ->findOneBy(["user" => $this->getUser(), "isActive" => 1]);
        if ($cart instanceof TblCart) {
            $message = 'Cart updated successfully';
        } else {
            $cart = new TblCart();
            $message = 'Cart added successfully';
        }
        $cart->setUser($this->getUser());
        $cart->setCartDiscount(0);
        $cart->setIsActive(true);
        $errors = $validator->validate($cart);

        if (count($errors) > 0) {
            return new JsonResponse(['errors' => (string)$errors], Response::HTTP_BAD_REQUEST);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($cart);

        if (isset($data['cart_products'])) {
            foreach ($data['cart_products'] as $value) {
                $cartProduct = $this->getDoctrine()->getRepository(TblCartProduct::class)
                    ->findOneBy(['product' => $this->getDoctrine()->getRepository(TblProduct::class)
                        ->find($value['product_id']),
                        'cart' => $cart,
                        'user' => $this->getUser()]);
                if (!isset($cartProduct)) {
                    $cartProduct = new TblCartProduct();
                    $cartProduct->setProduct($this->getDoctrine()->getRepository(TblProduct::class)
                        ->find($value['product_id']));
                    $cartProduct->setCart($cart);
                }
                $cartProduct->setUser($this->getUser());
                $productQuantity = (int)$value['product_quantity'];
                $cartProduct->setProductQuantity($productQuantity);
                $em->persist($cartProduct);
            }
        }

        $em->flush();

        return new JsonResponse(['message' => $message], Response::HTTP_OK);
    }
}

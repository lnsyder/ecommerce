<?php

namespace App\Controller;

use App\Entity\LkpPaymentMethod;
use App\Entity\TblCart;
use App\Entity\TblCartProduct;
use App\Entity\TblOrder;
use App\Entity\TblOrderProduct;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CheckoutController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route(path: '/checkout', name: 'app_checkout')]
    public function index(): Response
    {
        $doctrine = $this->getDoctrine();
        $paymentMethods = $doctrine->getRepository(LkpPaymentMethod::class)->findAll();
        $cart = $doctrine->getRepository(TblCart::class)
            ->findOneBy(['user' => $this->getUser(), 'isActive' => true]);
        if ($cart instanceof TblCart) {
            $cartProducts = $doctrine->getRepository(TblCartProduct::class)
                ->findBy(['user' => $this->getUser(), 'cart' => $cart]);
        }
        $totalPrice = 0;
        foreach ($cartProducts as $cartProduct) {
            $totalPrice += $cartProduct->getProduct()->getProductPrice();
        }

        return $this->render('checkout/index.html.twig', [
            'paymentMethods' => $paymentMethods,
            'cartProducts' => $cartProducts ?? null,
            'cart' => $cart ?? null,
            'totalPrice' => $totalPrice
        ]);
    }

    #[Route(path: '/checkout/payment', name: 'app_checkout_payment')]
    public function checkout(Request $request, ValidatorInterface $validator): Response
    {
        $data = json_decode($request->getContent(), true);

        $doctrine = $this->getDoctrine();
        $cart = $doctrine->getRepository(TblCart::class)
            ->findOneBy(['user' => $this->getUser(), 'isActive' => true]);

        if ($cart instanceof TblCart) {

            $cartProducts = $doctrine->getRepository(TblCartProduct::class)
                ->findBy(['user' => $this->getUser(), 'cart' => $cart]);
            $amount = 0.00;
            foreach ($cartProducts as $cartProduct) {
                $amount += $cartProduct->getProduct()->getProductPrice();
            }

            $paymentMethodId = $data['payment_method_id'];
            $paymentMethod = $doctrine->getRepository(LkpPaymentMethod::class)->find($paymentMethodId);

            if ($paymentMethod instanceof LkpPaymentMethod) {
                $adapterClassName = 'App\\Adapter\\' . $paymentMethod->getPaymentMethodClassName();

                if (class_exists($adapterClassName)) {

                    $adapter = new $adapterClassName();

                    $initiateResult = $adapter->initiatePayment($amount);
                    if ($initiateResult) {
                        $validationResult = $adapter->validatePayment($amount);
                        if ($validationResult) {
                            $completeResult = $adapter->completePayment();
                            if ($completeResult) {
                                $em = $this->getDoctrine()->getManager();

                                $cart->setIsActive(false);
                                $em->persist($cart);

                                $order = new TblOrder();
                                $order->setCart($cart);
                                $order->setUser($this->getUser());
                                $order->setOrderPrice($amount);
                                $order->setPaymentMethod($paymentMethod);
                                $order->setOrderStatus(true);
                                $em->persist($order);

                                foreach ($cartProducts as $cartProduct) {
                                    $orderProduct = new TblOrderProduct();
                                    $orderProduct->setOrder($order);
                                    $orderProduct->setProduct($cartProduct->getProduct());
                                    $em->persist($orderProduct);
                                }

                                $em->flush();

                                return new JsonResponse(['message' => 'Payment completed successfully'], Response::HTTP_OK);
                            }
                        }
                    }
                }
            }
        }
        return new JsonResponse(['message' => 'Payment failed'], Response::HTTP_OK);
    }
}

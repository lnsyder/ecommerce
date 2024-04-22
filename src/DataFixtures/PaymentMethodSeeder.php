<?php

namespace App\DataFixtures;

use App\Entity\LkpPaymentMethod;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PaymentMethodSeeder extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $paymentMethod = new LkpPaymentMethod();
        $paymentMethod->setPaymentMethodName('Cash on Delivery');
        $paymentMethod->setPaymentMethodClassName('CashOnDeliveryAdapter');
        $manager->persist($paymentMethod);

        $paymentMethod = new LkpPaymentMethod();
        $paymentMethod->setPaymentMethodName('Paypal');
        $paymentMethod->setPaymentMethodClassName('PaypalAdapter');
        $manager->persist($paymentMethod);

        $manager->flush();

    }
}

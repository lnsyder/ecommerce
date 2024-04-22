<?php

namespace App\Adapter;

class CashOnDeliveryAdapter implements PaymentMethodAdapterInterface
{
    /**
     * @param float $amount
     * @return bool
     */
    public function initiatePayment(float $amount): bool
    {
        return true;
    }

    /**
     * @param float $amount
     * @return bool
     */
    public function validatePayment(float $amount): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function completePayment(): bool
    {
        return true;
    }
}

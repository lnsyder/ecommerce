<?php

namespace App\Adapter;

interface PaymentMethodAdapterInterface
{
    /**
     * @param float $amount
     * @return bool
     */
    public function initiatePayment(float $amount): bool;

    /**
     * @param float $amount
     * @return bool
     */
    public function validatePayment(float $amount): bool;

    /**
     * @return bool
     */
    public function completePayment(): bool;
}

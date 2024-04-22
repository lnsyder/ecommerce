<?php

namespace App\Entity;

use App\Repository\LkpPaymentMethodRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LkpPaymentMethodRepository::class)]
class LkpPaymentMethod
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: "bigint")]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $paymentMethodName;

    #[ORM\Column(length: 255)]
    private string $paymentMethodClassName;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPaymentMethodName(): string
    {
        return $this->paymentMethodName;
    }

    /**
     * @param string $paymentMethodName
     * @return void
     */
    public function setPaymentMethodName(string $paymentMethodName): void
    {
        $this->paymentMethodName = $paymentMethodName;
    }

    /**
     * @return string
     */
    public function getPaymentMethodClassName(): string
    {
        return $this->paymentMethodClassName;
    }

    /**
     * @param string $paymentMethodClassName
     * @return void
     */
    public function setPaymentMethodClassName(string $paymentMethodClassName): void
    {
        $this->paymentMethodClassName = $paymentMethodClassName;
    }
}

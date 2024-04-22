<?php

namespace App\Entity;

use App\Repository\TblOrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TblOrderRepository::class)]
class TblOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: TblUser::class)]
    private TblUser $user;

    #[ORM\ManyToOne(targetEntity: TblCart::class)]
    private TblCart $cart;

    #[ORM\ManyToOne(targetEntity: LkpPaymentMethod::class)]
    private LkpPaymentMethod $paymentMethod;

    #[Assert\Type(type: 'float')]
    #[ORM\Column(nullable: false)]
    private ?int $orderPrice;

    #[ORM\Column(type: 'boolean', nullable: false, options: ["default" => false])]
    private bool $orderStatus;

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
     * @return TblUser
     */
    public function getUser(): TblUser
    {
        return $this->user;
    }

    /**
     * @param TblUser $user
     * @return void
     */
    public function setUser(TblUser $user): void
    {
        $this->user = $user;
    }

    /**
     * @return TblCart
     */
    public function getCart(): TblCart
    {
        return $this->cart;
    }

    /**
     * @param TblCart $cart
     * @return void
     */
    public function setCart(TblCart $cart): void
    {
        $this->cart = $cart;
    }

    /**
     * @return LkpPaymentMethod
     */
    public function getPaymentMethod(): LkpPaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @param LkpPaymentMethod $paymentMethod
     * @return void
     */
    public function setPaymentMethod(LkpPaymentMethod $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return int|null
     */
    public function getOrderPrice(): ?int
    {
        return $this->orderPrice;
    }

    /**
     * @param int|null $orderPrice
     * @return void
     */
    public function setOrderPrice(?int $orderPrice): void
    {
        $this->orderPrice = $orderPrice;
    }

    /**
     * @return bool
     */
    public function isOrderStatus(): bool
    {
        return $this->orderStatus;
    }

    /**
     * @param bool $orderStatus
     * @return void
     */
    public function setOrderStatus(bool $orderStatus): void
    {
        $this->orderStatus = $orderStatus;
    }
}

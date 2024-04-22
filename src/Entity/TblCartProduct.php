<?php

namespace App\Entity;

use App\Repository\TblCartProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TblCartProductRepository::class)]
class TblCartProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: TblUser::class)]
    private TblUser $user;

    #[ORM\ManyToOne(targetEntity: TblProduct::class)]
    private TblProduct $product;

    #[ORM\ManyToOne(targetEntity: TblCart::class)]
    private TblCart $cart;

    #[Assert\Type(type: 'int')]
    #[ORM\Column(nullable: true)]
    private ?int $productDiscount;

    #[Assert\Type(type: 'int')]
    #[ORM\Column(nullable: false)]
    private int $productQuantity;

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
     * @return TblProduct
     */
    public function getProduct(): TblProduct
    {
        return $this->product;
    }

    /**
     * @param TblProduct $product
     * @return void
     */
    public function setProduct(TblProduct $product): void
    {
        $this->product = $product;
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
     * @return int|null
     */
    public function getProductDiscount(): ?int
    {
        return $this->productDiscount;
    }

    /**
     * @param int|null $productDiscount
     * @return void
     */
    public function setProductDiscount(?int $productDiscount): void
    {
        $this->productDiscount = $productDiscount;
    }

    /**
     * @return int
     */
    public function getProductQuantity(): int
    {
        return $this->productQuantity;
    }

    /**
     * @param int $productQuantity
     * @return void
     */
    public function setProductQuantity(int $productQuantity): void
    {
        $this->productQuantity = $productQuantity;
    }
}

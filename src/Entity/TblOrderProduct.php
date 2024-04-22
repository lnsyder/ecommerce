<?php

namespace App\Entity;

use App\Repository\TblOrderProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TblOrderProductRepository::class)]
class TblOrderProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: TblUser::class)]
    private TblUser $user;

    #[ORM\ManyToOne(targetEntity: TblOrder::class)]
    private TblOrder $order;

    #[ORM\ManyToOne(targetEntity: TblProduct::class)]
    private TblProduct $product;

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
     * @return TblOrder
     */
    public function getOrder(): TblOrder
    {
        return $this->order;
    }

    /**
     * @param TblOrder $order
     * @return void
     */
    public function setOrder(TblOrder $order): void
    {
        $this->order = $order;
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
}

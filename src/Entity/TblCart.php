<?php

namespace App\Entity;

use App\Repository\TblCartRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TblCartRepository::class)]
class TblCart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: TblUser::class)]
    private TblUser $user;

    #[Assert\Type(type: 'int')]
    #[ORM\Column(nullable: true)]
    private ?int $cartDiscount;

    #[ORM\Column(type: 'boolean', nullable: false, options: ["default" => true])]
    private bool $isActive = true;

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
     * @return int
     */
    public function getCartDiscount(): int
    {
        return $this->cartDiscount;
    }

    /**
     * @param int $cartDiscount
     * @return void
     */
    public function setCartDiscount(int $cartDiscount): void
    {
        $this->cartDiscount = $cartDiscount;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return void
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }
}

<?php

namespace App\Entity;

use App\Repository\TblProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TblProductRepository::class)]
class TblProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    private string $productName;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $productCode = null;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $productDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $productImage = null;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'float')]
    #[ORM\Column]
    private float $productPrice;

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
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     * @return void
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return string|null
     */
    public function getProductCode(): ?string
    {
        return $this->productCode;
    }

    /**
     * @param string|null $productCode
     * @return void
     */
    public function setProductCode(?string $productCode): void
    {
        $this->productCode = $productCode;
    }

    /**
     * @return string|null
     */
    public function getProductDescription(): ?string
    {
        return $this->productDescription;
    }

    /**
     * @param string|null $productDescription
     * @return void
     */
    public function setProductDescription(?string $productDescription): void
    {
        $this->productDescription = $productDescription;
    }

    /**
     * @return string|null
     */
    public function getProductImage(): ?string
    {
        return $this->productImage;
    }

    /**
     * @param string|null $productImage
     * @return void
     */
    public function setProductImage(?string $productImage): void
    {
        $this->productImage = $productImage;
    }

    /**
     * @return float
     */
    public function getProductPrice(): float
    {
        return $this->productPrice;
    }

    /**
     * @param float $productPrice
     * @return void
     */
    public function setProductPrice(float $productPrice): void
    {
        $this->productPrice = $productPrice;
    }
}

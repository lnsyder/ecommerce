<?php

namespace App\Entity;

use App\Repository\TblProductCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TblProductCategoryRepository::class)]
class TblProductCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: TblProduct::class)]
    private TblProduct $product;

    #[ORM\ManyToOne(targetEntity: LkpCategory::class)]
    private LkpCategory $category;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
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
     * @return LkpCategory
     */
    public function getCategory(): LkpCategory
    {
        return $this->category;
    }

    /**
     * @param LkpCategory $category
     * @return void
     */
    public function setCategory(LkpCategory $category): void
    {
        $this->category = $category;
    }
}

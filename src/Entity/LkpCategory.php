<?php

namespace App\Entity;

use App\Repository\LkpCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LkpCategoryRepository::class)]
class LkpCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: "bigint")]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $categoryName;

    #[ORM\ManyToOne(targetEntity: LkpCategory::class)]
    private ?LkpCategory $parentCategory = null;

    #[ORM\Column]
    private int $orderNumber;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * @param string $categoryName
     * @return void
     */
    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    /**
     * @return LkpCategory|null
     */
    public function getParentCategory(): ?LkpCategory
    {
        return $this->parentCategory;
    }

    /**
     * @param LkpCategory|null $parentCategory
     * @return void
     */
    public function setParentCategory(?LkpCategory $parentCategory): void
    {
        $this->parentCategory = $parentCategory;
    }

    /**
     * @return int
     */
    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    /**
     * @param int $orderNumber
     */
    public function setOrderNumber(int $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getCategoryName();
    }
}

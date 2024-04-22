<?php

namespace App\DataFixtures;

use App\Entity\LkpCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorySeeder extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $lkpCategoryRepository = $manager->getRepository(LkpCategory::class);
        $category = new LkpCategory();
        $category->setCategoryName('Men');
        $category->setOrderNumber(1);
        $manager->persist($category);

        $category = new LkpCategory();
        $category->setCategoryName('Women');
        $category->setOrderNumber(1);
        $manager->persist($category);

        $manager->flush();

        $category = new LkpCategory();
        $category->setCategoryName('Pants');
        $category->setOrderNumber(1);
        $category->setParentCategory($lkpCategoryRepository
            ->findOneBy(['categoryName' => 'Men']));
        $manager->persist($category);

        $category = new LkpCategory();
        $category->setCategoryName('T-Shirts');
        $category->setOrderNumber(2);
        $category->setParentCategory($lkpCategoryRepository
            ->findOneBy(['categoryName' => 'Men']));
        $manager->persist($category);

        $category = new LkpCategory();
        $category->setCategoryName('Shoes');
        $category->setOrderNumber(3);
        $category->setParentCategory($lkpCategoryRepository
            ->findOneBy(['categoryName' => 'Men']));
        $manager->persist($category);

        $category = new LkpCategory();
        $category->setCategoryName('Coats');
        $category->setOrderNumber(4);
        $category->setParentCategory($lkpCategoryRepository
            ->findOneBy(['categoryName' => 'Men']));
        $manager->persist($category);

        $category = new LkpCategory();
        $category->setCategoryName('Pants');
        $category->setOrderNumber(1);
        $category->setParentCategory($lkpCategoryRepository
            ->findOneBy(['categoryName' => 'Women']));
        $manager->persist($category);

        $category = new LkpCategory();
        $category->setCategoryName('T-Shirts');
        $category->setOrderNumber(2);
        $category->setParentCategory($lkpCategoryRepository
            ->findOneBy(['categoryName' => 'Women']));
        $manager->persist($category);

        $category = new LkpCategory();
        $category->setCategoryName('Shoes');
        $category->setOrderNumber(3);
        $category->setParentCategory($lkpCategoryRepository
            ->findOneBy(['categoryName' => 'Women']));
        $manager->persist($category);

        $category = new LkpCategory();
        $category->setCategoryName('Coats');
        $category->setOrderNumber(4);
        $category->setParentCategory($lkpCategoryRepository
            ->findOneBy(['categoryName' => 'Women']));
        $manager->persist($category);

        $manager->flush();

    }
}

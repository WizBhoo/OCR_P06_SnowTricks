<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class CategoryFixtures.
 */
class CategoryFixtures extends Fixture
{
    public const CATEGORY_REFERENCE_PREFIX = 'category_';

    /**
     * Load fixtures in Category table
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 4; $i++) {
            $category = new Category();
            $category->setName('category '.$i);
            $manager->persist($category);
            $this->addReference(self::CATEGORY_REFERENCE_PREFIX.$i, $category);
        }

        $manager->flush();
    }
}

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
        for ($cat = 1; $cat < 4; $cat++) {
            $category = new Category();
            $category->setName('category '.$cat);
            $manager->persist($category);
            $this->addReference(self::CATEGORY_REFERENCE_PREFIX.$cat, $category);
        }

        $manager->flush();
    }
}

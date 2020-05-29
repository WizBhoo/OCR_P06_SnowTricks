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
    /**
     * A prefix reference constant for Category
     *
     * @var string
     */
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
        $category = new Category();
        $category->setName('Grab');
        $manager->persist($category);
        $this->addReference(self::CATEGORY_REFERENCE_PREFIX.'1', $category);

        $category = new Category();
        $category->setName('Flip');
        $manager->persist($category);
        $this->addReference(self::CATEGORY_REFERENCE_PREFIX.'2', $category);

        $category = new Category();
        $category->setName('Rotation');
        $manager->persist($category);
        $this->addReference(self::CATEGORY_REFERENCE_PREFIX.'3', $category);

        $manager->flush();
    }
}

<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class ImageFixtures.
 */
class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Load fixtures in Image table
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 16; $i++) {
            $image = new Image();
            $image->setPath('https://loremflickr.com/320/240');
            if ($i&1) {
                $image->setPrimary('true');
            } else {
                $image->setPrimary('false');
            }
            $image->setFigure(
                    $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.$i)
            );

            $manager->persist($image);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            FigureFixtures::class,
        ];
    }
}

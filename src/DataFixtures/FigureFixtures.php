<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\DataFixtures;

use App\Entity\Figure;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class FigureFixtures.
 */
class FigureFixtures extends Fixture implements DependentFixtureInterface
{
    public const FIGURE_REFERENCE_PREFIX = 'figure_';

    /**
     * Load fixtures in Figure table
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 16; $i++) {
            $figure = new Figure();
            $figure
                ->setSlug('slug'.$i)
                ->setName('figure '.$i)
                ->setDescription(
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue elit sed massa 
                    consequat, quis cursus lectus vulputate. Integer ut luctus lectus. Mauris imperdiet sit amet mi a 
                    placerat. Maecenas.'
                )
                ->setCreatedAt(new DateTime())
                ->setSnowboarder(
                    $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'1')
                )
            ;
            if ($i < 6) {
                $figure->setCategory(
                    $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
                );
            } elseif ($i > 5 && $i < 11) {
                $figure->setCategory(
                    $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'2')
                );
            } elseif ($i > 10) {
                $figure->setCategory(
                    $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'3')
                );
            }

            $manager->persist($figure);
            $this->addReference(self::FIGURE_REFERENCE_PREFIX.$i, $figure);
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
            CategoryFixtures::class,
            SnowboarderFixtures::class,
        ];
    }
}

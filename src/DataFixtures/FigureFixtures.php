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
        for ($fig = 1; $fig < 16; $fig++) {
            $figure = new Figure();
            $figure
                ->setSlug('slug' .$fig)
                ->setName('figure '.$fig)
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
            if ($fig < 6) {
                $figure->setCategory(
                    $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
                );
            } elseif ($fig > 5 && $fig < 11) {
                $figure->setCategory(
                    $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'2')
                );
            } elseif ($fig > 10) {
                $figure->setCategory(
                    $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'3')
                );
            }

            $manager->persist($figure);
            $this->addReference(self::FIGURE_REFERENCE_PREFIX.$fig, $figure);
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
        return array(
            CategoryFixtures::class,
            SnowboarderFixtures::class,
        );

    }
}

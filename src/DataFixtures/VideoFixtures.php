<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class VideoFixtures.
 */
class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Load fixtures in Category table
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        for ($vid = 1; $vid < 16; $vid++) {
            $video = new Video();
            $video
                ->setUrl('video'.$vid)
                ->setFigure(
                    $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.$vid)
                )
            ;

            $manager->persist($video);
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
            FigureFixtures::class,
        );

    }
}

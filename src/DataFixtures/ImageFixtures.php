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
        $image = new Image();
        $image
            ->setPath('nose.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('mute.jpg')
            ->setPrimary(false)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'2')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('mute2.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'2')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('indy.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'3')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('indy2.jpg')
            ->setPrimary(false)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'3')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('tail.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'4')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('melon.jpg')
            ->setPrimary(false)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'5')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('melon2.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'5')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('stalefish.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'6')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('method.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'7')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('japan.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'8')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('seatbelt.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'9')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('truckdriver.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'10')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('chicken-salad.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'11')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('backflip.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'12')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('frontflip.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'13')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('180-1.jpg')
            ->setPrimary(false)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'14')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('180.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'14')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('180-2.jpg')
            ->setPrimary(false)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'14')
            )
        ;
        $manager->persist($image);

        $image = new Image();
        $image
            ->setPath('360.jpg')
            ->setPrimary(true)
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'15')
            )
        ;
        $manager->persist($image);

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

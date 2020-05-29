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
        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/gZFWW4Vus-Q')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/n2qAIqvXhgM')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/M5NTCfdObfs')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'2')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/k6aOWf0LDcQ')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'2')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/6yA3XqjTh_w')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'3')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/iKkhKekZNQ8')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'3')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/_Qq-YoXwNQY')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'4')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/lVMp6nIWhIg')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'4')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/OMxJRz06Ujc')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'5')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/51sQRIK-TEI')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'5')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/f9FjhCt_w2U')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'6')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/f0PyFsOcnIw')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'6')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/_hxLS2ErMiY')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'7')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/TxUQunZw2ds')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'7')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/CzDjM7h_Fwo')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'8')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/I7N45iRPrhw')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'8')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/4vGEOYNGi_c')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'9')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/eTx2uVcbLzM')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'9')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/b4cGHrDWQSk')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'10')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/CA5bURVJ5zk')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'10')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/TTgeY_XCvkQ')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'11')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/9rIWDl8QcUY')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'11')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/AMsWP9WJS_0')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'12')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/arzLq-47QFA')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'12')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/xhvqu2XBvI0')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'13')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/eGJ8keB1-JM')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'13')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/ATMiAVTLsuc')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'14')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/Hb-X84nrNig')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'14')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/hUddT6FGCws')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'15')
            )
        ;
        $manager->persist($video);

        $video = new Video();
        $video
            ->setUrl('https://www.youtube.com/embed/H0Izq1fAM5w')
            ->setFigure(
                $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'15')
            )
        ;
        $manager->persist($video);

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

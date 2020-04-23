<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\DataFixtures;

use App\Entity\Comment;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class CommentFixtures.
 */
class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Load fixtures in Comment table
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 11; $i++) {
            $comment = new Comment();
            $comment
                ->setContent(
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Fusce varius at ligula nec sollicitudin. Morbi est magna, vestibulum ac volutpat.'
                )
                ->setCreatedAt(new DateTime())
            ;
            if ($i < 6) {
                $comment->setFigure(
                    $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'5')
                );
            } elseif ($i > 5) {
                $comment->setFigure(
                    $this->getReference(FigureFixtures::FIGURE_REFERENCE_PREFIX.'10')
                );
            }
            $comment->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'2')
            );

            $manager->persist($comment);
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
            SnowboarderFixtures::class,
        ];
    }
}

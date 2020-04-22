<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\DataFixtures;

use App\Entity\Snowboarder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class SnowboarderFixtures.
 */
class SnowboarderFixtures extends Fixture
{
    public const SNOWBOARDER_REFERENCE_PREFIX = 'snowboarder_';

    /**
     * Load fixtures in Snowboarder table
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        for ($snow = 1; $snow < 4; $snow++) {
            $snowboarder = new Snowboarder();
            $snowboarder
                ->setLastName('nom '.$snow)
                ->setFirstName('prenom '.$snow)
                ->setPseudo('goldfish'.$snow)
                ->setEmail('demo'.$snow.'@snowtricks.com')
                ->setPassword('demo'.$snow)
                ->setAccountStatus('true')
            ;
            $manager->persist($snowboarder);
            $this->addReference(self::SNOWBOARDER_REFERENCE_PREFIX.$snow, $snowboarder);
        }

        $manager->flush();
    }
}

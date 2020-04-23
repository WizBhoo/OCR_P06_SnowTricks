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
        for ($i = 1; $i < 4; $i++) {
            $snowboarder = new Snowboarder();
            $snowboarder
                ->setLastName('nom '.$i)
                ->setFirstName('prenom '.$i)
                ->setPseudo('goldfish'.$i)
                ->setEmail('demo'.$i.'@snowtricks.com')
                ->setPassword('demo'.$i)
                ->setAccountStatus('true')
            ;
            $manager->persist($snowboarder);
            $this->addReference(self::SNOWBOARDER_REFERENCE_PREFIX.$i, $snowboarder);
        }

        $manager->flush();
    }
}

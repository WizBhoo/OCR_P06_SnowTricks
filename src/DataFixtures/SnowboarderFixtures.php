<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\DataFixtures;

use App\Entity\Snowboarder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SnowboarderFixtures.
 */
class SnowboarderFixtures extends Fixture
{
    /**
     * A UserPasswordEncoderInterface Injection
     *
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var string
     */
    public const SNOWBOARDER_REFERENCE_PREFIX = 'snowboarder_';

    /**
     * SnowboarderFixtures constructor.
     *
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

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
                ->setUsername('goldfish'.$i)
                ->setEmail('demo'.$i.'@snowtricks.com')
                ->setPassword($this->passwordEncoder->encodePassword($snowboarder, 'demo'.$i))
                ->setAccountStatus('true')
            ;
            $manager->persist($snowboarder);
            $this->addReference(self::SNOWBOARDER_REFERENCE_PREFIX.$i, $snowboarder);
        }

        $manager->flush();
    }
}

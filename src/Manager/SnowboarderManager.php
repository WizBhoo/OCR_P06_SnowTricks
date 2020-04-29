<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Entity\Snowboarder;
use App\Repository\SnowboarderRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SnowboarderManager.
 */
class SnowboarderManager
{
    /**
     * A SnowboarderRepository Instance
     *
     * @var SnowboarderRepository
     */
    private $snowboarderRepository;

    /**
     * A UserPasswordEncoderInterface Injection
     *
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * SnowboarderManager constructor.
     *
     * @param SnowboarderRepository        $snowboarderRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(SnowboarderRepository $snowboarderRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->snowboarderRepository = $snowboarderRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Create a new Snowboarder in db
     *
     * @param Snowboarder $snowboarder
     * @param string      $password
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function createSnowboarder(Snowboarder $snowboarder, string $password): void
    {
        $snowboarder->setPassword(
            $this->passwordEncoder->encodePassword(
                $snowboarder,
                $password
            )
        );

        $this->snowboarderRepository->create($snowboarder);
    }
}

<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Entity\Snowboarder;
use App\Repository\SnowboarderRepository;
use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

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
     * A TokenGeneratorInterface Injection
     *
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;

    /**
     * SnowboarderManager constructor.
     *
     * @param SnowboarderRepository        $snowboarderRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param TokenGeneratorInterface      $tokenGenerator
     */
    public function __construct(SnowboarderRepository $snowboarderRepository, UserPasswordEncoderInterface $passwordEncoder, TokenGeneratorInterface $tokenGenerator)
    {
        $this->snowboarderRepository = $snowboarderRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenGenerator = $tokenGenerator;
    }

    /**
     * Create a new Snowboarder in db
     *
     * @param Snowboarder $snowboarder
     * @param string      $password
     *
     * @return Snowboarder
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function createSnowboarder(Snowboarder $snowboarder, string $password): Snowboarder
    {
        $snowboarder->setPassword(
            $this->passwordEncoder->encodePassword(
                $snowboarder,
                $password
            )
        );

        $this->snowboarderRepository->create($snowboarder);

        return $snowboarder;
    }

    /**
     * Find a Snowboarder from his id
     *
     * @param int $id
     *
     * @return Snowboarder|null
     */
    public function findSnowboarder(int $id): ?Snowboarder
    {
        return $this->snowboarderRepository->find($id);
    }

    /**
     * Find a Snowboarder from his username
     *
     * @param string $username
     *
     * @return Snowboarder|null
     */
    public function findSnowboarderBy(string $username): ?Snowboarder
    {
        return $this->snowboarderRepository->findOneBy(
            [
                'username' => $username,
            ]
        );
    }

    /**
     * Add an account token to a snowboarder
     *
     * @param Snowboarder $snowboarder
     *
     * @return Snowboarder
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addToken(Snowboarder $snowboarder): Snowboarder
    {
        $token = $this->tokenGenerator->generateToken();
        $snowboarder
            ->setAccountToken($token)
            ->setAccountTokenAt(new DateTime())
        ;
        $this->snowboarderRepository->update();

        return $snowboarder;
    }

    /**
     * Update Snowboarder's password in db
     *
     * @param Snowboarder $snowboarder
     * @param string      $password
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updatePassword(Snowboarder $snowboarder, string $password): void
    {
        $snowboarder->setPassword(
            $this->passwordEncoder->encodePassword(
                $snowboarder,
                $password
            )
        );
        $snowboarder->eraseCredentials();

        $this->snowboarderRepository->update();
    }

    /**
     * Activate Snowboarder's account status in db
     *
     * @param Snowboarder $snowboarder
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function activateAccount(Snowboarder $snowboarder): void
    {
        $snowboarder->setAccountStatus('true');
        $snowboarder->eraseCredentials();

        $this->snowboarderRepository->update();
    }
}

<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Repository;

use App\Entity\Snowboarder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class SnowboarderRepository
 *
 * @method Snowboarder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Snowboarder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Snowboarder[]    findAll()
 * @method Snowboarder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SnowboarderRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    /**
     * SnowboarderRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Snowboarder::class);
    }

    /**
     * Used to upgrade (rehash) the snowboarder's password automatically over time.
     *
     * @param UserInterface $snowboarder
     * @param string        $newEncodedPassword
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function upgradePassword(UserInterface $snowboarder, string $newEncodedPassword): void
    {
        if (!$snowboarder instanceof Snowboarder) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    \get_class($snowboarder)
                )
            );
        }

        $snowboarder->setPassword($newEncodedPassword);
        $this->_em->persist($snowboarder);
        $this->_em->flush();
    }

    /**
     * Persists new Snowboarder in db
     *
     * @param Snowboarder $snowboarder
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Snowboarder $snowboarder): void
    {
        $this->_em->persist($snowboarder);
        $this->_em->flush();
    }

    /**
     * Update a Snowboarder in db
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(): void
    {
        $this->_em->flush();
    }
}

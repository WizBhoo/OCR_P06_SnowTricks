<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Repository;

use App\Entity\Snowboarder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class SnowboarderRepository
 *
 * @method Snowboarder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Snowboarder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Snowboarder[]    findAll()
 * @method Snowboarder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SnowboarderRepository extends ServiceEntityRepository
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
}

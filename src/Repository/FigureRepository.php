<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Repository;

use App\Entity\Figure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class FigureRepository
 *
 * @method Figure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Figure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Figure[]    findAll()
 * @method Figure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FigureRepository extends ServiceEntityRepository
{
    /**
     * FigureRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Figure::class);
    }

    /**
     * Persists new Figure in db
     *
     * @param Figure $figure
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Figure $figure): void
    {
        $this->_em->persist($figure);
        $this->_em->flush();
    }

    /**
     * Persists Figure updated in db
     *
     * @param Figure $figure
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Figure $figure): void
    {
        $this->_em->persist($figure);
        $this->_em->flush();
    }

    /**
     * Remove Figure in db
     *
     * @param Figure $figure
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Figure $figure): void
    {
        $this->_em->remove($figure);
        $this->_em->flush();
    }
}

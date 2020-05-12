<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Entity\Figure;
use App\Repository\FigureRepository;
use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Security;

/**
 * Class FigureManager.
 */
class FigureManager
{
    /**
     * A FigureRepository Instance
     *
     * @var FigureRepository
     */
    private $figureRepository;

    /**
     * A SnowboarderManager Instance
     *
     * @var SnowboarderManager
     */
    private $snowboarderManager;

    /**
     * A Security service instance
     *
     * @var Security
     */
    private $security;

    /**
     * FigureManager constructor.
     *
     * @param FigureRepository   $figureRepository
     * @param SnowboarderManager $snowboarderManager
     * @param Security           $security
     */
    public function __construct(FigureRepository $figureRepository, SnowboarderManager $snowboarderManager, Security $security)
    {
        $this->figureRepository = $figureRepository;
        $this->snowboarderManager = $snowboarderManager;
        $this->security = $security;
    }

    /**
     * Retrieve all figures from db
     *
     * @return Figure[]
     */
    public function findAllFigure(): array
    {
        return $this->figureRepository->findAll();
    }

    /**
     * Create a new Figure in db
     *
     * @param Figure $figure
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function createFigure(Figure $figure): void
    {
        $author = $this->security->getUser()->getUsername();
        $snowboarder = $this->snowboarderManager->findSnowboarderBy($author);
        $figure
            ->setSnowboarder($snowboarder)
            ->setCreatedAt(new DateTime())
        ;

        $this->figureRepository->create($figure);
    }

    /**
     * Update a Figure in db
     *
     * @param Figure $figure
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateFigure(Figure $figure): void
    {
        $author = $this->security->getUser()->getUsername();
        $snowboarder = $this->snowboarderManager->findSnowboarderBy($author);
        $figure
            ->setSnowboarder($snowboarder)
            ->setUpdatedAt(new DateTime())
        ;

        $this->figureRepository->update($figure);
    }

    /**
     * Delete a Figure in db
     *
     * @param Figure $figure
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleteFigure(Figure $figure): void
    {
        $this->figureRepository->delete($figure);
    }
}

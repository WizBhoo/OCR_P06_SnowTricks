<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Entity\Figure;
use App\Repository\FigureRepository;

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

    public function __construct(FigureRepository $figureRepository)
    {
        $this->figureRepository = $figureRepository;
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
}

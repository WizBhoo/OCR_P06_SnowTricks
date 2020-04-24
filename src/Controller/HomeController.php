<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Manager\FigureManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController.
 */
class HomeController extends AbstractController
{
    /**
     * Show homepage with the figures list
     *
     * @param FigureManager $figureManager
     *
     * @return Response
     */
    public function index(FigureManager $figureManager): Response
    {
        $figures = $figureManager->findAllFigure();

        return $this->render(
            'home/index.html.twig',
            ['figures' => $figures]
        );
    }
}

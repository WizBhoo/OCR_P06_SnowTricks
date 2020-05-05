<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Entity\Figure;
use App\Form\FigureFormType;
use App\Repository\FigureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FigureController.
 */
class FigureController extends AbstractController
{
    /**
     * Show a figure
     *
     * @param Figure $figure
     *
     * @return Response
     */
    public function show(Figure $figure): Response
    {
        return $this->render('figure/_show.html.twig',
            ['figure' => $figure,]
        );
    }
}

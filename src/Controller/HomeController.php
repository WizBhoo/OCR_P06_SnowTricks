<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

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
     * @return Response
     */
    public function index(): Response
    {
        return $this->render(
            'home/index.html.twig',
            ['controller_name' => 'HomeController']
        );
    }
}

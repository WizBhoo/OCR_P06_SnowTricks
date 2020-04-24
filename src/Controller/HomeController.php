<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Entity\Figure;
use Doctrine\ORM\EntityManagerInterface;
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
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $figures = $entityManager
            ->getRepository(Figure::class)
            ->findAll()
        ;

        $entityManager->flush();

        return $this->render(
            'home/index.html.twig',
            ['figures' => $figures]
        );
    }
}

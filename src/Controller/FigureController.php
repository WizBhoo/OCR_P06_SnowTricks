<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Entity\Figure;
use App\Form\FigureFormType;
use App\Manager\FigureManager;
use App\Service\FileUploader;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        return $this->render(
            'figure/_show.html.twig',
            ['figure' => $figure,]
        );
    }

    /**
     * Add a new figure with images and videos
     *
     * @param Request       $request
     * @param FigureManager $figureManager
     * @param FileUploader  $fileUploader
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function new(Request $request, FigureManager $figureManager, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(FigureFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ArrayCollection $imageForms */
            $imageForms = $form->get('images')->all();
            if ($imageForms) {
                foreach ($imageForms as $imageForm) {
                    $file = $imageForm->get('file')->getData();
                    $fileName = $fileUploader->upload($request, $file);
                    $image = $imageForm->getData();
                    $image->setPath($fileName);
                }
            }

            $figureManager->createFigure(
                $form->getData()
            );

            $this->addFlash(
                'success',
                'New Tricks successfully added !'
            );

            return $this->redirectToRoute('index');
        }

        return $this->render(
            'figure/_new.html.twig',
            ['figureForm' => $form->createView()]
        );
    }
}

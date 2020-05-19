<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Entity\Figure;
use App\Form\FigureFormType;
use App\Manager\FigureManager;
use App\Manager\UploadManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @param UploadManager $uploadManager
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request, FigureManager $figureManager, UploadManager $uploadManager): Response
    {
        $form = $this->createForm(FigureFormType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $uploadManager->uploadImage($request, $form);
                $figureManager->createFigure(
                    $form->getData()
                );

                $this->addFlash(
                    'success',
                    'New Tricks successfully added !'
                );

                return new JsonResponse($this->generateUrl('index'));
            }

            return new JsonResponse($this->getErrorMessages($form), Response::HTTP_BAD_REQUEST);
        }

        return $this->render(
            'figure/_new.html.twig',
            ['figureForm' => $form->createView()]
        );
    }

    /**
     * Update a Figure with associated images and videos
     *
     * @param Request       $request
     * @param string        $slug
     * @param FigureManager $figureManager
     * @param UploadManager $uploadManager
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Request $request, string $slug, FigureManager $figureManager, UploadManager $uploadManager): Response
    {
        if (null === $figure = $figureManager->findFigureBy($slug)) {
            $this->addFlash('error', 'No figure found for slug '.$slug);

            return $this->redirectToRoute('index');
        }

        $originalImages = $figureManager->getOriginalImages($figure);
        $originalVideos = $figureManager->getOriginalVideos($figure);

        $form = $this->createForm(
            FigureFormType::class,
            $figure,
            [
                'action' => $this->generateUrl(
                    'app_figure_update',
                    ['slug' => $slug]
                )
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $uploadManager->uploadImage($request, $form);
                $figureManager->updateFigure($figure, $originalImages, $originalVideos);

                $this->addFlash(
                    'success',
                    'Trick successfully updated !'
                );

                return new JsonResponse($this->generateUrl('index'));
            }

            return new JsonResponse($this->getErrorMessages($form), Response::HTTP_BAD_REQUEST);
        }

        return $this->render(
            'figure/_update.html.twig',
            [
                'figure' => $figure,
                'figureForm' => $form->createView(),
            ]
        );
    }

    /**
     * Delete a figure
     *
     * @param Request       $request
     * @param Figure        $figure
     * @param FigureManager $figureManager
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Request $request, Figure $figure, FigureManager $figureManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$figure->getId(), $request->request->get('_token'))) {
            $figureManager->deleteFigure($figure);
        }

        $this->addFlash(
            'success',
            'Trick successfully deleted !'
        );

        return $this->redirectToRoute('index');
    }

    /**
     * Retrieve error messages if exist after form submission
     *
     * @param FormInterface $form
     *
     * @return array
     */
    private function getErrorMessages(FormInterface $form): array
    {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) {
            if ($form->isRoot()) {
                $errors['#'][] = $error->getMessage();
            } else {
                $errors[] = $error->getMessage();
            }
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }
}

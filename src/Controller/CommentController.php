<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Entity\Figure;
use App\Form\CommentFormType;
use App\Manager\CommentManager;
use App\Manager\ErrorManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CommentController.
 */
class CommentController extends AbstractController
{
    /**
     * Allows to add comments if user is logged in
     *
     * @param Request        $request
     * @param Figure         $figure
     * @param CommentManager $commentManager
     * @param ErrorManager   $errorManager
     *
     * @return JsonResponse
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addComment(Request $request, Figure $figure, CommentManager $commentManager, ErrorManager $errorManager): JsonResponse
    {
        $form = $this->createForm(CommentFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get("security.csrf.token_manager")->refreshToken("form_comment");
            $commentManager->createComment(
                $form->getData(),
                $figure
            );

            $this->addFlash(
                'com-success',
                'Comment successfully added !'
            );

            return new JsonResponse($this->generateUrl('app_figure_show', ['slug' => $figure->getSlug()]));
        }

        return new JsonResponse($errorManager->getErrorMessages($form), Response::HTTP_BAD_REQUEST);
    }
}

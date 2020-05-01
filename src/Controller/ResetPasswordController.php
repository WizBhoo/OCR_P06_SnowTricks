<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Form\ResetPasswordFormType;
use App\Manager\SnowboarderManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResetPasswordController.
 */
class ResetPasswordController extends AbstractController
{
    /**
     * Reset password form to update user password
     *
     * @param Request            $request
     * @param int                $id
     * @param string             $token
     * @param SnowboarderManager $snowboarderManager
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function resetPassword(Request $request, int $id, string $token, SnowboarderManager $snowboarderManager): Response
    {
        $form = $this->createForm(ResetPasswordFormType::class);
        $form->handleRequest($request);
        $snowboarder = $snowboarderManager->findSnowboarder($id);

        if (!$snowboarder) {
            $this->addFlash('alert', 'Error, try again.');

            return $this->redirectToRoute('app_forgotten_password');
        }

        $passwordResetAt = $snowboarder->getAccountTokenAt();

        if (null !== $token
            && $snowboarder->getAccountToken() === $token
            && time() - $passwordResetAt->getTimestamp() < 600
        ) {
            if ($form->isSubmitted() && $form->isValid()) {
                $snowboarderManager->updatePassword(
                    $snowboarder,
                    $form->get('password')->getData()
                );

                $this->addFlash(
                    'success',
                    'Your password has been successfully updated !'
                );

                return $this->redirectToRoute('index');
            }

            return $this->render(
                'security/reset_password.html.twig',
                ['resetPasswordForm' => $form->createView()]
            );
        }

        $this->addFlash('alert', 'Token Invalid, try again.');

        return $this->redirectToRoute('app_forgotten_password');
    }
}

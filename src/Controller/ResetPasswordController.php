<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Entity\Snowboarder;
use App\Form\ResetPasswordFormType;
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
     * @param Request $request
     *
     * @return Response
     */
    public function resetPassword(Request $request): Response
    {
        $form = $this->createForm(ResetPasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
}

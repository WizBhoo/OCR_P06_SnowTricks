<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Entity\Snowboarder;
use App\Form\ForgottenPasswordFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ForgottenPasswordController.
 */
class ForgottenPasswordController extends AbstractController
{
    /**
     * Forgotten password form to send reset password email
     *
     * @param Request $request
     *
     * @return Response
     */
    public function forgottenPassword(Request $request): Response
    {
        $user = new Snowboarder();
        $form = $this->createForm(ForgottenPasswordFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash(
                'notice',
                'Check your email and follow the link sent to reset your password.'
            );

            return $this->redirectToRoute('app_forgotten_password');
        }

        return $this->render(
            'security/forgot_password.html.twig',
            ['forgottenPasswordForm' => $form->createView()]
        );
    }
}

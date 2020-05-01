<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Entity\Snowboarder;
use App\Form\ForgottenPasswordFormType;
use App\Mailer\MailerMessage;
use App\Manager\SnowboarderManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ForgottenPasswordController.
 */
class ForgottenPasswordController extends AbstractController
{
    /**
     * Forgotten password form to send reset password email
     *
     * @param Request            $request
     * @param SnowboarderManager $snowboarderManager
     * @param MailerMessage      $mailer
     *
     * @return Response
     *
     * @throws TransportExceptionInterface
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function forgottenPassword(Request $request, SnowboarderManager $snowboarderManager, MailerMessage $mailer): Response
    {
        $user = new Snowboarder();
        $form = $this->createForm(ForgottenPasswordFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $snowboarder = $snowboarderManager
                ->findSnowboarderBy($user->getUsername())
            ;
            if (!$snowboarder) {
                $this->addFlash('alert', 'This username is not valid.');

                return $this->redirectToRoute('app_forgotten_password');
            }

            $snowboarderManager->addToken($snowboarder);

            $url = $this->generateUrl(
                'app_reset_password',
                [
                    'id' => $snowboarder->getId(),
                    'token' => $snowboarder->getAccountToken(),
                ],
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            $mailer->sendPasswordEmail(
                $snowboarder->getEmail(),
                $snowboarder->getUsername(),
                $url
            );

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

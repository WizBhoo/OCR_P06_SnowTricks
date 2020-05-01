<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Form\RegistrationFormType;
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
 * Class RegistrationController.
 */
class RegistrationController extends AbstractController
{
    /**
     * Register a visitor by creating user account
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
    public function register(Request $request, SnowboarderManager $snowboarderManager, MailerMessage $mailer): Response
    {
        $form = $this->createForm(RegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $snowboarder = $snowboarderManager->createSnowboarder(
                $form->getData(),
                $form->get('password')->getData()
            );

            $snowboarderManager->addToken($snowboarder);

            $url = $this->generateUrl(
                'app_account_activation',
                [
                    'id' => $snowboarder->getId(),
                    'token' => $snowboarder->getAccountToken(),
                ],
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            $mailer->sendSignUpEmail(
                $snowboarder->getEmail(),
                $snowboarder->getUsername(),
                $url
            );

            $this->addFlash(
                'notice',
                'Check your email and follow the link sent to activate your account.'
            );

            return $this->redirectToRoute('index');
        }

        return $this->render(
            'registration/register.html.twig',
            ['registrationForm' => $form->createView()]
        );
    }
}

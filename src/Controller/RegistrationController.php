<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Entity\Snowboarder;
use App\Form\RegistrationFormType;
use App\Manager\SnowboarderManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function register(Request $request, SnowboarderManager $snowboarderManager): Response
    {
        $user = new Snowboarder();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $snowboarderManager->createSnowboarder(
                $user,
                $form->get('password')->getData()
            );

            return $this->redirectToRoute('index');
        }

        return $this->render(
            'registration/register.html.twig',
            ['registrationForm' => $form->createView()]
        );
    }
}

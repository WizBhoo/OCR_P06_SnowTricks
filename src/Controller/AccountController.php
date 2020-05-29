<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller;

use App\Manager\SnowboarderManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AccountController.
 */
class AccountController extends AbstractController
{
    /**
     * Activate user account created from the link received by email
     *
     * @param Request            $request
     * @param SnowboarderManager $snowboarderManager
     *
     * @return Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function activation(Request $request, SnowboarderManager $snowboarderManager): Response
    {
        $username = $request->get('username');
        $snowboarder = $snowboarderManager
            ->findSnowboarderBy($username);

        if (!$snowboarder || null === $username) {
            $this->addFlash('alert', 'Error, try again.');

            return $this->redirectToRoute('app_register');
        }

        $passwordResetAt = $snowboarder->getAccountTokenAt();
        $token = $request->get('token');

        if (null !== $token
            && $snowboarder->getAccountToken() === $token
            && time() - $passwordResetAt->getTimestamp() < 144000
        ) {
            $snowboarderManager->activateAccount($snowboarder);

            $this->addFlash(
                'success',
                'Your account has been successfully activated !'
            );

            return $this->redirectToRoute('index');
        }

        $this->addFlash('alert', 'Token Invalid, try again.');

        return $this->redirectToRoute('app_register');
    }
}

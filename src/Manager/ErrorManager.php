<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use Symfony\Component\Form\FormInterface;

/**
 * Class ErrorManager.
 */
class ErrorManager
{
    /**
     * Retrieve error messages if exist after form submission
     *
     * @param FormInterface $form
     *
     * @return array
     */
    public function getErrorMessages(FormInterface $form): array
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

<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Service\FileUploader;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UploadManager.
 */
class UploadManager
{
    /**
     * A FileUploader Instance
     *
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * UploadManager constructor.
     *
     * @param FileUploader $fileUploader
     */
    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    /**
     * Upload an image and set the fileName
     *
     * @param Request       $request
     * @param FormInterface $form
     *
     * @return void
     */
    public function uploadImage(Request $request, FormInterface $form): void
    {
        /** @var ArrayCollection $imageForms */
        $imageForms = $form->get('images')->all();
        if ($imageForms) {
            foreach ($imageForms as $imageForm) {
                $file = $imageForm->get('file')->getData();
                if ($file instanceof UploadedFile) {
                    $fileName = $this->fileUploader->upload($request, $file);
                    $image = $imageForm->getData();
                    $image->setPath($fileName);
                }
            }
        }
    }
}

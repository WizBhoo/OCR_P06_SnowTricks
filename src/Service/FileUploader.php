<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FileUploader.
 */
class FileUploader
{
    /**
     * Directory to save uploaded files
     *
     * @var string
     */
    private $targetDirectory;

    /**
     * FileUploader constructor.
     *
     * @param $targetDirectory
     */
    public function __construct(string $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * Retrieve a file sent and upload it to the appropriate directory
     *
     * @param Request      $request
     * @param UploadedFile $file
     *
     * @return string
     */
    public function upload(Request $request, UploadedFile $file): string
    {
        $originalFilename = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );
        $safeFilename = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalFilename
        );
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            $request->getSession()->getFlashBag()->add(
                'error', 'Error, try again.'
            );
        }

        return $fileName;
    }

    /**
     * Get the targeted directory
     *
     * @return string
     */
    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }
}

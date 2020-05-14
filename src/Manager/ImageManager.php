<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Entity\Figure;
use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\ORMException;

/**
 * Class ImageManager.
 */
class ImageManager
{
    /**
     * An ImageRepository Instance
     *
     * @var ImageRepository
     */
    private $imageRepository;

    /**
     * Directory to save uploaded files
     *
     * @var string
     */
    private $targetDirectory;

    /**
     * ImageManager constructor.
     *
     * @param ImageRepository $imageRepository
     * @param string          $targetDirectory
     */
    public function __construct(ImageRepository $imageRepository, string $targetDirectory)
    {
        $this->imageRepository = $imageRepository;
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * Check if Figure contains a primary image
     * If not, set the first image as primary
     *
     * @param Figure $figure
     *
     * @return void
     */
    public function hasPrimaryImg(Figure $figure): void
    {
        $images = $figure->getImages();
        $filteredImages = $images->filter(function($image){
           return $image->isPrimary();
        });

        if (0 === $filteredImages->count() && !$images->isEmpty()) {
            $images->first()->setPrimary(true);
        }
    }

    /**
     * Delete an Image in db and delete associated file
     *
     * @param Figure          $figure
     * @param ArrayCollection $originalImages
     *
     * @return void
     *
     * @throws ORMException
     */
    public function deleteImage(Figure $figure, ArrayCollection $originalImages): void
    {
        foreach ($originalImages as $image) {
            if (false === $figure->getImages()->contains($image)) {
                $this->imageRepository->delete($image);
                $pathFile = $this->targetDirectory.'/'.$image->getPath();
                if (file_exists($pathFile)) {
                    unlink($pathFile);
                }
            }
        }
    }
}

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
     * ImageManager constructor.
     *
     * @param ImageRepository $imageRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * Delete an Image in db
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
            }
        }
    }
}

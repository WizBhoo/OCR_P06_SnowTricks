<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Entity\Figure;
use App\Repository\FigureRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Security;

/**
 * Class FigureManager.
 */
class FigureManager
{
    /**
     * A FigureRepository Instance
     *
     * @var FigureRepository
     */
    private $figureRepository;

    /**
     * An ImageManager Instance
     *
     * @var ImageManager
     */
    private $imageManager;

    /**
     * A VideoManager Instance
     *
     * @var VideoManager
     */
    private $videoManager;

    /**
     * A SnowboarderManager Instance
     *
     * @var SnowboarderManager
     */
    private $snowboarderManager;

    /**
     * A Security service instance
     *
     * @var Security
     */
    private $security;

    /**
     * FigureManager constructor.
     *
     * @param FigureRepository   $figureRepository
     * @param ImageManager       $imageManager
     * @param VideoManager       $videoManager
     * @param SnowboarderManager $snowboarderManager
     * @param Security           $security
     */
    public function __construct(FigureRepository $figureRepository, ImageManager $imageManager, VideoManager $videoManager, SnowboarderManager $snowboarderManager, Security $security)
    {
        $this->figureRepository = $figureRepository;
        $this->imageManager = $imageManager;
        $this->videoManager = $videoManager;
        $this->snowboarderManager = $snowboarderManager;
        $this->security = $security;
    }

    /**
     * Retrieve all figures from db
     *
     * @return Figure[]
     */
    public function findAllFigure(): array
    {
        return $this->figureRepository->findAll();
    }

    /**
     * Find a Figure from his slug
     *
     * @param string|null $slug
     *
     * @return Figure|null
     */
    public function findFigureBy(?string $slug): ?Figure
    {
        return $this->figureRepository->findOneBy(
            ['slug' => $slug]
        );
    }

    /**
     * Create a new Figure in db
     *
     * @param Figure $figure
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function createFigure(Figure $figure): void
    {
        $author = $this->security->getUser()->getUsername();
        $snowboarder = $this->snowboarderManager->findSnowboarderBy($author);
        $figure
            ->setSnowboarder($snowboarder)
            ->setCreatedAt(new DateTime())
        ;

        $this->figureRepository->create($figure);
    }

    /**
     * Update a Figure in db
     *
     * @param Figure          $figure
     * @param ArrayCollection $originalImages
     * @param ArrayCollection $originalVideos
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateFigure(Figure $figure, ArrayCollection $originalImages, ArrayCollection $originalVideos): void
    {
        $this->imageManager->deleteImage($figure, $originalImages);
        $this->videoManager->deleteVideo($figure, $originalVideos);

        $author = $this->security->getUser()->getUsername();
        $snowboarder = $this->snowboarderManager->findSnowboarderBy($author);
        $figure
            ->setSnowboarder($snowboarder)
            ->setUpdatedAt(new DateTime())
        ;

        $this->figureRepository->update($figure);
    }

    /**
     * Delete a Figure in db
     *
     * @param Figure $figure
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleteFigure(Figure $figure): void
    {
        $this->figureRepository->delete($figure);
    }

    /**
     * Get Images from Figure
     *
     * @param Figure $figure
     *
     * @return ArrayCollection
     */
    public function getOriginalImages(Figure $figure): ArrayCollection
    {
        $originalImages = new ArrayCollection();
        foreach ($figure->getImages() as $image) {
            $originalImages->add($image);
        }

        return $originalImages;
    }

    /**
     * Get Videos from Figure
     *
     * @param Figure $figure
     *
     * @return ArrayCollection
     */
    public function getOriginalVideos(Figure $figure): ArrayCollection
    {
        $originalVideos = new ArrayCollection();
        foreach ($figure->getVideos() as $video) {
            $originalVideos->add($video);
        }

        return $originalVideos;
    }
}

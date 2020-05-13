<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Entity\Figure;
use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\ORMException;

/**
 * Class VideoManager.
 */
class VideoManager
{
    /**
     * An VideoRepository Instance
     *
     * @var VideoRepository
     */
    private $videoRepository;

    /**
     * VideoManager constructor.
     *
     * @param VideoRepository $videoRepository
     */
    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    /**
     * Delete a Video in db
     *
     * @param Figure          $figure
     * @param ArrayCollection $originalVideos
     *
     * @return void
     *
     * @throws ORMException
     */
    public function deleteVideo(Figure $figure, ArrayCollection $originalVideos): void
    {
        foreach ($originalVideos as $video) {
            if (false === $figure->getVideos()->contains($video)) {
                $this->videoRepository->delete($video);
            }
        }
    }
}

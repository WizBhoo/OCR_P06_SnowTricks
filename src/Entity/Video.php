<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity Class Video
 *
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Figure
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Figure", inversedBy="videos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $figureId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Figure|null
     */
    public function getFigureId(): ?Figure
    {
        return $this->figureId;
    }

    /**
     * @param Figure|null $figureId
     *
     * @return $this
     */
    public function setFigureId(?Figure $figureId): self
    {
        $this->figureId = $figureId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}

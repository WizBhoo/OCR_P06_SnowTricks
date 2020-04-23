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
    private $figure;

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
    public function getFigure(): ?Figure
    {
        return $this->figure;
    }

    /**
     * @param Figure|null $figure
     *
     * @return $this
     */
    public function setFigure(?Figure $figure): self
    {
        $this->figure = $figure;

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

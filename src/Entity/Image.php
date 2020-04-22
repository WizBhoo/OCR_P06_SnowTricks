<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity Class Image
 *
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Figure", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $figureId;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isPrimary;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $path;

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
     * @return bool|null
     */
    public function getIsPrimary(): ?bool
    {
        return $this->isPrimary;
    }

    /**
     * @param bool $isPrimary
     *
     * @return $this
     */
    public function setIsPrimary(bool $isPrimary): self
    {
        $this->isPrimary = $isPrimary;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }
}

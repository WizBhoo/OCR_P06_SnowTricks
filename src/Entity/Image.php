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
    private $figure;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", name="is_primary", options={"default"=false})
     */
    private $primary;

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
     * @return bool|null
     */
    public function isPrimary(): ?bool
    {
        return $this->primary;
    }

    /**
     * @param bool $primary
     *
     * @return $this
     */
    public function setPrimary(bool $primary): self
    {
        $this->primary = $primary;

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

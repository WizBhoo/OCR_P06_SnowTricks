<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entity Class Comment
 *
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Figure", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $figureId;

    /**
     * @var Snowboarder
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Snowboarder", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $snowboarderId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

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
     * @return Snowboarder|null
     */
    public function getSnowboarderId(): ?Snowboarder
    {
        return $this->snowboarderId;
    }

    /**
     * @param Snowboarder|null $snowboarderId
     *
     * @return $this
     */
    public function setSnowboarderId(?Snowboarder $snowboarderId): self
    {
        $this->snowboarderId = $snowboarderId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}

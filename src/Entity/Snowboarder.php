<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entity Class Snowboarder
 *
 * @ORM\Entity(repositoryClass="App\Repository\SnowboarderRepository")
 */
class Snowboarder
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
     * @var string
     *
     * @ORM\Column(type="string", length=30)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30, unique=true)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * Token used for account activation or to reset account password
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $accountToken;

    /**
     * To manage token validity period
     *
     * @var DateTimeInterface
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $accountTokenAt;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $accountStatus;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Figure", mappedBy="snowboarder")
     */
    private $figures;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="snowboarder")
     */
    private $comments;

    /**
     * Snowboarder constructor.
     */
    public function __construct()
    {
        $this->figures = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     *
     * @return $this
     */
    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAccountToken(): ?string
    {
        return $this->accountToken;
    }

    /**
     * @param string|null $accountToken
     *
     * @return $this
     */
    public function setAccountToken(?string $accountToken): self
    {
        $this->accountToken = $accountToken;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getAccountTokenAt(): ?DateTimeInterface
    {
        return $this->accountTokenAt;
    }

    /**
     * @param DateTimeInterface|null $accountTokenAt
     *
     * @return $this
     */
    public function setAccountTokenAt(?DateTimeInterface $accountTokenAt): self
    {
        $this->accountTokenAt = $accountTokenAt;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAccountStatus(): ?bool
    {
        return $this->accountStatus;
    }

    /**
     * @param bool $accountStatus
     *
     * @return $this
     */
    public function setAccountStatus(bool $accountStatus): self
    {
        $this->accountStatus = $accountStatus;

        return $this;
    }

    /**
     * @return Collection|Figure[]
     */
    public function getFigures(): Collection
    {
        return $this->figures;
    }

    /**
     * @param Figure $figure
     *
     * @return $this
     */
    public function addFigure(Figure $figure): self
    {
        if (!$this->figures->contains($figure)) {
            $this->figures[] = $figure;
            $figure->setSnowboarder($this);
        }

        return $this;
    }

    /**
     * @param Figure $figure
     *
     * @return $this
     */
    public function removeFigure(Figure $figure): self
    {
        if ($this->figures->contains($figure)) {
            $this->figures->removeElement($figure);
            // set the owning side to null (unless already changed)
            if ($figure->getSnowboarder() === $this) {
                $figure->setSnowboarder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * @param Comment $comment
     *
     * @return $this
     */
    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setSnowboarder($this);
        }

        return $this;
    }

    /**
     * @param Comment $comment
     *
     * @return $this
     */
    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getSnowboarder() === $this) {
                $comment->setSnowboarder(null);
            }
        }

        return $this;
    }
}

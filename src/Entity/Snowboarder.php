<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity Class Snowboarder
 *
 * @ORM\Entity(repositoryClass="App\Repository\SnowboarderRepository")
 * @UniqueEntity(fields={"username"}, message="This Pseudo already exists", groups={"registration"})
 */
class Snowboarder implements UserInterface
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
     *
     * @Assert\NotBlank(message="You must choose a Lastname", groups={"registration"})
     * @Assert\Length(
     *     min=4,
     *     max=30,
     *     minMessage="Your Firstname should contain at least {{ limit }} characters",
     *     maxMessage="Your Firstname should not contain more than {{ limit }} characters",
     *     allowEmptyString=false,
     *     groups={"registration"}
     * )
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30)
     *
     * @Assert\NotBlank(message="You must choose a Firstname", groups={"registration"})
     * @Assert\Length(
     *     min=3,
     *     max=30,
     *     minMessage="Your Lastname should contain at least {{ limit }} characters",
     *     maxMessage="Your Lastname should not contain more than {{ limit }} characters",
     *     allowEmptyString=false,
     *     groups={"registration"}
     * )
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30, unique=true)
     *
     * @Assert\NotBlank(message="You must choose a Username", groups={"registration"})
     * @Assert\Length(
     *     min=3,
     *     max=30,
     *     minMessage="Your Username should contain at least {{ limit }} characters",
     *     maxMessage="Your Username should not contain more than {{ limit }} characters",
     *     allowEmptyString=false,
     *     groups={"registration"}
     * )
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, unique=true)
     *
     * @Assert\NotBlank(message="You must enter an email", groups={"registration"})
     * @Assert\Email(message="The Email '{{ value }}' is not a valid email", groups={"registration"})
     */
    private $email;

    /**
     * @var string The hashed password
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="You must choose a Password", groups={"registration"})
     * @Assert\Length(
     *     min=5,
     *     max=255,
     *     minMessage="Your Password should contain at least {{ limit }} characters",
     *     allowEmptyString=false,
     *     groups={"registration"}
     * )
     */
    private $password;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];

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
     * @ORM\Column(type="boolean", options={"default"=false})
     */
    private $accountStatus = false;

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
     * The visual identifier that represents this user.
     *
     * @see UserInterface|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

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
     * @see UserInterface
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
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     *
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

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
     * @return Collection
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
            $this->figures->add($figure);
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
     * @return Collection
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
            $this->comments->add($comment);
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

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        $this->accountToken = null;
        $this->accountTokenAt = null;
    }
}

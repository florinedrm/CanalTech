<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjectRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank(message="Le titre doit être renseigné.")
     * @Assert\Length(
     *      min=2,
     *      max=40,
     *      minMessage="Le titre doit contenir au moins {{ limit }} caractères",
     *      maxMessage="Le titre doit contenir au maximum {{ limit }} caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=7)
     * @Assert\NotBlank(message="Ce champs doit être rempli.")
     */
    private $color;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function initCreatedAt()
    {
        $this->setCreatedAt( new DateTime() );
    }
}

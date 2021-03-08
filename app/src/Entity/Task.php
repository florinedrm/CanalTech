<?php

namespace App\Entity;

use DateTime;
use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120)
     * @Assert\NotBlank(message="Le titre doit être renseigné.")
     * @Assert\Length(
     *      min=2,
     *      max=1200,
     *      minMessage="Le titre doit contenir au moins {{ limit }} caractères",
     *      maxMessage="Le titre doit contenir au maximum {{ limit }} caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message="Ce champs doit être rempli.")
     * @Assert\GreaterThan("today", message="Vous devez choisir une date à venir.")
     */
    private $start_at;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message="Ce champs doit être rempli.")
     * @Assert\GreaterThan(propertyPath="startAt", message="Vous devez choisir une date supérieure à la date de début.")
     */
    private $end_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $invoiced;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->invoiced = false;
    }

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

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->start_at;
    }

    public function setStartAt(\DateTimeInterface $start_at): self
    {
        $this->start_at = $start_at;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->end_at;
    }

    public function setEndAt(\DateTimeInterface $end_at): self
    {
        $this->end_at = $end_at;

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

    public function getInvoiced(): ?bool
    {
        return $this->invoiced;
    }

    public function setInvoiced(bool $invoiced): self
    {
        $this->invoiced = $invoiced;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

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

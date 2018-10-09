<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 */
class Course
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * Many Course have One Module.
     * @ORM\ManyToOne(targetEntity="Module", inversedBy="courses")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    public $module;

    /**
     * One Course has Many Sessions.
     * @ORM\OneToMany(targetEntity="Session", mappedBy="course")
     */
    public $sessions;

    /**
     * One Course has Many users.
     * @ORM\OneToMany(targetEntity="UserCourseAssignement", mappedBy="course")
     */
    private $assignements;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->assignements = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return Collection|Session[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setCourse($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
            // set the owning side to null (unless already changed)
            if ($session->getCourse() === $this) {
                $session->setCourse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserCourseAssignement[]
     */
    public function getAssignements(): Collection
    {
        return $this->assignements;
    }

    public function addAssignement(UserCourseAssignement $assignement): self
    {
        if (!$this->assignements->contains($assignement)) {
            $this->assignements[] = $assignement;
            $assignement->setCourse($this);
        }

        return $this;
    }

    public function removeAssignement(UserCourseAssignement $assignement): self
    {
        if ($this->assignements->contains($assignement)) {
            $this->assignements->removeElement($assignement);
            // set the owning side to null (unless already changed)
            if ($assignement->getCourse() === $this) {
                $assignement->setCourse(null);
            }
        }

        return $this;
    }
}

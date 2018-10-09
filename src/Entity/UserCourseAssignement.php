<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCourseRepository")
 */
class UserCourseAssignement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="assignements")
     * @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=FALSE)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="assignements")
     * @ORM\JoinColumn(name="course", referencedColumnName="id", nullable=FALSE)
     */
    private $course;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\Column(type="datetime")
     */
    private $AssignmentDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getAssignmentDate(): ?\DateTimeInterface
    {
        return $this->AssignmentDate;
    }

    public function setAssignmentDate(\DateTimeInterface $AssignmentDate): self
    {
        $this->AssignmentDate = $AssignmentDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }



    
}

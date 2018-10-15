<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\CourseSession;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCourseSessionRepository")
 */
class UserCourseSession
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="userCourseSession")
     */
    private $courseSession;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default":0})
     */
    private $studentNote;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $teacherNote;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $teacherReviewed = false;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $studentReviewed = false;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getStudentNote(): ?int
    {
        return $this->studentNote;
    }

    public function setStudentNote(?int $studentNote): self
    {
        $this->studentNote = $studentNote;

        return $this;
    }

    public function getTeacherNote(): ?int
    {
        return $this->teacherNote;
    }

    public function setTeacherNote(?int $teacherNote): self
    {
        $this->teacherNote = $teacherNote;

        return $this;
    }

    public function getTeacherReviewed(): ?bool
    {
        return $this->teacherReviewed;
    }

    public function setTeacherReviewed(bool $teacherReviewed): self
    {
        $this->teacherReviewed = $teacherReviewed;

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

    public function getCourseSession(): ?Session
    {
        return $this->courseSession;
    }

    public function setCourseSession(?Session $courseSession): self
    {
        $this->courseSession = $courseSession;

        return $this;
    }

    public function getStudentReviewed(): ?bool
    {
        return $this->studentReviewed;
    }

    public function setStudentReviewed(bool $studentReviewed): self
    {
        $this->studentReviewed = $studentReviewed;

        return $this;
    }
}

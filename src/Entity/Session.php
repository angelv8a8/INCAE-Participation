<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\UserCourseSession;
/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * Many Sesion have One Course.
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="sessions")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     */
    private $course;

    /**
     * @ORM\OneToMany(targetEntity="UserCourseSession", mappedBy="courseSession")
     */
    private $userCourseSession;

    /**
     * @ORM\Column(type="boolean", options={"default":true} )
     */
    private $studentCanUpdate;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->userCourseSession = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getStudentCanUpdate(): ?bool
    {
        return $this->studentCanUpdate;
    }

    public function setStudentCanUpdate(bool $studentCanUpdate): self
    {
        $this->studentCanUpdate = $studentCanUpdate;

        return $this;
    }

    /**
     * @return Collection|UserCourseSession[]
     */
    public function getUserCourseSession(): Collection
    {
        return $this->userCourseSession;
    }

    public function addUserCourseSession(UserCourseSession $userCourseSession): self
    {
        if (!$this->userCourseSession->contains($userCourseSession)) {
            $this->userCourseSession[] = $userCourseSession;
            $userCourseSession->setSession($this);
        }

        return $this;
    }

    public function removeUserCourseSession(UserCourseSession $userCourseSession): self
    {
        if ($this->userCourseSession->contains($userCourseSession)) {
            $this->userCourseSession->removeElement($userCourseSession);
            // set the owning side to null (unless already changed)
            if ($userCourseSession->getSession() === $this) {
                $userCourseSession->setSession(null);
            }
        }

        return $this;
    }
}

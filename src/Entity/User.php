<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $incaeId;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255 , unique=true)
     */
    private $email;

    /**
     * @Assert\File(mimeTypes={ "image/jpg", "image/png","image/jpeg" })
     */
    public $avatarFile;

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * Many Students have Many Courses.
     * @ORM\ManyToMany(targetEntity="Course", mappedBy="students")
     */
    private $studentCourses;

    /**
     * Many Teachers have Many Courses.
     * @ORM\ManyToMany(targetEntity="Course", mappedBy="teachers")
     */
    private $teacherCourses;

    /**
     * Many Users have Many Roles.
     * @ORM\ManyToMany(targetEntity="Role",   mappedBy="users")
     */
    private $userRoles;

    /**
     * @ORM\OneToMany(targetEntity="UserCourseSession", mappedBy="user",cascade={"persist", "remove"})
     */
    private $reviews;

    public function __construct()
    {
        $this->studentCourses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teacherCourses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userRoles = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getRoles()
    {
        $grantedRoles = array('ROLE_USER');
        foreach($this->userRoles as $role)
        {

            $grantedRoles[] = $role->getCode();

        }
        return $grantedRoles;
        
    }
    
    public function getSalt()
    {

    }

    public function eraseCredentials()
    {

    }

    public function serialize()
    {
        return serialize(
            [
                $this->id,
                $this->email,
                $this->password
            ]
        );
    }
    public function unserialize($string)
    {
        list (
            $this->id,
            $this->email,
            $this->password
        ) = unserialize($string, ['allowed_classes' =>  false]);
    }

   

    public function getIncaeId(): ?int
    {
        return $this->incaeId;
    }

    public function setIncaeId(int $incaeId): self
    {
        $this->incaeId = $incaeId;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @return Collection|Course[]
     */
    public function getStudentCourses(): Collection
    {
        return $this->studentCourses;
    }

    public function addStudentCourse(Course $studentCourse): self
    {
        if (!$this->studentCourses->contains($studentCourse)) {
            $this->studentCourses[] = $studentCourse;
            $studentCourse->addStudent($this);
        }

        return $this;
    }

    public function removeStudentCourse(Course $studentCourse): self
    {
        if ($this->studentCourses->contains($studentCourse)) {
            $this->studentCourses->removeElement($studentCourse);
            $studentCourse->removeStudent($this);
        }

        return $this;
    }

    /**
     * @return Collection|Course[]
     */
    public function getTeacherCourses(): Collection
    {
        return $this->teacherCourses;
    }

    public function addTeacherCourse(Course $teacherCourse): self
    {
        if (!$this->teacherCourses->contains($teacherCourse)) {
            $this->teacherCourses[] = $teacherCourse;
            $teacherCourse->addTeacher($this);
        }

        return $this;
    }

    public function removeTeacherCourse(Course $teacherCourse): self
    {
        if ($this->teacherCourses->contains($teacherCourse)) {
            $this->teacherCourses->removeElement($teacherCourse);
            $teacherCourse->removeTeacher($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->fullName . ' (' . $this->email . ')';
    }

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            $userRole->removeUser($this);
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection|UserCourseSession[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(UserCourseSession $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setUser($this);
        }

        return $this;
    }

    public function removeReview(UserCourseSession $review): self
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
            // set the owning side to null (unless already changed)
            if ($review->getUser() === $this) {
                $review->setUser(null);
            }
        }

        return $this;
    }

}

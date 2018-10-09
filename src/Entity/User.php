<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @ORM\Column(type="string", length=255 , unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255 , unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * One User has Many assignements.
     * @ORM\OneToMany(targetEntity="UserCourseAssignement", mappedBy="user")
     */
    private $assignements;


    public function __construct()
    {
        $this->assignements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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
        $this->username = $username;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

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
        if($this->getUsername() == 'admin')
        {
            return ['ROLE_USER','ROLE_ADMIN'];
        }
        return ['ROLE_USER'];
        
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
                $this->username,
                $this->email,
                $this->password
            ]
        );
    }
    public function unserialize($string)
    {
        list (
            $this->id,
            $this->username,
            $this->email,
            $this->password
        ) = unserialize($string, ['allowed_classes' =>  false]);
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
            $assignement->setUser($this);
        }

        return $this;
    }

    public function removeAssignement(UserCourseAssignement $assignement): self
    {
        if ($this->assignements->contains($assignement)) {
            $this->assignements->removeElement($assignement);
            // set the owning side to null (unless already changed)
            if ($assignement->getUser() === $this) {
                $assignement->setUser(null);
            }
        }

        return $this;
    }
}

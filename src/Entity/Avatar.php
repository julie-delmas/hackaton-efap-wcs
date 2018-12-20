<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvatarRepository")
 */
class Avatar
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
    private $fileName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="avatar")
     */
    private $userAvatar;

    public function __construct()
    {
        $this->userAvatar = new ArrayCollection();
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

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserAvatar(): Collection
    {
        return $this->userAvatar;
    }

    public function addUserAvatar(User $userAvatar): self
    {
        if (!$this->userAvatar->contains($userAvatar)) {
            $this->userAvatar[] = $userAvatar;
            $userAvatar->setAvatar($this);
        }

        return $this;
    }

    public function removeUserAvatar(User $userAvatar): self
    {
        if ($this->userAvatar->contains($userAvatar)) {
            $this->userAvatar->removeElement($userAvatar);
            // set the owning side to null (unless already changed)
            if ($userAvatar->getAvatar() === $this) {
                $userAvatar->setAvatar(null);
            }
        }

        return $this;
    }
}

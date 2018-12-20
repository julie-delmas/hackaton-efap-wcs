<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GradeRepository")
 */
class Grade
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
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="grade")
     */
    private $userScore;

    public function __construct()
    {
        $this->userScore = new ArrayCollection();
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

    /**
     * @return Collection|User[]
     */
    public function getUserScore(): Collection
    {
        return $this->userScore;
    }

    public function addUserScore(User $userScore): self
    {
        if (!$this->userScore->contains($userScore)) {
            $this->userScore[] = $userScore;
            $userScore->setGrade($this);
        }

        return $this;
    }

    public function removeUserScore(User $userScore): self
    {
        if ($this->userScore->contains($userScore)) {
            $this->userScore->removeElement($userScore);
            // set the owning side to null (unless already changed)
            if ($userScore->getGrade() === $this) {
                $userScore->setGrade(null);
            }
        }

        return $this;
    }
}

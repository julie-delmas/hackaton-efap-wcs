<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizzRepository")
 */
class Quizz
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
    private $question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answerA;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answerB;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answerC;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answerD;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answerValidate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="quizzs")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswerA(): ?string
    {
        return $this->answerA;
    }

    public function setAnswerA(string $answerA): self
    {
        $this->answerA = $answerA;

        return $this;
    }

    public function getAnswerB(): ?string
    {
        return $this->answerB;
    }

    public function setAnswerB(string $answerB): self
    {
        $this->answerB = $answerB;

        return $this;
    }

    public function getAnswerC(): ?string
    {
        return $this->answerC;
    }

    public function setAnswerC(string $answerC): self
    {
        $this->answerC = $answerC;

        return $this;
    }

    public function getAnswerD(): ?string
    {
        return $this->answerD;
    }

    public function setAnswerD(string $answerD): self
    {
        $this->answerD = $answerD;

        return $this;
    }

    public function getAnswerValidate(): ?string
    {
        return $this->answerValidate;
    }

    public function setAnswerValidate(string $answerValidate): self
    {
        $this->answerValidate = $answerValidate;

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
}

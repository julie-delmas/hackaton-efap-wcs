<?php

/**
 * Tile Entity File
 *
 * PHP Version 7.2
 *
 * @category Tile
 * @package  App\Entity
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TileRepository")
 */
class Tile
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
    private $type;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(
     *     value = 0
     * )
     */
    private $coordX;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(
     *     value = 0
     * )
     */
    private $coordY;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasTreasure = false;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $challengeDay;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCoordX(): ?int
    {
        return $this->coordX;
    }

    public function setCoordX(int $coordX): self
    {
        $this->coordX = $coordX;

        return $this;
    }

    public function getCoordY(): ?int
    {
        return $this->coordY;
    }

    public function setCoordY(int $coordY): self
    {
        $this->coordY = $coordY;

        return $this;
    }

    public function getHasTreasure(): ?bool
    {
        return $this->hasTreasure;
    }

    public function setHasTreasure(bool $hasTreasure): self
    {
        $this->hasTreasure = $hasTreasure;

        return $this;
    }

    public function getChallengeDay(): ?string
    {
        return $this->challengeDay;
    }

    public function setChallengeDay(?string $challengeDay): self
    {
        $this->challengeDay = $challengeDay;

        return $this;
    }

}

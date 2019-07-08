<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BathroomRepository")
 */
class Bathroom
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $bathroomArea;

    /**
     * @ORM\Column(type="integer")
     */
    private $bathroomBath;

    /**
     * @ORM\Column(type="datetime")
     */
    private $bathroomDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $bathroomGround;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $bathroomHeight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bathroomProjectName;

    /**
     * @ORM\Column(type="integer")
     */
    private $bathroomShower;

    /**
     * @ORM\Column(type="integer")
     */
    private $bathroomSink;

    /**
     * @ORM\Column(type="integer")
     */
    private $bathroomWC;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(){

        return (new Slugify())->slugify($this->bathroomProjectName);
    }

    public function getBathroomArea()
    {
        return $this->bathroomArea;
    }

    public function setBathroomArea($bathroomArea): self
    {
        $this->bathroomArea = $bathroomArea;

        return $this;
    }

    public function getBathroomBath(): ?int
    {
        return $this->bathroomBath;
    }

    public function setBathroomBath(int $bathroomBath): self
    {
        $this->bathroomBath = $bathroomBath;

        return $this;
    }

    public function getBathroomDate(): ?\DateTimeInterface
    {
        return $this->bathroomDate;
    }

    public function setBathroomDate(\DateTimeInterface $bathroomDate): self
    {
        $this->bathroomDate = $bathroomDate;

        return $this;
    }

    public function getBathroomGround(): ?int
    {
        return $this->bathroomGround;
    }

    public function setBathroomGround(int $bathroomGround): self
    {
        $this->bathroomGround = $bathroomGround;

        return $this;
    }

    public function getBathroomHeight()
    {
        return $this->bathroomHeight;
    }

    public function setBathroomHeight($bathroomHeight): self
    {
        $this->bathroomHeight = $bathroomHeight;

        return $this;
    }

    public function getBathroomProjectName(): ?string
    {
        return $this->bathroomProjectName;
    }

    public function setBathroomProjectName(string $bathroomProjectName): self
    {
        $this->bathroomProjectName = $bathroomProjectName;

        return $this;
    }

    public function getBathroomShower(): ?int
    {
        return $this->bathroomShower;
    }

    public function setBathroomShower(int $bathroomShower): self
    {
        $this->bathroomShower = $bathroomShower;

        return $this;
    }

    public function getBathroomSink(): ?int
    {
        return $this->bathroomSink;
    }

    public function setBathroomSink(int $bathroomSink): self
    {
        $this->bathroomSink = $bathroomSink;

        return $this;
    }

    public function getBathroomWC(): ?int
    {
        return $this->bathroomWC;
    }

    public function setBathroomWC(int $bathroomWC): self
    {
        $this->bathroomWC = $bathroomWC;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}

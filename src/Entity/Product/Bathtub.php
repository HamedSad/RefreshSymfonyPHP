<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BathtubRepository")
 */
class Bathtub
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
    private $bathtubName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bathtubPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bathtubUrlImage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBathtubName(): ?string
    {
        return $this->bathtubName;
    }

    public function setBathtubName(string $bathtubName): self
    {
        $this->bathtubName = $bathtubName;

        return $this;
    }

    public function getBathtubPrice(): ?string
    {
        return $this->bathtubPrice;
    }

    public function setBathtubPrice(string $bathtubPrice): self
    {
        $this->bathtubPrice = $bathtubPrice;

        return $this;
    }

    public function getBathtubUrlImage(): ?string
    {
        return $this->bathtubUrlImage;
    }

    public function setBathtubUrlImage(string $bathtubUrlImage): self
    {
        $this->bathtubUrlImage = $bathtubUrlImage;

        return $this;
    }
}

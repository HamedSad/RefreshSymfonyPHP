<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ToiletsRepository")
 */
class Toilets
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
    private $toiletsName;

    /**
     * @ORM\Column(type="float")
     */
    private $toiletsPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $toiletsUrlImage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToiletsName(): ?string
    {
        return $this->toiletsName;
    }

    public function setToiletsName(string $toiletsName): self
    {
        $this->toiletsName = $toiletsName;

        return $this;
    }

    public function getToiletsPrice(): ?float
    {
        return $this->toiletsPrice;
    }

    public function setToiletsPrice(float $toiletsPrice): self
    {
        $this->toiletsPrice = $toiletsPrice;

        return $this;
    }

    public function getToiletsUrlImage(): ?string
    {
        return $this->toiletsUrlImage;
    }

    public function setToiletsUrlImage(string $toiletsUrlImage): self
    {
        $this->toiletsUrlImage = $toiletsUrlImage;

        return $this;
    }
}

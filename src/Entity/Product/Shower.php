<?php

namespace App\Entity\Product;
use Cocur\Slugify\Slugify;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Product\ShowerRepository")
 */
class Shower
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
    private $showerName;

    /**
     * @ORM\Column(type="float")
     */
    private $showerPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $showerUrlImage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(){

        return (new Slugify())->slugify($this->showerName);
    }

    public function getShowerName(): ?string
    {
        return $this->showerName;
    }

    public function setShowerName(string $showerName): self
    {
        $this->showerName = $showerName;

        return $this;
    }

    public function getShowerPrice(): ?float
    {
        return $this->showerPrice;
    }

    public function setShowerPrice(float $showerPrice): self
    {
        $this->showerPrice = $showerPrice;

        return $this;
    }

    public function getShowerUrlImage(): ?string
    {
        return $this->showerUrlImage;
    }

    public function setShowerUrlImage(string $showerUrlImage): self
    {
        $this->showerUrlImage = $showerUrlImage;

        return $this;
    }
}

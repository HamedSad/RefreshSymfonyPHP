<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Product\PaintRepository")
 */
class Paint
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
    private $paintName;

    /**
     * @ORM\Column(type="float")
     */
    private $paintPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paintUrlImage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(){

        return (new Slugify())->slugify($this->paintName);
    }

    public function getPaintName(): ?string
    {
        return $this->paintName;
    }

    public function setPaintName(string $paintName): self
    {
        $this->paintName = $paintName;

        return $this;
    }

    public function getPaintPrice(): ?float
    {
        return $this->paintPrice;
    }

    public function setPaintPrice(float $paintPrice): self
    {
        $this->paintPrice = $paintPrice;

        return $this;
    }

    public function getPaintUrlImage(): ?string
    {
        return $this->paintUrlImage;
    }

    public function setPaintUrlImage(string $paintUrlImage): self
    {
        $this->paintUrlImage = $paintUrlImage;

        return $this;
    }
}

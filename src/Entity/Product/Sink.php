<?php

namespace App\Entity\Product;
use Cocur\Slugify\Slugify;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SinkRepository")
 */
class Sink
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
    private $sinkName;

    /**
     * @ORM\Column(type="float")
     */
    private $sinkPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sinkUrlImage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(){

        return (new Slugify())->slugify($this->sinkName);
    }

    public function getSinkName(): ?string
    {
        return $this->sinkName;
    }

    public function setSinkName(string $sinkName): self
    {
        $this->sinkName = $sinkName;

        return $this;
    }

    public function getSinkPrice(): ?float
    {
        return $this->sinkPrice;
    }

    public function setSinkPrice(float $sinkPrice): self
    {
        $this->sinkPrice = $sinkPrice;

        return $this;
    }

    public function getSinkUrlImage(): ?string
    {
        return $this->sinkUrlImage;
    }

    public function setSinkUrlImage(string $sinkUrlImage): self
    {
        $this->sinkUrlImage = $sinkUrlImage;

        return $this;
    }
}

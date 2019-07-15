<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{

    const PRODUCT_TYPE = [
        0=>'peinture',
        1=>'baignoire',
        2=>'douches',
        3=>'lavabo',
        4=>'toilettes'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productName;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $productPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productUrlImage;

    /**
     * @ORM\Column(type="integer")
     */
    private $productType;

    public function getSlug(){

        return (new Slugify())->slugify($this->productName);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductPrice()
    {
        return $this->productPrice;
    }

    public function setProductPrice($productPrice): self
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    public function getProductUrlImage(): ?string
    {
        return $this->productUrlImage;
    }

    public function setProductUrlImage(string $productUrlImage): self
    {
        $this->productUrlImage = $productUrlImage;

        return $this;
    }

    public function getProductType(): ?int
    {
        return $this->productType;
    }

    public function setProductType(int $productType): self
    {
        $this->productType = $productType;

        return $this;
    }

    public function getProductType2() : string {
        return self::PRODUCT_TYPE[$this->productType];

    }
}

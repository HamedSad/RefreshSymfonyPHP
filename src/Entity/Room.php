<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $roomArea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $roomDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $roomGround;

    /**
     * @ORM\Column(type="integer")
     */
    private $roomHeight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roomProjectName;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(){

        return (new Slugify())->slugify($this->roomProjectName);
    }

    public function getRoomArea(): ?int
    {
        return $this->roomArea;
    }

    public function setRoomArea(int $roomArea): self
    {
        $this->roomArea = $roomArea;

        return $this;
    }

    public function getRoomDate(): ?\DateTimeInterface
    {
        return $this->roomDate;
    }

    public function setRoomDate(\DateTimeInterface $roomDate): self
    {
        $this->roomDate = $roomDate;

        return $this;
    }

    public function getRoomGround(): ?int
    {
        return $this->roomGround;
    }

    public function setRoomGround(int $roomGround): self
    {
        $this->roomGround = $roomGround;

        return $this;
    }

    public function getRoomHeight(): ?int
    {
        return $this->roomHeight;
    }

    public function setRoomHeight(int $roomHeight): self
    {
        $this->roomHeight = $roomHeight;

        return $this;
    }

    public function getRoomProjectName(): ?string
    {
        return $this->roomProjectName;
    }

    public function setRoomProjectName(string $roomProjectName): self
    {
        $this->roomProjectName = $roomProjectName;

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

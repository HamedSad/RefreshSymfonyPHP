<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 * @UniqueEntity("roomProjectName")
 */
class Room
{

    const GROUND = [
        0=>'moquette' ,
        1=>'lino',
        2=>'parquet',
        3=>'carrelage',
        4=>'autre'];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
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
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $roomHeight;

    /**
     *
     * @Assert\Length( min = 10,  
     * minMessage = "La description doit comporter au minimum {{ limit }} caractères")
     * @ORM\Column(type="string", length=255)
     */
    private $roomProjectName;

    /**
     *
     * @ORM\Column(type="integer")
     */
    private $userId;

    public function __construct(){
        $this->roomDate = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(){

        return (new Slugify())->slugify($this->roomProjectName);
    }

    public function getRoomArea()
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

    public function getFormatedDate() : string{
        return date_format($this->roomDate, date('d-m-Y'));
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

    public function getGroundType() : string {
        return self::GROUND[$this->roomGround];

    }

    public function getRoomHeight(){
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

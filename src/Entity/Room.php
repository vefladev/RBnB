<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToOne(targetEntity: House::class, inversedBy: 'rooms')]
    private $house;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: RoomLine::class, orphanRemoval: true, cascade: ["persist"])]
    private $roomLines;

    public function __construct()
    {
        $this->roomLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHouse(): ?House
    {
        return $this->house;
    }

    public function setHouse(?House $house): self
    {
        $this->house = $house;

        return $this;
    }

    /**
     * @return Collection<int, RoomLine>
     */
    public function getRoomLines(): Collection
    {
        return $this->roomLines;
    }

    public function addRoomLine(RoomLine $roomLine): self
    {
        if (!$this->roomLines->contains($roomLine)) {
            $this->roomLines[] = $roomLine;
            $roomLine->setRoom($this);
        }

        return $this;
    }

    public function removeRoomLine(RoomLine $roomLine): self
    {
        if ($this->roomLines->removeElement($roomLine)) {
            if ($roomLine->getRoom() === $this) {
                $roomLine->setRoom(null);
            }
        }

        return $this;
    }
}

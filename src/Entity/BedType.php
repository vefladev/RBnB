<?php

namespace App\Entity;

use App\Repository\BedTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BedTypeRepository::class)]
class BedType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $place;

    #[ORM\Column(type: 'string', length: 150)]
    private $size;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'bedType', targetEntity: RoomLine::class)]
    private $roomLine;

    public function __construct()
    {
        $this->roomLine = new ArrayCollection();
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

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(int $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

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

    /**
     * @return Collection<int, RoomLine>
     */
    public function getRoomLine(): Collection
    {
        return $this->roomLine;
    }

    public function addRoomLine(RoomLine $roomLine): self
    {
        if (!$this->roomLine->contains($roomLine)) {
            $this->roomLine[] = $roomLine;
            $roomLine->setBedType($this);
        }

        return $this;
    }

    public function removeRoomLine(RoomLine $roomLine): self
    {
        if ($this->roomLine->removeElement($roomLine)) {
            if ($roomLine->getBedType() === $this) {
                $roomLine->setBedType(null);
            }
        }

        return $this;
    }
}

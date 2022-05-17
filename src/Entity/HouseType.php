<?php

namespace App\Entity;

use App\Repository\HouseTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HouseTypeRepository::class)]
class HouseType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'houseType', targetEntity: House::class)]
    private $house;

    public function __construct()
    {
        $this->house = new ArrayCollection();
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

    /**
     * @return Collection<int, House>
     */
    public function getHouse(): Collection
    {
        return $this->house;
    }

    public function addHouse(House $house): self
    {
        if (!$this->house->contains($house)) {
            $this->house[] = $house;
            $house->setHouseType($this);
        }

        return $this;
    }

    public function removeHouse(House $house): self
    {
        if ($this->house->removeElement($house)) {
            if ($house->getHouseType() === $this) {
                $house->setHouseType(null);
            }
        }

        return $this;
    }
}

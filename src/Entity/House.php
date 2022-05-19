<?php

namespace App\Entity;

use App\Repository\HouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HouseRepository::class)]
class House
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adress;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $city;

    #[ORM\Column(type: 'string', length: 8)]
    private $zipcode;

    #[ORM\Column(type: 'float', nullable: true)]
    private $pricePerNight;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $available;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photo;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $longitude;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lattitude;

    #[ORM\OneToMany(mappedBy: 'house', targetEntity: Booking::class)]
    private $bookingId;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'houses')]
    #[ORM\JoinColumn(nullable: false)]
    private $person;

    #[ORM\ManyToOne(targetEntity: HouseType::class, inversedBy: 'house')]
    private $houseType;

    #[ORM\OneToMany(mappedBy: 'house', targetEntity: Room::class)]
    private $rooms;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    public function __construct()
    {
        $this->bookingId = new ArrayCollection();
        $this->rooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getPricePerNight(): ?float
    {
        return $this->pricePerNight;
    }

    public function setPricePerNight(?float $pricePerNight): self
    {
        $this->pricePerNight = $pricePerNight;

        return $this;
    }

    public function getAvailable(): ?int
    {
        return $this->available;
    }

    public function setAvailable(?int $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

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

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLattitude(): ?string
    {
        return $this->lattitude;
    }

    public function setLattitude(?string $lattitude): self
    {
        $this->lattitude = $lattitude;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookingId(): Collection
    {
        return $this->bookingId;
    }

    public function addBookingId(Booking $bookingId): self
    {
        if (!$this->bookingId->contains($bookingId)) {
            $this->bookingId[] = $bookingId;
            $bookingId->setHouse($this);
        }

        return $this;
    }

    public function removeBookingId(Booking $bookingId): self
    {
        if ($this->bookingId->removeElement($bookingId)) {
            if ($bookingId->getHouse() === $this) {
                $bookingId->setHouse(null);
            }
        }

        return $this;
    }

    public function getPerson(): ?User
    {
        return $this->person;
    }

    public function setPerson(?User $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getHouseType(): ?HouseType
    {
        return $this->houseType;
    }

    public function setHouseType(?HouseType $houseType): self
    {
        $this->houseType = $houseType;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setHouse($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            if ($room->getHouse() === $this) {
                $room->setHouse(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}

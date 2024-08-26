<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['vehicles.index'])]
    private ?string $brand = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['vehicles.index'])]
    private ?string $model = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['vehicles.index'])]
    private ?string $version = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['vehicles.index'])]
    private ?string $year = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['vehicles.index'])]
    private ?string $energy = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['vehicles.index'])]
    private ?int $power = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['vehicles.index'])]
    private ?int $price = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['vehicles.index'])]
    private ?int $priceRetail = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['vehicles.index'])]
    private ?int $priceMonthly = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    #[Groups(['vehicles.index'])]
    private ?array $pics = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gearbox = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(?string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getEnergy(): ?string
    {
        return $this->energy;
    }

    public function setEnergy(?string $energy): static
    {
        $this->energy = $energy;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(?int $power): static
    {
        $this->power = $power;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPriceRetail(): ?int
    {
        return $this->priceRetail;
    }

    public function setPriceRetail(?int $priceRetail): static
    {
        $this->priceRetail = $priceRetail;

        return $this;
    }

    public function getPriceMonthly(): ?int
    {
        return $this->priceMonthly;
    }

    public function setPriceMonthly(?int $priceMonthly): static
    {
        $this->priceMonthly = $priceMonthly;

        return $this;
    }

    public function getPics(): ?array
    {
        return $this->pics;
    }

    public function setPics(?array $pics): static
    {
        $this->pics = $pics;

        return $this;
    }

    public function getGearbox(): ?string
    {
        return $this->gearbox;
    }

    public function setGearbox(?string $gearbox): static
    {
        $this->gearbox = $gearbox;

        return $this;
    }
}

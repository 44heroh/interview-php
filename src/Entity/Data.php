<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DataRepository::class)]
#[ApiResource]
class Data
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $min = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $max = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMin(): ?string
    {
        return $this->min;
    }

    public function setMin(string $min): static
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?string
    {
        return $this->max;
    }

    public function setMax(string $max): static
    {
        $this->max = $max;

        return $this;
    }
}

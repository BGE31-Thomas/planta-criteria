<?php

namespace App\Entity;

use App\Repository\ObservationCritereRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ObservationCritereRepository::class)]
class ObservationCritere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'observationsCritere')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Observation $observation = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Critere $critere = null;

    #[ORM\Column(type: 'boolean')]
    private bool $valeur = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObservation(): ?Observation
    {
        return $this->observation;
    }

    public function setObservation(?Observation $observation): self
    {
        $this->observation = $observation;
        return $this;
    }

    public function getCritere(): ?Critere
    {
        return $this->critere;
    }

    public function setCritere(?Critere $critere): self
    {
        $this->critere = $critere;
        return $this;
    }

    public function isValeur(): bool
    {
        return $this->valeur;
    }

    public function setValeur(bool $valeur): self
    {
        $this->valeur = $valeur;
        return $this;
    }
}


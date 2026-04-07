<?php

namespace App\Entity;

use App\Repository\ObservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObservationRepository::class)]
class Observation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $date_heure = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\OneToMany(mappedBy: 'observation', targetEntity: ObservationCritere::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $observationsCritere;

    public function __construct()
    {
        $this->observationsCritere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeure(): ?\DateTime
    {
        return $this->date_heure;
    }

    public function setDateHeure(\DateTime $date_heure): static
    {
        $this->date_heure = $date_heure;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getObservationsCritere(): Collection
    {
        return $this->observationsCritere;
    }

    public function addObservationsCritere(ObservationCritere $oc): self
    {
        if (!$this->observationsCritere->contains($oc)) {
            $this->observationsCritere[] = $oc;
            $oc->setObservation($this); 
        }
    
        return $this;
    }

    public function removeObservationsCritere(ObservationCritere $observationsCritere): static
    {
        if ($this->observationsCritere->removeElement($observationsCritere)) {
            if ($observationsCritere->getObservation() === $this) {
                $observationsCritere->setObservation(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
class Statut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(targetEntity: ObservationCritere::class, mappedBy: "statut")]
    private Collection $observationsCritere;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getObservationsCritere(): Collection
    {
        return $this->observationsCritere;
    }

    public function addObservationCritere(ObservationCritere $observationCritere): self
    {
        if (!$this->observationsCritere->contains($observationCritere)) {
            $this->observationsCritere[] = $observationCritere;
            $observationCritere->setStatut($this);
        }

        return $this;
    }

    public function removeObservationCritere(ObservationCritere $observationCritere): self
    {
        if ($this->observationsCritere->removeElement($observationCritere)) {
            
            if ($observationCritere->getStatut() === $this) {
                $observationCritere->setStatut(null);
            }
        }

        return $this;
    }

}

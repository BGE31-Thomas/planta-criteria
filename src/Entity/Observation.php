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

    #[ORM\ManyToOne(inversedBy: 'observations', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private Serie $serie;

    #[ORM\ManyToOne(inversedBy: 'observations')]
    #[ORM\JoinColumn(name: "plante_id", referencedColumnName: "cd_nom")]
    private ?Taxref $plante = null;

    #[ORM\OneToMany(
        mappedBy: 'observation',
        targetEntity: ObservationCritere::class,
        cascade: ['persist'],
        orphanRemoval: true
    )]
    private Collection $observationsCritere;

    public function __construct()
    {
        $this->observationsCritere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerie(): Serie
    {
        return $this->serie;
    }

    public function setSerie(Serie $serie): self
    {
        $this->serie = $serie;

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

    public function getPlante(): ?Taxref
    {
        return $this->plante;
    }

    public function setPlante(?Taxref $plante): static
    {
        $this->plante = $plante;

        return $this;
    }
}

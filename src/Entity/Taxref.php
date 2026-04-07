<?php

namespace App\Entity;

use App\Repository\TaxrefRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxrefRepository::class)]
class Taxref
{
    #[ORM\Id]
    #[ORM\Column(type: Types::BIGINT)]
    private ?int $cd_nom = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?int $cd_ref = null;

    #[ORM\Column(length: 255)]
    private ?string $famille = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_complet_html = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(targetEntity: Taxref::class)]
    #[ORM\JoinColumn(name: "cd_ref", referencedColumnName: "cd_nom")]
    private Taxref $nomValide;

    #[ORM\OneToMany(targetEntity: Taxref::class, mappedBy: "nomValide")]
    private Collection $synonymes;

    #[ORM\OneToMany(targetEntity: Critere::class, mappedBy: "plante")]
    private Collection $criteres;

     public function __construct()
    {
        $this->synonymes = new ArrayCollection();
        $this->criteres = new ArrayCollection();
    }


    public function getCdNom(): ?int
    {
        return $this->cd_nom;
    }

    public function setCdNom(int $cd_nom): static
    {
        $this->cd_nom = $cd_nom;

        return $this;
    }

    public function getCdRef(): ?int
    {
        return $this->cd_ref;
    }

    public function setCdRef(int $cd_ref): static
    {
        $this->cd_ref = $cd_ref;

        return $this;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(string $famille): static
    {
        $this->famille = $famille;

        return $this;
    }

    public function getNomCompletHtml(): ?string
    {
        return $this->nom_complet_html;
    }

    public function setNomCompletHtml(string $nom_complet_html): static
    {
        $this->nom_complet_html = $nom_complet_html;

        return $this;
    }

    public function getSynonymes(): Collection
    {
        return $this->synonymes;
    }

    public function addSynonyme(Taxref $synonyme): static
    {
        if (!$this->synonymes->contains($synonyme)) {
            $this->synonymes->add($synonyme);
        }

        return $this;
    }

    public function removeSynonyme(Taxref $synonyme): static
    {
        $this->synonymes->removeElement($synonyme);

        return $this;
    }

    public function getNomValide(): ?Taxref
    {
        return $this->nomValide;
    }

     public function getCriteres(): Collection
    {
        return $this->criteres;
    }

    public function addCritere(Taxref $critere): static
    {
        if (!$this->criteres->contains($critere)) {
            $this->criteres->add($critere);
        }

        return $this;
    }

    public function removeCritere(Taxref $critere): static
    {
        $this->criteres->removeElement($critere);

        return $this;
    }

    public function setNomValide(?Taxref $nomValide): static
    {
        $this->nomValide = $nomValide;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

}

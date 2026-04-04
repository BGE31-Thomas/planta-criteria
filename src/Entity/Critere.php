<?php

namespace App\Entity;

use App\Repository\CritereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CritereRepository::class)]
class Critere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $organe = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: "critere")]
    private Collection $images;

    #[ORM\ManyToOne(targetEntity: Taxref::class)]
    #[ORM\JoinColumn(name: "plante_id", referencedColumnName: "cd_nom")]
    private ?Taxref $plante;

    #[ORM\ManyToOne(targetEntity: Source::class)]
    #[ORM\JoinColumn(name: "source_id", referencedColumnName: "id", nullable: true)]
    private ?Source $source = null;

    public function __construct()
    {
        $this->images = new ArrayCollection(); 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrgane(): ?string
    {
        return $this->organe;
    }

    public function setOrgane(string $organe): static
    {
        $this->organe = $organe;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function removeImage (Image $image): static
    {
        $this->images->removeElement($image);

        return $this;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setCritere($this); 
        }

        return $this;
    }

    public function setPlante(Taxref $plante): static
    {
        $this->plante = $plante;

        return $this;
    }

    public function getPlante(): ?Taxref
    {
        return $this->plante;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): static
    {
        $this->source = $source;

        return $this;
    }
}

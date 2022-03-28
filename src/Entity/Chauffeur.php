<?php

namespace App\Entity;

use App\Repository\ChauffeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChauffeurRepository::class)
 */
class Chauffeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numChauffeur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomChauffeur;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="chauffeurs")
     */
    private $numVoiture;

    /**
     * @ORM\ManyToOne(targetEntity=Parking::class, inversedBy="chauffeurs")
     */
    private $numParking;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumChauffeur(): ?string
    {
        return $this->numChauffeur;
    }

    public function setNumChauffeur(string $numChauffeur): self
    {
        $this->numChauffeur = $numChauffeur;

        return $this;
    }

    public function getNomChauffeur(): ?string
    {
        return $this->nomChauffeur;
    }

    public function setNomChauffeur(string $nomChauffeur): self
    {
        $this->nomChauffeur = $nomChauffeur;

        return $this;
    }

    public function __toString()
    {
        return $this->numChauffeur;
    }

    public function getNumVoiture(): ?Voiture
    {
        return $this->numVoiture;
    }

    public function setNumVoiture(?Voiture $numVoiture): self
    {
        $this->numVoiture = $numVoiture;

        return $this;
    }

    public function getNumParking(): ?Parking
    {
        return $this->numParking;
    }

    public function setNumParking(?Parking $numParking): self
    {
        $this->numParking = $numParking;

        return $this;
    }
}

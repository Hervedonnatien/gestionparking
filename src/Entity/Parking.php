<?php

namespace App\Entity;

use App\Repository\ParkingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParkingRepository::class)
 */
class Parking
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
    private $numParking;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reservation;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="parkings")
     */
    private $numVoiture;

    /**
     * @ORM\OneToMany(targetEntity=Chauffeur::class, mappedBy="numParking")
     */
    private $chauffeurs;

    public function __construct()
    {
        $this->chauffeurs = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumParking(): ?string
    {
        return $this->numParking;
    }

    public function setNumParking(string $numParking): self
    {
        $this->numParking = $numParking;

        return $this;
    }

    public function getReservation(): ?string
    {
        return $this->reservation;
    }

    public function setReservation(string $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function __toString()
    {
        return $this->numParking;
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

    /**
     * @return Collection|Chauffeur[]
     */
    public function getChauffeurs(): Collection
    {
        return $this->chauffeurs;
    }

    public function addChauffeur(Chauffeur $chauffeur): self
    {
        if (!$this->chauffeurs->contains($chauffeur)) {
            $this->chauffeurs[] = $chauffeur;
            $chauffeur->setNumParking($this);
        }

        return $this;
    }

    public function removeChauffeur(Chauffeur $chauffeur): self
    {
        if ($this->chauffeurs->contains($chauffeur)) {
            $this->chauffeurs->removeElement($chauffeur);
            // set the owning side to null (unless already changed)
            if ($chauffeur->getNumParking() === $this) {
                $chauffeur->setNumParking(null);
            }
        }

        return $this;
    }
}

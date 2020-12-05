<?php

namespace App\Entity;

use App\Repository\IntermediaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IntermediaireRepository::class)
 */
class Intermediaire
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
    private $role;

    /**
     * @ORM\Column(type="integer")
     */
    private $idPaiement;

    /**
     * @ORM\Column(type="integer")
     */
    private $numContrat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getIdPaiement(): ?int
    {
        return $this->idPaiement;
    }

    public function setIdPaiement(int $idPaiement): self
    {
        $this->idPaiement = $idPaiement;

        return $this;
    }

    public function getNumContrat(): ?int
    {
        return $this->numContrat;
    }

    public function setNumContrat(int $numContrat): self
    {
        $this->numContrat = $numContrat;

        return $this;
    }
}

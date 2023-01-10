<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_Session = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_Debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_Fin = null;

    #[ORM\Column]
    private ?int $nombre_Place = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSession(): ?string
    {
        return $this->nom_Session;
    }

    public function setNomSession(string $nom_Session): self
    {
        $this->nom_Session = $nom_Session;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_Debut;
    }

    public function setDateDebut(\DateTimeInterface $date_Debut): self
    {
        $this->date_Debut = $date_Debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_Fin;
    }

    public function setDateFin(\DateTimeInterface $date_Fin): self
    {
        $this->date_Fin = $date_Fin;

        return $this;
    }

    public function getNombrePlace(): ?int
    {
        return $this->nombre_Place;
    }

    public function setNombrePlace(int $nombre_Place): self
    {
        $this->nombre_Place = $nombre_Place;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\StagiaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StagiaireRepository::class)]
class Stagiaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_Stagiaire = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom_Stagiaire = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse_Stagiaire = null;

    #[ORM\Column(length: 50)]
    private ?string $mail_Stagiaire = null;

    #[ORM\Column(length: 10)]
    private ?string $tel_Stagiaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_Naissance = null;

    #[ORM\Column(length: 10)]
    private ?string $sexe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStagiaire(): ?string
    {
        return $this->nom_Stagiaire;
    }

    public function setNomStagiaire(string $nom_Stagiaire): self
    {
        $this->nom_Stagiaire = $nom_Stagiaire;

        return $this;
    }

    public function getPrenomStagiaire(): ?string
    {
        return $this->prenom_Stagiaire;
    }

    public function setPrenomStagiaire(string $prenom_Stagiaire): self
    {
        $this->prenom_Stagiaire = $prenom_Stagiaire;

        return $this;
    }

    public function getAdresseStagiaire(): ?string
    {
        return $this->adresse_Stagiaire;
    }

    public function setAdresseStagiaire(string $adresse_Stagiaire): self
    {
        $this->adresse_Stagiaire = $adresse_Stagiaire;

        return $this;
    }

    public function getMailStagiaire(): ?string
    {
        return $this->mail_Stagiaire;
    }

    public function setMailStagiaire(string $mail_Stagiaire): self
    {
        $this->mail_Stagiaire = $mail_Stagiaire;

        return $this;
    }

    public function getTelStagiaire(): ?string
    {
        return $this->tel_Stagiaire;
    }

    public function setTelStagiaire(string $tel_Stagiaire): self
    {
        $this->tel_Stagiaire = $tel_Stagiaire;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_Naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_Naissance): self
    {
        $this->date_Naissance = $date_Naissance;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormateurRepository::class)]
class Formateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_Formateur = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom_Formateur = null;

    #[ORM\Column(length: 50)]
    private ?string $mail_Formateur = null;

    #[ORM\Column(length: 10)]
    private ?string $tel_Formateur = null;

    #[ORM\OneToMany(mappedBy: 'formateur', targetEntity: Session::class)]
    private Collection $sessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFormateur(): ?string
    {
        return $this->nom_Formateur;
    }

    public function setNomFormateur(string $nom_Formateur): self
    {
        $this->nom_Formateur = $nom_Formateur;

        return $this;
    }

    public function getPrenomFormateur(): ?string
    {
        return $this->prenom_Formateur;
    }

    public function setPrenomFormateur(string $prenom_Formateur): self
    {
        $this->prenom_Formateur = $prenom_Formateur;

        return $this;
    }

    public function getMailFormateur(): ?string
    {
        return $this->mail_Formateur;
    }

    public function setMailFormateur(string $mail_Formateur): self
    {
        $this->mail_Formateur = $mail_Formateur;

        return $this;
    }

    public function getTelFormateur(): ?string
    {
        return $this->tel_Formateur;
    }

    public function setTelFormateur(string $tel_Formateur): self
    {
        $this->tel_Formateur = $tel_Formateur;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
            $session->setFormateur($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getFormateur() === $this) {
                $session->setFormateur(null);
            }
        }

        return $this;
    }
}

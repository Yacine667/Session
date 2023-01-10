<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammeRepository::class)]
class Programme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $duree_Programme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDureeProgramme(): ?int
    {
        return $this->duree_Programme;
    }

    public function setDureeProgramme(int $duree_Programme): self
    {
        $this->duree_Programme = $duree_Programme;

        return $this;
    }
}

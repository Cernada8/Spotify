<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
class Perfil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fofoto = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\ManyToOne(inversedBy: 'perfiles')]
    private ?Estilo $estiloMusicalPreferido = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFofoto(): ?string
    {
        return $this->fofoto;
    }

    public function setFofoto(string $fofoto): static
    {
        $this->fofoto = $fofoto;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getEstiloMusicalPreferido(): ?Estilo
    {
        return $this->estiloMusicalPreferido;
    }

    public function setEstiloMusicalPreferido(?Estilo $estiloMusicalPreferido): static
    {
        $this->estiloMusicalPreferido = $estiloMusicalPreferido;

        return $this;
    }
}

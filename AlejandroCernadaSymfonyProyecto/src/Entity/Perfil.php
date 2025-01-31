<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
class Perfil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $foto = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Estilo>
     */
    #[ORM\ManyToMany(targetEntity: Estilo::class, inversedBy: 'perfiles')]
    private Collection $estilosPreferidos;

    public function __construct()
    {
        $this->estilosPreferidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): static
    {
        $this->foto = $foto;

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

    /**
     * @return Collection<int, Estilo>
     */
    public function getEstilosPreferidos(): Collection
    {
        return $this->estilosPreferidos;
    }

    public function addEstilosPreferido(Estilo $estilosPreferido): static
    {
        if (!$this->estilosPreferidos->contains($estilosPreferido)) {
            $this->estilosPreferidos->add($estilosPreferido);
        }

        return $this;
    }

    public function removeEstilosPreferido(Estilo $estilosPreferido): static
    {
        $this->estilosPreferidos->removeElement($estilosPreferido);

        return $this;
    }
}

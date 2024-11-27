<?php

namespace App\Entity;

use App\Repository\MedicamentoUsuarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicamentoUsuarioRepository::class)]
class MedicamentoUsuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'medicamentos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $id_usuario = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medicamento $id_medicamento = null;

    #[ORM\Column(nullable: true)]
    private ?float $doses_administradas = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(?Usuario $id_usuario): static
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getIdMedicamento(): ?Medicamento
    {
        return $this->id_medicamento;
    }

    public function setIdMedicamento(?Medicamento $id_medicamento): static
    {
        $this->id_medicamento = $id_medicamento;

        return $this;
    }

    public function getDosesAdministradas(): ?float
    {
        return $this->doses_administradas;
    }

    public function setDosesAdministradas(?float $doses_administradas): static
    {
        $this->doses_administradas = $doses_administradas;

        return $this;
    }
}

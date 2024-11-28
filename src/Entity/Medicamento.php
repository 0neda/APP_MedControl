<?php

namespace App\Entity;

use App\Enum\EnumTipoEstoque;
use App\Enum\EnumUnidadeEstoque;
use App\Repository\MedicamentoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicamentoRepository::class)]
class Medicamento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $anotacao = null;

    #[ORM\Column(enumType: EnumTipoEstoque::class)]
    private ?EnumTipoEstoque $tipo_estoque = null;

    #[ORM\Column(enumType: EnumUnidadeEstoque::class)]
    private ?EnumUnidadeEstoque $unidade_estoque = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $frequencia_horas = null;

    /**
     * @var Collection<int, Componente>
     */
    #[ORM\OneToMany(targetEntity: Componente::class, mappedBy: 'id_medicamento', orphanRemoval: true)]
    private Collection $componentes;

    #[ORM\Column]
    private ?float $qtd_estoque = null;

    #[ORM\Column]
    private ?float $medida_dose = null;

    #[ORM\Column]
    private ?int $qtd_dose = null;

    public function __construct()
    {
        $this->componentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getAnotacao(): ?string
    {
        return $this->anotacao;
    }

    public function setAnotacao(?string $anotacao): static
    {
        $this->anotacao = $anotacao;

        return $this;
    }

    public function getTipoEstoqueStr(): ?string
    {
        return $this->tipo_estoque->value;
    }

    public function getTipoEstoque(): ?EnumTipoEstoque
    {
        return $this->tipo_estoque;
    }

    public function setTipoEstoque(EnumTipoEstoque $tipo_estoque): static
    {
        $this->tipo_estoque = $tipo_estoque;

        return $this;
    }

    public function getUnidadeEstoqueStr(): ?string
    {
        return $this->unidade_estoque->value;
    }

    public function getUnidadeEstoque(): ?EnumUnidadeEstoque
    {
        return $this->unidade_estoque;
    }

    public function setUnidadeEstoque(EnumUnidadeEstoque $unidade_estoque): static
    {
        $this->unidade_estoque = $unidade_estoque;

        return $this;
    }

    public function getFrequenciaHoras(): ?int
    {
        return $this->frequencia_horas;
    }

    public function setFrequenciaHoras(int $frequencia_horas): static
    {
        $this->frequencia_horas = $frequencia_horas;

        return $this;
    }

    public function getQtdEstoque(): ?float
    {
        return $this->qtd_estoque;
    }

    public function setQtdEstoque(float $qtd_estoque): static
    {
        $this->qtd_estoque = $qtd_estoque;

        return $this;
    }

    public function scheduleNotification(): void
    {
        // Logic to schedule notification using $this->id and $this->recurrenceTime
    }

    /**
     * @return Collection<int, Componente>
     */
    public function getComponentes(): Collection
    {
        return $this->componentes;
    }

    public function addComponente(Componente $componente): static
    {
        if (!$this->componentes->contains($componente)) {
            $this->componentes->add($componente);
            $componente->setIdMedicamento($this);
        }

        return $this;
    }

    public function removeComponente(Componente $componente): static
    {
        if ($this->componentes->removeElement($componente)) {
            // set the owning side to null (unless already changed)
            if ($componente->getIdMedicamento() === $this) {
                $componente->setIdMedicamento(null);
            }
        }

        return $this;
    }

    public function getMedidaDose(): ?float
    {
        return $this->medida_dose;
    }

    public function setMedidaDose(float $medida_dose): static
    {
        $this->medida_dose = $medida_dose;

        return $this;
    }

    public function getQtdDose(): ?int
    {
        return $this->qtd_dose;
    }

    public function setQtdDose(int $qtd_dose): static
    {
        $this->qtd_dose = $qtd_dose;

        return $this;
    }
}
<?php

namespace App\Entity;

use App\Enum\EnumUnidadeEstoque;
use App\Repository\EstoqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstoqueRepository::class)]
class Estoque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'estoque', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medicamento $id_medicamento = null;

    #[ORM\Column]
    private ?float $quantidade = null;

    #[ORM\Column(enumType: EnumUnidadeEstoque::class)]
    private ?EnumUnidadeEstoque $unidade = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $data_atualizacao = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMedicamento(): ?Medicamento
    {
        return $this->id_medicamento;
    }

    public function setIdMedicamento(Medicamento $id_medicamento): static
    {
        $this->id_medicamento = $id_medicamento;

        return $this;
    }

    public function getQuantidade(): ?float
    {
        return $this->quantidade;
    }

    public function setQuantidade(float $quantidade): static
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    public function getUnidade(): ?EnumUnidadeEstoque
    {
        return $this->unidade;
    }

    public function setUnidade(EnumUnidadeEstoque $unidade): static
    {
        $this->unidade = $unidade;

        return $this;
    }

    public function getDataAtualizacao(): ?\DateTimeInterface
    {
        return $this->data_atualizacao;
    }

    public function setDataAtualizacao(?\DateTimeInterface $data_atualizacao): static
    {
        $this->data_atualizacao = $data_atualizacao;

        return $this;
    }
}

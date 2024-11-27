<?php

namespace App\Entity;

use App\Enum\EnumUnidadeConcentracao;
use App\Repository\ComponenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComponenteRepository::class)]
class Componente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'componentes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medicamento $id_medicamento = null;

    #[ORM\Column(length: 255)]
    private ?string $nome_principio_ativo = null;

    #[ORM\Column]
    private ?float $concentracao_valor = null;

    #[ORM\Column(enumType: EnumUnidadeConcentracao::class)]
    private ?EnumUnidadeConcentracao $concentracao_unidade = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomePrincipioAtivo(): ?string
    {
        return $this->nome_principio_ativo;
    }

    public function setNomePrincipioAtivo(string $nome_principio_ativo): static
    {
        $this->nome_principio_ativo = $nome_principio_ativo;

        return $this;
    }

    public function getConcentracaoValor(): ?float
    {
        return $this->concentracao_valor;
    }

    public function setConcentracaoValor(float $concentracao_valor): static
    {
        $this->concentracao_valor = $concentracao_valor;

        return $this;
    }

    public function getConcentracaoUnidade(): ?EnumUnidadeConcentracao
    {
        return $this->concentracao_unidade;
    }

    public function setConcentracaoUnidade(EnumUnidadeConcentracao $concentracao_unidade): static
    {
        $this->concentracao_unidade = $concentracao_unidade;

        return $this;
    }
}

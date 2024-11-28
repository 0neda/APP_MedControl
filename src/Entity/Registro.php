<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Registro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nome_registro = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeArquivo(): ?string
    {
        return $this->nome_registro;
    }

    public function setNomeArquivo(string $nome_registro): self
    {
        $this->nome_registro = $nome_registro;

        return $this;
    }

    public function getTipoArquivo(): string
    {
        $extension = pathinfo($this->nome_registro, PATHINFO_EXTENSION);
        return strtolower($extension);
    }

    public function getNomeRegistro(): ?string
    {
        return $this->nome_registro;
    }

    public function setNomeRegistro(string $nome_registro): static
    {
        $this->nome_registro = $nome_registro;

        return $this;
    }
}
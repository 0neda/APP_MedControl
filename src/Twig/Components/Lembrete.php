<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Lembrete
{
    public string $tipo;
    public string $mensagem;

    public function getIcone(): string
    {
        return match ($this->tipo) {
            'consulta' => '<i class="fa-light fa-hospital text-white"></i>',
            'medicamento' => '<i class="fa-light fa-prescription-bottle-pill"></i>',
            default => '<i class="fa-light fa-bell"></i>',
        };
    }

    public function getMensagem(): string
    {
        return match ($this->tipo) {
            'consulta' => "Você tem uma consulta marcada para hoje.",
            'medicamento' => "Você tem medicamentos a serem tomados.",
            default => 'Teste',
        };
    }

    public function getTipoLembrete(): string
    {
        return match ($this->tipo) {
            'consulta' => 'success',
            'medicamento' => 'error',
            default => 'neutral',
        };
    }
}
<?php

namespace App\Enum;

enum EnumTipoReferenciaLembrete: string
{
    case CONSULTA = 'CONSULTA';
    case MEDICAMENTO = 'MEDICAMENTO';
    case VACINA = 'VACINA';
}
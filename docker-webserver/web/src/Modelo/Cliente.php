<?php

declare(strict_types=1);

namespace App\Modelo;

class Cliente
{
    public string $nomeCompleto;

    public function __construct(string $nomeCompleto)
    {
        $this->nomeCompleto=$nomeCompleto;
    }
}
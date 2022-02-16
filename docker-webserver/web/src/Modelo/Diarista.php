<?php

declare(strict_types=1);

namespace App\Modelo;

class Diarista{
    public string $nome;

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }
}
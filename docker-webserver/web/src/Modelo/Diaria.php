<?php

declare(strict_types=1);

namespace App\Modelo;

class Diaria{
    public string $data;
    public int $tempo;
    public Diarista $diarista;
    public Cliente $cliente;

    public function __construct(string $data, int $tempo, Diarista $diarista, Cliente $cliente)
    {
        $this -> tempo = $tempo;
        $this -> data = $data;
        $this -> diarista = $diarista;
        $this -> cliente = $cliente;
    }

    /**
     * Retorna a lista das diárias
     *
     * @return void
     */
    static public function obterTodas()
    {
        return [
            new self(
                "8/08/2022",
                8,
                new Diarista("José"),
                new Cliente ("Antonio")
            ),
            new self(
                "8/08/2022",
                4,
                new Diarista("João"),
                new Cliente ("Maria")
            ),
            new self(
                "8/08/2022",
                6,
                new Diarista("Matheus"),
                new Cliente ("Debora")
            ),
        ];
    }
}
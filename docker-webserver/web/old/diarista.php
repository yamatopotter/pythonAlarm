<?php

class Pessoa{
    public $nome;
    public $telefone;
    public $endereco;
}

class Cliente extends Pessoa{

}

class Diarista extends Pessoa{
    /**
     * Atende ao Cliente
     *
     * @param string $nomeCliente
     * @return void
     */
    public function atenderCliente($nomeCliente){
        $nomeDiarista = $this->nome;

        echo "<br>$nomeDiarista atendeu ao cliente $nomeCliente. ";
    }

    
    /**
     * Avalia Cliente
     *
     * @param string $nomeCliente
     * @param float $nota
     * @return void
     */
    public function avaliarCliente($nomeCliente, $nota){
        $this->atenderCliente($nomeCliente);

        echo "Avaliou o cliente com a nota $nota.";

    }
}

$maria = new Diarista;
$maria->nome="Maria da Silva";
$maria->telefone="(11) 99999-9999";
$maria->endereco="Endereço da casa da maria";
$maria->avaliarCliente("Joana", 4.5);

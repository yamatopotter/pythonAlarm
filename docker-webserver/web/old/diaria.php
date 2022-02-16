<?php

abstract class Atendimento{
    public $data;
    protected $tempo; //Somente dentro da propria classe
    protected $valor; //Dentro da classe e herdeiros

    public function definirTempo($tempo){
        if($tempo < 1){
            echo "Não é possivel adicionar um tmepo menor que 1";
            return;
        }

        $this->tempo = $tempo;
    }
}

class Diaria extends Atendimento{
    public function definirValor($valor){
        $this->valor = $valor;
    }
}

$d1 = new Diaria;
$d1->definirValor(100.00);
$d1->data = '01/01/2022';
echo $d1->data;

var_dump($d1);
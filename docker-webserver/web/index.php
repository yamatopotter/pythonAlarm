<?php

declare(strict_types=1);

require_once("vendor/autoload.php");

use App\Controlador\Diaria;

$diariaControlador = new Diaria;
$diariaControlador->listar();
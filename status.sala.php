<?php

include "class.contro.php";
include "config.php";

/*
essa pagina tem a funçãode retornar ou exibir status da variael que está no banco que guarda estado do rele
é usado class.controle para obter falor faz select simples.
*/ 

$controle = new Controle($pdo);
$exibe =$controle->getStatus_sala();
echo $exibe;

?>
<?php


include("../conf/conf.php");


/*
essa pagina tem a funçãode retornar ou exibir status da variael que está no banco que guarda estado do rele
é usado class.controle para obter valor faz select simples.

 */


$controle = new Controle($pdo);
$exibe =$controle->getStatus_quarto();
echo $exibe;

?>
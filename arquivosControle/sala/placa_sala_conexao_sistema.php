<?php

include "conf\conf.php";
$controle = new Controle($pdo);

$hora = date("H:i");
$data = date("d/n/Y");





if(isset($_POST['inicia'])){
    $acao = $_POST['inicia'];
    $controle->setStatus_sala_sistema($acao, $hora, $data);

}




?>
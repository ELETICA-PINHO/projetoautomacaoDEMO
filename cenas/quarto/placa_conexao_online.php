<?php

include("../conf/conf.php");
$controle = new Controle($pdo);

$hora = date("H:i");
$data = date("d/n/Y");





if(isset($_POST['conexao'])){
    $acao = $_POST['conexao'];
    $controle->setStatus_quarto_online($acao, $hora, $data);

}




?>
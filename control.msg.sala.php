<?php 

include "class.contro.php";
include "config.php";
$controle = new Controle($pdo);


if(isset($_POST['rele01'])){
    $acao = $_POST['rele01'];
    $controle->setStatus_sala($acao);

}



?>
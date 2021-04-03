<?php 

include("../conf/conf.php");
$controle = new Controle($pdo);

$hora = date("H:i");
$data = date("d/n/Y");
$exevia = "PUL";


if(isset($_POST['rele01'])){
    $acao = $_POST['rele01'];
    $controle->setStatus_quarto($acao);
    $controle->setStatus_quarto_completo($acao, $exevia, $hora, $data);

}



?>
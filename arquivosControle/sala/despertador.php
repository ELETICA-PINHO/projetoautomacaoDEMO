<?php 


//TAREFA ACIONADA VIA CRON AGENDAMENTO DE TAREFA DE 01 EM 01 MINUTE E VERIFICADO ESSE SCRIPT

include "conf/conf.php";
$controle = new Controle($pdo);
echo $data = date("H:i");

//$despertador_deliga = "";
//$despertador_liga = "";


$hora = date("H:i");
$data1 = date("d/n/Y");
$exevia = "TIME";







$sql = "SELECT * FROM status_despertador_sala WHERE status_desligar = 'ON' ";
$sql = $pdo->query($sql);
if($sql->rowCount () > 0){
    $sql = $sql->fetch();
    $despertador_deliga = $sql['hora_desligar'];

    if ($data == $despertador_deliga){
        $sql = "UPDATE status set status_sala = 'RELE01OF' ";
        $sql = $pdo->query($sql);
        $acao = 'RELE01OF';

        $controle->setStatus_sala_completo($acao, $exevia, $hora, $data1);
    }


}




$sql = "SELECT * FROM status_despertador_sala WHERE status_ligar = 'ON' ";
$sql = $pdo->query($sql);
if($sql->rowCount () > 0){
    $sql = $sql->fetch();
    $despertador_liga = $sql['hora_ligar'];

    if ($data == $despertador_liga){

   
        $sql = "UPDATE status set status_sala = 'RELE01ON' ";
        $sql = $pdo->query($sql);
        $acao = 'RELE01ON';
        $controle->setStatus_sala_completo($acao, $exevia, $hora, $data1);
    }
    
}





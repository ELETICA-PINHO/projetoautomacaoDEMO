<?php 


//TAREFA ACIONADA VIA CRON AGENDAMENTO DE TAREFA DE 01 EM 01 MINUTE E VERIFICADO ESSE SCRIPT

include "conf/conf.php";
echo $data = date("H:i");

//$despertador_deliga = "";
//$despertador_liga = "";


$sql = "SELECT * FROM status_despertador_sala";
$sql = $pdo->query($sql);
if($sql->rowCount () > 0){
    $sql = $sql->fetch();
    $despertador_deliga = $sql['hora_desligar'];

    if ($data == $despertador_deliga){
        $sql = "UPDATE status set status_sala = 'RELE01OF' ";
        $sql = $pdo->query($sql);
    }


}




$sql = "SELECT * FROM status_despertador_sala";
$sql = $pdo->query($sql);
if($sql->rowCount () > 0){
    $sql = $sql->fetch();
    $despertador_liga = $sql['hora_ligar'];

    if ($data == $despertador_liga){

   
        $sql = "UPDATE status set status_sala = 'RELE01ON' ";
        $sql = $pdo->query($sql);
    }
    
}





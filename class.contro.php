<?php 

/*

@author Alessandro Pinho eletricapinho@gmail.com

*/ 

class Controle{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

/* 
a função getStatus_sala()

retorna status do valor que está no bd  na coluna  status_sala  os 02 possíveis valores  RELE01ON  ou RELE010F

*/


    public function getStatus_sala(){
        $sql = $this->pdo->prepare("SELECT * FROM status");
        $sql->execute();
        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
            return $sql['status_sala'];
        }
    }

    /* 
a função getStatus_quarto()

retorna status do valor que está no bd  na coluna  status_quarto  os 02 possíveis valores  RELE02ON  ou RELE020F

*/

    public function getStatus_quarto(){
        $sql = $this->pdo->prepare("SELECT * FROM status");
        $sql->execute();
        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
            return $sql['status_quarto'];
        }
    }

/* 
a função setStatus_sala($p)

efetua um update na tabela status no campo status_sala  com dois possíveis valores RELE01ON  ou RELE010F

através da variável que é passado ao char a função 

*/



    public function setStatus_sala($p){
        $sql = $this->pdo->prepare("UPDATE status SET status_sala = :status_sala");
        $sql->bindValue(":status_sala", $p);
        $sql->execute();
    }



    /* 
a função setStatus_quarto($p)

efetua um update na tabela status no campo status_quarto  com dois possíveis valores RELE02ON  ou RELE020F

através da variável que é passado ao char a função 

*/

    public function setStatus_quarto($p){
        $sql = $this->pdo->prepare("UPDATE status SET status_quarto = :status_quarto");
        $sql->bindValue(":status_quarto", $p);
        $sql->execute();
    }


}


?>
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

    public function getStatus_sala(){
        $sql = $this->pdo->prepare("SELECT * FROM status");
        $sql->execute();
        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
            return $sql['status_sala'];
        }
    }

    public function getStatus_quarto(){
        $sql = $this->pdo->prepare("SELECT * FROM status");
        $sql->execute();
        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
            return $sql['status_quarto'];
        }
    }

    public function setStatus_sala($p){
        $sql = $this->pdo->prepare("UPDATE status SET status_sala = :status_sala");
        $sql->bindValue(":status_sala", $p);
        $sql->execute();
    }

    public function setStatus_quarto($p){
        $sql = $this->pdo->prepare("UPDATE status SET status_quarto = :status_quarto");
        $sql->bindValue(":status_quarto", $p);
        $sql->execute();
    }


}


?>
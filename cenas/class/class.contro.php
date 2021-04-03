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

    //  função getStatus_sala_completo  mostra dois ultimos estados da placa 


public function getStatus_sala_completo(){
    $array = array();
    $sql = $this->pdo->prepare("SELECT * FROM status_sala_completo ORDER BY registro DESC LIMIT 2"); 
    $sql->execute();

    if($sql->rowCount() > 0){
        $array = $sql->fetchAll();
        return $array;
    }else{
        return $array;
    }
       
    } 



    public function getStatus_sala_online(){
        $array = array();
        $sql = $this->pdo->prepare("SELECT * FROM status_sala_online ORDER BY id DESC LIMIT 1"); 
        $sql->execute();
    
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
            return $array;
        }else{
            return $array;
        }
           
        } 


        public function getStatus_sala_sistema(){
            $array = array();
            $sql = $this->pdo->prepare("SELECT * FROM status_sala_sistema ORDER BY id DESC LIMIT 2"); 
            $sql->execute();
        
            if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
                return $array;
            }else{
                return $array;
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


   
    public function setStatus_sala_completo($status, $exevia, $hora, $data){

        $sql = $this->pdo->prepare("INSERT INTO status_sala_completo (status, registro, exevia, hora, data) VALUES (:status, NULL, :exevia, :hora, :data) ");
        $sql->bindValue(":status", $status);
        $sql->bindValue(":exevia", $exevia);
        $sql->bindValue(":hora", $hora);
        $sql->bindValue(":data", $data);
        $sql->execute();
    }


    public function setStatus_sala_online($status, $hora, $data){

        $sql = $this->pdo->prepare("INSERT INTO status_sala_online (status, id, hora, data) VALUES (:status, NULL, :hora, :data) ");
        $sql->bindValue(":status", $status);
        $sql->bindValue(":hora", $hora);
        $sql->bindValue(":data", $data);
        $sql->execute();
    }


    public function setStatus_sala_sistema($status, $hora, $data){

        $sql = $this->pdo->prepare("INSERT INTO status_sala_sistema (status, id, hora, data) VALUES (:status, NULL, :hora, :data) ");
        $sql->bindValue(":status", $status);
        $sql->bindValue(":hora", $hora);
        $sql->bindValue(":data", $data);
        $sql->execute();
    }



//////////////////////////////////////////////////////////////////////////////////////



public function getStatus_quarto(){
    $sql = $this->pdo->prepare("SELECT * FROM status");
    $sql->execute();
    if($sql->rowCount() > 0){
        $sql = $sql->fetch();
        return $sql['status_quarto'];
    }
}

//  função getStatus_sala_completo  mostra dois ultimos estados da placa 


public function getStatus_quarto_completo(){
$array = array();
$sql = $this->pdo->prepare("SELECT * FROM status_quarto_completo ORDER BY registro DESC LIMIT 2"); 
$sql->execute();

if($sql->rowCount() > 0){
    $array = $sql->fetchAll();
    return $array;
}else{
    return $array;
}
   
} 



public function getStatus_quarto_online(){
    $array = array();
    $sql = $this->pdo->prepare("SELECT * FROM status_quarto_online ORDER BY id DESC LIMIT 1"); 
    $sql->execute();

    if($sql->rowCount() > 0){
        $array = $sql->fetchAll();
        return $array;
    }else{
        return $array;
    }
       
    } 


    public function getStatus_quarto_sistema(){
        $array = array();
        $sql = $this->pdo->prepare("SELECT * FROM status_quarto_sistema ORDER BY id DESC LIMIT 2"); 
        $sql->execute();
    
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
            return $array;
        }else{
            return $array;
        }
           
        } 












/* 
a função setStatus_sala($p)

efetua um update na tabela status no campo status_sala  com dois possíveis valores RELE01ON  ou RELE010F

através da variável que é passado ao char a função 

*/



public function setStatus_quarto($p){
    $sql = $this->pdo->prepare("UPDATE status SET status_quarto = :status_quarto");
    $sql->bindValue(":status_quarto", $p);
    $sql->execute();
}



public function setStatus_quarto_completo($status, $exevia, $hora, $data){

    $sql = $this->pdo->prepare("INSERT INTO status_quarto_completo (status, registro, exevia, hora, data) VALUES (:status, NULL, :exevia, :hora, :data) ");
    $sql->bindValue(":status", $status);
    $sql->bindValue(":exevia", $exevia);
    $sql->bindValue(":hora", $hora);
    $sql->bindValue(":data", $data);
    $sql->execute();
}


public function setStatus_quarto_online($status, $hora, $data){

    $sql = $this->pdo->prepare("INSERT INTO status_quarto_online (status, id, hora, data) VALUES (:status, NULL, :hora, :data) ");
    $sql->bindValue(":status", $status);
    $sql->bindValue(":hora", $hora);
    $sql->bindValue(":data", $data);
    $sql->execute();
}


public function setStatus_quarto_sistema($status, $hora, $data){

    $sql = $this->pdo->prepare("INSERT INTO status_quarto_sistema (status, id, hora, data) VALUES (:status, NULL, :hora, :data) ");
    $sql->bindValue(":status", $status);
    $sql->bindValue(":hora", $hora);
    $sql->bindValue(":data", $data);
    $sql->execute();
}

































}



?>
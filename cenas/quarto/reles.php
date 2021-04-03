<?php 

include("../conf/conf.php");
$controle = new Controle($pdo);
$exibe_sala = $controle->getStatus_quarto();
$valor = $exibe_sala;


$hora = date("H:i");
$data = date("d/n/Y");
$exevia = "WEB";





if(isset($_POST['RELE01'])){
    $acao = $_POST['RELE01'];
    $controle->setStatus_quarto($acao);
    $controle->setStatus_quarto_completo($acao, $exevia, $hora, $data);
}


if(isset($_POST['RELE02'])){
    $acao = $_POST['RELE02'];
    $controle->setStatus_quarto($acao);
}



?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lampadas</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/minha.css">
    <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
   

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light" style="background-color:#2ed27f">
        <a class="navbar-brand" href="#" style=color:white>Menus</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsMenu"
            aria-controls="navbarsMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsMenu">
            <ul class="navbar-nav mr-auto">

            </ul>
            <ul class="navbar-nav">
                <li>
                    <a href="index.php" class="nav-link" style=color:white>HOME</a>
                </li>
                <li>
                <a href="reles.php" class="nav-link" style=color:white>RELES</a>
                </li>
           
                <li>
                    <a href="definehora.php" class="nav-link" style=color:white>TIMER</a>
                </li>
                <li>
                    <a href="#skils" class="nav-link" style=color:white>-----</a>
                </li>
            </ul>
        </div>
    </nav>
    
    
<div class="album py-5 bg-light ">
        <div class="container">
            <h2 class="text-center jumbotron-heading titulosVerdes">Elétrica Pinho</h2>
            <div class="row">
                <div class="col-md">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                           
                           <?php
        $class = "" ;
        if ($valor == "RELE01ON"){
        $class =  'btn btn-success disabled' ;
        }
        elseif ($valor == "RELE01OF"){
            $class =  'btn btn-danger disabled' ;
        }
         ?> 



<h2>QUARTO <?php  printf('<button type="button" class="btn '.$class.' ">%s</button>',  $exibe_sala = $controle->getStatus_sala()); ?></h2> 
                           <form method="POST">
                                <button type="submit" class="btn btn-success btn-lg btn-block" value="RELE01ON" name="RELE01">Ligar</button>
                                <button type="submit"  class="btn btn-danger btn-lg  btn-block " value="RELE01OF" name="RELE01">Desligar</button>
                                
                          
                            </form>
                        </div>
                    </div>
                </div>
                    

                </div> 
            </div>
        </div>
    </div>



</div>






                                      

           
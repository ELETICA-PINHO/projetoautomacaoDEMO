<?php 
include("../conf/conf.php");

$controle = new Controle($pdo);
$exibe_sala = $controle->getStatus_sala();
$exibe_sala_completo = $controle->getStatus_sala_completo();
$exibe_sala_online = $controle->getStatus_sala_online();
$exibe_sala_sistema = $controle->getStatus_sala_sistema();
$exibe_quarto = $controle->getStatus_quarto();
$valor = $exibe_sala;


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="../assets/css/minha.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.2.1.3.min.js"></script>
   
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
            </ul>
        </div>
    </nav>
    
<div class="album py-5 bg-light ">
        <div class="container">
            <h2 class="text-center jumbotron-heading titulosVerdes">Elétrica Pinho</h2>
            <div class="row">
                <div class="col-md-6">
                
                    <div class="card mb-4 box-shadow">
                   
                        <div class="card-body">

                        
                        <div class="text-center alert alert-info">
                           <h2>STATUS SALA</h2>

                           </div>
                          
                           
                        


                           <?php
                           
                                $class = "" ;
                                if ($valor == "RELE01ON"){
                                $class =  'btn btn-success disabled' ;
                                }
                                elseif ($valor == "RELE01OF"){
                                    $class =  'btn btn-danger disabled' ;
                                }
                                

                  /*              
            foreach($controle->getStatus_sala_online() as $lista):?>
                <div class="btn-group" role="group" aria-label="Basic example">
                <?php printf('<button type="button" class="btn '.$class.' ">%s</button>',  $exibe_sala = $controle->getStatus_sala()); ?>
                <button type="button" class="btn btn-success disabled"><?php echo $lista['status'];?></button>
                <button type="button" class="btn btn-success disabled"><?php echo $lista['hora'];?></button>
                <button type="button" class="btn btn-success disabled"><?php echo $lista['data'];?></button>
            </div>  
            <?php endforeach;

                                     */  ?> 


                                           

                                      
                           
                        <div class="table-responsive-sm">
                            <table class="table table-info">
                            <thead class="thead-dark">
                                <tr>
                                    <th>STATUS</th>
                                    <th>ONLINE</th>
                                    <th>HORA</th>
                                    <th>DATA</th>
                                </tr>
                                    <?php foreach($controle->getStatus_sala_online() as $lista):?>
                                <tr>
                                    <td><?php  printf('<button type="button" class="btn '.$class.' ">%s</button>',  $exibe_sala = $controle->getStatus_sala()); ?></td>
                                    <td><?php echo $lista['status'];?></td>
                                    <td><?php echo $lista['hora'];?></td>
                                    <td><?php echo $lista['data'];?></td>
                                </tr>
                                    <?php endforeach; ?>
                            </thead>
                            </table>
                        </div>
               

                           
                        <div class="table-responsive-sm">
                           
                            <table class="table table-info">
                            <thead class="thead-dark">
                                <tr>
                                    <th>STATUS</th>
                                    <th>ID</th>
                                    <th>EXEVIA</th>
                                    <th>HORA</th>
                                    <th>DATA</th>
                                </tr>
                                        <?php foreach($controle->getStatus_sala_completo() as $lista):?>
                                <tr>
                                    <td><?php echo $lista['status'];?></td>
                                    <td><?php echo $lista['registro'];?></td>
                                    <td><?php echo $lista['exevia'];?></td>
                                    <td><?php echo $lista['hora'];?></td>
                                    <td><?php echo $lista['data'];?></td>
                                </tr>

                                        <?php endforeach; ?>
                            </thead>
                            </table>
                        </div>
                    
                    <div class="table-responsive-sm">
                        <table class="table table-info">
                        <thead class="thead-dark">
                            <tr>
                                <th>STATUS SISTEM</th>
                                <th>ID</th>
                                <th>HORA</th>
                                <th>DATA</th>
                            </tr>
                                
                                            <?php foreach($controle->getStatus_sala_sistema() as $lista):?>
                                                <tr >
                                                    <td><?php echo $lista['status'];?></td>
                                                    <td><?php echo $lista['id'];?></td>
                                                    <td><?php echo $lista['hora'];?></td>
                                                    <td><?php echo $lista['data'];?></td>
                                                </tr>
                                
                                                <?php endforeach; ?>
                                            </thead>
                                            </table>
                                </div>
                        </div>
                    </div>
                </div>

                    
                

                


        



                    <div class="col-md-6">
                        <div class="card mb-4 box-shadow">
                            <div class="card-body">
                            <h2>Status Quarto</h2>
                            <?php echo $exibe_quarto; ?>
                            </div>
                        </div>
                    </div>

                </div> 
            </div>
        </div>
    </div>
</div>

<script>
            function buscar(palavra)
            {
                //O método $.ajax(); é o responsável pela requisição
                $.ajax
                        ({
                            //Configurações
                            type: 'POST',//Método que está sendo utilizado.
                            dataType: 'php',//É o tipo de dado que a página vai retornar.
                            url: 'index.php',//Indica a página que está sendo solicitada.
                            //função que vai ser executada assim que a requisição for enviada
                            beforeSend: function () {
                                $("#dados").html("Carregando...");
                            },
                            data: {palavra: palavra},//Dados para consulta
                            //função que será executada quando a solicitação for finalizada.
                            success: function (msg)
                            {
                                $("#dados").html(msg);
                            }
                        });
            }
            
            
            $('#buscar').click(function () {
                buscar($("#palavra").val())
            });
        </script>

    
</body>
</html>
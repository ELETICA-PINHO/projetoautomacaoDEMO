<?php 
include("../conf/conf.php");


if(isset($_POST['opcao']) && !empty($_POST['opcao'])){

    $opcao = $_POST['opcao'];
    $alarme = $_POST['alarme'];
    $botao =  $_POST['botao'];

    if($opcao == 'ligar'){
        $sql = "UPDATE status_despertador_sala SET hora_ligar = '$alarme',  status_ligar = '$botao' ";
         $sql = $pdo->query($sql);

    }

    if($opcao == 'desligar'){
        $sql = "UPDATE status_despertador_sala SET hora_desligar = '$alarme',  status_desligar = '$botao' ";
         $sql = $pdo->query($sql);

    }


    



}



$sql = "SELECT * FROM status_despertador_sala";
$sql = $pdo->query($sql);
if($sql->rowCount () > 0){
    $sql = $sql->fetch();
    
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="../assets/css/minha.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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
                           <h2>Sala</h2>
                           <p>Status Liga: <?php echo $despertador = $sql['status_ligar'];?></p></p>   
                           <p>Timer: <?php echo $despertador = $sql['hora_ligar'];?></p>
                           <p>Status Desliga: <?php echo $despertador = $sql['status_desligar'];?></p>   
                           <p>Timer: <?php echo $despertador = $sql['hora_desligar'];?></p>
                           <form method="POST">
                                <div class="form-group">
                                <select name="opcao" id="" class="form-control">
                                    <option value=""></option>
                                    <option value="ligar">Ligar</option>
                                    <option value="desligar">Desligar</option>
                                </select>
                                </div>
                               <div class="form-group">
                                    <label for="">Alarme</label>
                                    <input type="time" name="alarme" id="" class="form-control">
                               </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" value="ON" name="botao">Ativar</button>
                                    <button type="submit" class="btn btn-danger btn-lg btn-block" value="OF" name="botao">Desativar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    <div class="col-md">
                        <div class="card mb-4 box-shadow">
                            <div class="card-body">
                            <h2>Quarto</h2>
                            <form method="POST">
                                <div class="form-group">
                                        <label for="">Alarme Ligar</label>
                                        <input type="time" name="time_liga" id="" class="form-control">
                                </div>
                                    <div class="form-group">
                                        <label for="">Alarme desligar</label>
                                        <input type="time" name="time_desliga" id=""class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-lg btn-block" value="" name="">Ativar</button>
                                        <button type="submit" class="btn btn-danger btn-lg btn-block" value="" name="">Desativar</button>
                                    </div>
                            </form>    
                            </div>
                            </div>
                        </div>
                    </div>

                </div> 
            </div>
        </div>
    </div>



</div>
 
    
</body>
</html>
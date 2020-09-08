<?php 

include "class.contro.php";
include "config.php";
$controle = new Controle($pdo);
$exibe_sala = $controle->getStatus_sala();
$exibe_quarto = $controle->getStatus_quarto();


//tetseejfjfcomentari

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="assets/css/minha.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
                <div class="col-md-6">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                           <h2>Status Sala:</h2>
                           <?php echo $exibe_sala; ?>
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

    
</body>
</html>
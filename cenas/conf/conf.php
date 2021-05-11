<?php 
date_default_timezone_set('america/sao_paulo');



include("../class/class.contro.php");


$dbuser = "";
$dbpassword = "";
$host = "localhost";
$dns = "mysql:dbname=projetoautomacaoDEMO;host=$host; $dbuser, $dbpassword";

try {
   $pdo = new PDO($dns,$dbuser,$dbpassword);
} catch (PDOException $erro) {
    echo "Falha: ".$erro->getMessage();
    exit;
}


?>

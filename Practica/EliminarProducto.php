<?php



include("Conexion.php");
$db_conexion = mysqli_connect($db_host, $db_user,$db_pass,$db_name);

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $query = "delete from productos where idproducto = $id";

    $result = mysqli_query($db_conexion, $query);

    if(!$result){

        die("Failed");
    }

    header("Location: index.php");

    
}


?>


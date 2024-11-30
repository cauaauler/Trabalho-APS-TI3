<?php 
include_once __DIR__ . '/../../vendor/autoload.php';

include_once __DIR__ . "/../classes/Residuo.php";
include_once __DIR__ . "/../classes/MySQL.php";

if(isset($_GET['id'])) {
    $residuo = Residuo::find($_GET['id']);

    if($residuo == null || $residuo->getAtivo() == false) {
        $erro = true;
    } else {
        $residuo->delete();
    }
} else {
    $erro = true;
}

if(isset($erro)) {
    header('Location: ../listar_residuo/?erro');
} else {
    header("Location: ../listar_residuo/");
}
?>
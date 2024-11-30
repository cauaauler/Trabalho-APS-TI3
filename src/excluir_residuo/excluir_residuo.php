<?php 
include_once __DIR__ . '/../../vendor/autoload.php';

session_start();

if($_SESSION['logado'] != true) {
    echo "<script>alert('Por favor, realize o login!'); window.location.href = '../login/';</script></script>";
    die;
}

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
<?php 
include_once __DIR__ . '/../../vendor/autoload.php';

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
    header('Location: ../index.php?erro');
} else {
    header('Location: ../index.php?sucesso');
}
?>
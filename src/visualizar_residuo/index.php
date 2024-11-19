<?php
include_once __DIR__ . '/../../vendor/autoload.php';

if(isset($_GET['id'])) {
    $residuo = Residuo::find($_GET['id']);

    if($residuo == null || $residuo->getAtivo() == false) {
        $erro = true;
    } else {
        $tipo_residuo = TipoResiduo::find($residuo->getIdTipoResiduo());
    }
} else {
    $erro = true;
}

if(isset($erro)) {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Visualizar Residuo</h1>
    <p>Nome: <?php echo $residuo->getNome(); ?></p>
    <p>Descrição: <?php echo $residuo->getDescricao(); ?></p>
    <img src="../../uploads/<?= $residuo->getImagem() ?>.jpg" alt="Imagem do Residuo">
    <p>Tipo de Residuo: <?php echo $tipo_residuo->getTipo(); ?></p>
</body>
</html>
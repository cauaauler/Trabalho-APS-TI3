<?php 
include_once __DIR__ . '/../../vendor/autoload.php';

if(isset($_POST['id'])) {
    $residuo = Residuo::find($_POST['id']);

    if($residuo == null || $residuo->getAtivo() == false) {
        $erro = true;
    } else {
        $tipos_residuo = TipoResiduo::findAll();
    }
} else {
    $erro = true;
}

if(isset($erro)) {
    header('Location: index.php?erro&id=' . $_POST['id']);
} else if (isset($_POST['submit'])) {
    if($_POST['nome'] != null && $_POST['descricao'] != null
    && $_FILES['imagem']['error'] == 0 && $_POST['idTipoResiduo'] != null) {
        unlink("../../uploads/{$residuo->getImagem()}.jpg");

        $residuo->setImagem(uniqid());
        $residuo->setNome($_POST['nome']);
        $residuo->setDescricao($_POST['descricao']);
        $residuo->setIdTipoResiduo($_POST['idTipoResiduo']);

        if(move_uploaded_file($_FILES['imgResiduo']['tmp_name'], "../../uploads/{$residuo->getImagem()}.jpg")) {
            $sucesso = true;
        }

        $residuo->save();
    }
}

if(isset($sucesso)) {
    header('Location: index.php?sucesso&id=' . $_POST['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php 
        echo "
        <form action='index.php' method='post' enctype='multipart/form-data'>
            <input type='hidden' name='id' value='{$residuo->getId()}'>
            <div id='divImagemResiduo'>
                <img id='imgResiduo' src='../../uploads/{$residuo->getImagem()}.jpg'/>
                <label for='imgResiduo' class='custom-file-label'>Escolha uma Imagem</label>
                <input type='file' name='imagem' id='imgResiduo' class='custom-file-input'>
            </div>
            <input type='text' name='nome' value='{$residuo->getNome()}'>
            <input type='text' name='descricao' value='{$residuo->getDescricao()}'>
            <select name='idTipoResiduo'>";
                
                    foreach($tipos_residuo as $tipo) {
                        echo "<option value={$tipo->getId()}";
                        if($residuo->getIdTipoResiduo() == $tipo->getId()) {
                            echo 'selected';
                        }
                        echo ">{$tipo->getTipo()}</option>";
                    }
                
            echo "</select>
            <button type='submit' name='submit'>Salvar</button>
        </form>";
    ?>
</body>
</html>
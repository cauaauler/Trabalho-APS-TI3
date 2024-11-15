<?php 
include_once __DIR__ . "/../../vendor/autoload.php";

if(isset($_POST['submit'])) {
    if($_POST['nome'] != null && $_POST['descricao'] != null
    && $_FILES['imagem']['error'] == 0 && $_POST['id_tipo_residuo'] != null) {
        $nomeImagem = uniqid();
        $destinoArquivo = "../../uploads/". $nomeImagem . ".jpg";

        if(move_uploaded_file($_FILES['imagem']['tmp_name'], $destinoArquivo)) {
            $residuo = new Residuo($_POST['nome'], $_POST['descricao'], $nomeImagem, $_POST['id_tipo_residuo']);
            $residuo->save();
        } else {
            $erro = true;
            die;
        }
    } else {
        $erro = true;
    }
}

if(isset($erro)) {
    header("Location: index.php?erro");
}

$tiposResiduos = TipoResiduo::findAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php 
        if(isset($_GET['erro'])) {
            echo "<h1>Erro ao adicionar residuo</h1>";
        }
        ?>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="text" name="descricao" placeholder="Descrição" required>
        <input type="file" accept="image/*" name="imagem" required>
        <select name="id_tipo_residuo" required>
            <?php
                foreach($tiposResiduos as $tipoResiduo) {
                    echo "<option value=" . $tipoResiduo->getId() . ">" . $tipoResiduo->getTipo() . "</option>";
                }
            ?>
        </select>
        <button type="submit" name="submit">Salvar</button>
    </form>
</body>
</html>
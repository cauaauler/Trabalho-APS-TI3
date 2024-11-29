<?php
include_once __DIR__ . "/../../vendor/autoload.php";

include_once __DIR__ . "/../classes/Residuo.php";
include_once __DIR__ . "/../classes/TipoResiduo.php";

if (isset($_POST['submit'])) {
    if (
        $_POST['nome'] != null && $_POST['descricao'] != null
        && $_FILES['imagem']['error'] == 0 && $_POST['id_tipo_residuo'] != null 
        //aqui na verificação poderia mostrar uma mensagem
        && strlen($_POST['nome']) < 25
    ) {
        $nomeImagem = uniqid();
        $destinoArquivo = "../../uploads/" . $nomeImagem . ".jpg";

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destinoArquivo)) {
            $residuo = new Residuo($_POST['nome'], $_POST['descricao'], $nomeImagem, $_POST['id_tipo_residuo']);
            $residuo->save();

            $sucesso = true;
        } else {
            $erro = true;
            die;
        }
    } else {
        $erro = true;
    }
}

if (isset($erro)) {
    header("Location: index.php?erro");
} else if (isset($sucesso)) {
    header("Location: index.php?sucesso");
}

$tiposResiduos = TipoResiduo::findAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/LogoReciclaIF.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Cadastro de Resíduos</title>
</head>

<body>
    <header>
        <?php
        include_once __DIR__ . "/../components/header_login.html";
        ?>
    </header>
    <main>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <div id="divTitulo">
                    <h1>Cadastro de resíduo</h1>
                </div>
                <div id="divNomeResiduo">
                    <input type="text" name="nome" id="nomeResiduo" placeholder="Nome do resíduo..." required>
                </div>
                <div id="divTipoResiduo">
                    <label id="lblTipoResiduo" for="selectTipoResiduo">Tipo de Resíduo:</label>
                    <select name="id_tipo_residuo" id="selectTipoResiduo" required>
                        <?php
                        foreach ($tiposResiduos as $tipoResiduo) {
                            echo "<option value=" . $tipoResiduo->getId() . ">" . $tipoResiduo->getTipo() . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div id="divDescricaoResiduo">
                    <textarea id="descricaoResiduo" rows="5" name="descricao" placeholder="Descrição..." required></textarea>
                </div>
                <div id="fileUpload">
                    <input type="file" id="imgResiduo" accept="image/*" name="imagem" required hidden>
                    <label for="imgResiduo" id="customFileLabel">Escolher Arquivo</label>
                    <span id="fileName">Nenhum arquivo selecionado</span>
                </div>
                <div id="divBtn">
                    <div id="divCancelarResiduo">
                        <button id="btnCancelar" onclick="window.location.href = '../listar_residuo/'">Cancelar</button>
                    </div>
                    <div id="divCadastrarResiduo">
                        <input type="submit" name="submit" id="btnCadastrar" value="Cadastrar" />
                    </div>
                </div>
            </div>
        </form>
    </main>
    <footer>
    </footer>
</body>

</html>
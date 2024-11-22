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

            $sucesso = true;
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
} else if(isset($sucesso)) {
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
        <div id="divLogo">
            <a href="">
                <img id="imgLogo" src="../../img/LogoReciclaIF3.png" alt="">
            </a>
                <div id="divLabel">
                    <label id="LogoIfrs"> <b>INSTITUTO FEDERAL <br> DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA <br> Rio Grande do Sul</b></label>
                </div>
        </div>
        <div id="divUser">
            <div id="DivBtnSair">
                <button id="BtnLeave">Sair</button>
            </div>
            <div id="User">
                <label id="nameUser" for=""><b>Olá, administrador </b></label>
            </div>
            <img id="imgUser" src="../../img/avatar.png" alt="">
        </div>
    </header>
    <main>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div id="divImagemResiduo">
                <label for="imgResiduo" class="custom-file-label">Escolha uma Imagem</label>
                <input type="file" name="imagem" id="imgResiduo" accept="image/*" hidden required>
                <div id="previewContainer">
                    <img id="preview" src="" alt="Preview da imagem" style="display: none; max-width: 100%; height: auto; margin-top: 20px;">
                </div>
            </div>
            <div class="container">
                <h1>Cadastrar Resíduo</h1>
                <div id="divNomeResiduo">
                    <label for="nomeResiduo">Nome:</label>
                    <input type="text" name="nome" id="nomeResiduo" required>
                </div>
                <div id="divTipoResiduo">
                    <label for="selectTipoResiduo">Tipo de Resíduo:</label>
                    <select name="id_tipo_residuo" id="selectTipoResiduo" required>
                        <?php
                            foreach($tiposResiduos as $tipoResiduo) {
                                echo "<option value=" . $tipoResiduo->getId() . ">" . $tipoResiduo->getTipo() . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div id="divDescricaoResiduo">
                    <label for="">Descrição:</label>
                    <textarea id="descricaoResiduo" rows="5" name="descricao" required></textarea>
                </div>
                <div id="divBtn">
                    <div id="divCancelarResiduo">
                        <button id="btnCancelar" onclick="window.location.href = '../index.php'">Cancelar</button>
                    </div>
                    <div id="divCadastrarResiduo">
                        <input type="submit" name="submit" id="btnCadastrar" value="Cadastrar"/>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <footer>
    </footer>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('erro')) {
        alert("Ocorreu um erro ao cadastrar o residuo");
    } else if (urlParams.has('sucesso')) {
        alert("Residuo cadastrado com sucesso");
    }

    const url = new URL(window.location.href);
    url.search = "";
    window.history.replaceState({}, document.title, url.toString());
})
</script>
</html>

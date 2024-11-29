<?php 
include_once __DIR__ . "/../../vendor/autoload.php";

session_start();

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
    header("Location: ../listar_residuo/?erro");
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
    <title>Edição de Resíduos</title>
</head>
<body>
<header>
        <div id="divLogo">
            <a href="">
                <img id="imgLogo" src="../../img/LogoReciclaIF3.png" alt="">
            </a>
        </div>
        <div id="divUser">
                <button id="BtnLeave">Sair</button>
            <div id="divUserNew">
                <div id="User">
                    <label id="nameUser" for=""><b>Olá, administrador </b></label>
                </div>
                <img id="imgUser" src="../../img/avatar.png" alt="">
            </div>
        </div>
    </header>
    <main>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <div id="divTitulo">
                    <h1>Editar resíduo</h1>
                </div>
                <div id="divNomeResiduo">
                    <?php
                        echo "<input type='text' name='nome' id='nomeResiduo' placeholder='Nome do resíduo...'
                    required value='";
                        echo $residuo->getNome();
                        echo "'>";
                    ?>
                </div>
                <div id="divTipoResiduo">
                    <label id="lblTipoResiduo" for="selectTipoResiduo">Tipo de Resíduo:</label>
                    <select name="id_tipo_residuo" id="selectTipoResiduo"  required>
                        <?php
                            foreach($tiposResiduos as $tipoResiduo) {
                                echo "<option value=" . $tipoResiduo->getId() . ">" . $tipoResiduo->getTipo() . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div id="divDescricaoResiduo">
                    <?php 
                        echo "<textarea id='descricaoResiduo' rows='5' name='descricao'
                        placeholder='Descrição...' required>";
                        echo $residuo->getDescricao();
                        echo "</textarea>";
                    ?>
                </div>
                <div id="fileUpload">
                    <input type="file" id="imgResiduo" accept="image/*" name="imagem" required hidden>
                    <label for="imgResiduo" id="customFileLabel">Escolher Arquivo</label>
                    <span id="fileName">Nenhum arquivo selecionado</span>
                </div>
                <div id="divBtn">
                    <div id="divCancelarResiduo">
                        <?php 
                            echo "<button id='btnCancelar' onclick=\"window.location.href = '../{$_SESSION['paginaAnterior']}'\">Cancelar</button>";
                        ?>
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
</html>

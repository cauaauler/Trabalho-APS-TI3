<?php 
include_once __DIR__ . "/../../vendor/autoload.php";

session_start();

if($_SESSION['logado'] != true) {
    echo "<script>alert('Por favor, realize o login!'); window.location.href = '../login/';</script></script>";
}

if(isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
}

if($_SESSION['id'] != null) {
    $residuo = Residuo::find($_SESSION['id']);

    if($residuo == null || $residuo->getAtivo() == false) {
        $erro = true;
    } else {
        $tipo_residuo = TipoResiduo::find($residuo->getIdTipoResiduo());
    }
} else {
    $erro = true;
}

if(isset($erro)) {
    header('Location: ../listar_residuo/?erro');
}

$tiposResiduos = TipoResiduo::findAll();

if(isset($_POST['submit'])) {
    $residuo = Residuo::find($_SESSION['id']);

    $residuo->setNome($_POST['nome']);
    $residuo->setDescricao($_POST['descricao']);
    $residuo->setIdTipoResiduo($_POST['id_tipo_residuo']);

    if($_FILES['imagem']['error'] == 0 && $_FILES['imagem']['name'] != null) {
        $nomeImagem = uniqid();
        $destinoArquivo = "../../uploads/". $nomeImagem . ".jpg";
        move_uploaded_file($_FILES['imagem']['tmp_name'], $destinoArquivo);
        $residuo->setImagem($nomeImagem);
    }

    $residuo->save();
    $_SESSION['id'] = null;
    
    header("Location: ../listar_residuo/?sucesso");
}
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
                <a href="../deslogar.php"><button id="BtnLeave">Sair</button></a>
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
                     value='";
                        echo $residuo->getNome();
                        echo "'>";
                    ?>
                </div>
                <div id="divTipoResiduo">
                    <label id="lblTipoResiduo" for="selectTipoResiduo">Tipo de Resíduo:</label>
                    <select name="id_tipo_residuo" id="selectTipoResiduo"  >
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
                        placeholder='Descrição...' >";
                        echo $residuo->getDescricao();
                        echo "</textarea>";
                    ?>
                </div>
                <div id="fileUpload">
                    <input type="file" id="imgResiduo" accept="image/*" name="imagem"  hidden>
                    <label for="imgResiduo" id="customFileLabel">Escolher Arquivo</label>
                    <span id="fileName">Nenhum arquivo selecionado</span>
                </div>
                <div id="divBtn">
                    <div id="divCancelarResiduo">
                        <?php 
                            echo "<button type='button' id='btnCancelar' onclick=\"window.location.href = '../visualizar_residuo/?id={$residuo->getId()}'\">Cancelar</button>";
                        ?>
                    </div>
                    <div id="divCadastrarResiduo">
                        <input type="submit" name="submit" id="btnCadastrar" value="Editar"/>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <footer>
    </footer>
</body>
</html>

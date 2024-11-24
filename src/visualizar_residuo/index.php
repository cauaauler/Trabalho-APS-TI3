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
    <link rel="stylesheet" href="style.css">
    <title>Resíduo Completo</title>
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
    <div id = 'divBtnBack'><a> <button id= 'btnback'>↩ Voltar</button> </a></div>
        <div class="container">
            <div id="divImagemResiduo">
                <img id="ImagemResiduo" src="../../uploads/<?= $residuo->getImagem() ?>.jpg" alt="Imagem do Residuo">
            </div>
            <div class="conteudo">
                <div id="divNomeResiduo">
                    <p><b>Nome: </b></p> <p><?php echo $residuo->getNome(); ?></p>
                </div>
                <div id="divTipoResiduo">
                    <p><b>Tipo de Residuo: </b></p> <p><?php echo $tipo_residuo->getTipo(); ?></p>
                </div>
                <div>
                    <p><b>Descrição: </b></p> <p id="descricaoResiduo"><?php echo $residuo->getDescricao(); ?></p>
                </div>
            </div>
            <div class='classButton'>
                    <div id='divEditButton'>
                        <a href="../editar_residuo/index.php"><input id='editBtn' type='submit' value='✏️'></a>
                    </div>
                    <div id='divDeleteButton'>
                        <a href='../excluir_residuo/excluir_residuo.php?id={$residuo->getId()}'><button id='delBtn'>🗑️</button></a>
                    </div>
            </div>
        </div>
    </main>
    <footer></footer>
</body>
</html>
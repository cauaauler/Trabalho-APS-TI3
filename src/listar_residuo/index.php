<?php
include_once __DIR__ . "/../../vendor/autoload.php";
include_once __DIR__ . "/../classes/Residuo.php";
include_once __DIR__ . "/../classes/TipoResiduo.php";
include_once __DIR__ . "/../classes/MySQL.php";

$residuos = Residuo::findAll();

if (isset($_GET['erro'])) {
    echo "<script>alert('Ocorreu um erro!'); window.location.href = '../listar_residuo/';</script></script>";
}

session_start();
$_SESSION['paginaAnterior'] = "listar_residuo";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../../img/LogoReciclaIF.png" type="image/x-icon">
    <title>Listar Resíduos</title>
</head>

<body>
    <header>
        <?php
        include_once __DIR__ . "/../components/header_login.html";
        ?>
    </header>
    <?php
    echo "<div id = 'divBtnBack'><a href='../adicionar_residuo/'> <button id= 'btnback'>Cadastrar Resíduo</button> </a></div>";
    if (count($residuos) == 0) {
        echo "<div id = 'divNotResiduos'><h1>Lista de resíduos vazia</h1></div>";
    } else {
        $tipos_residuo = TipoResiduo::findAll();
        echo "<main>";

        foreach ($residuos as $residuo) {
            echo "<div>
                    <a href='../visualizar_residuo/index.php?id={$residuo->getId()}'>
                        <div class='container {$tipos_residuo[$residuo->getIdTipoResiduo() - 1]->getTipo()}'>
                       
                            <div class='conteudo'>
                                <div class='divConteudo'>
                                    <div id='divNomeResiduo'>
                                        <label id='lblnomeResiduo'><b>Nome:</b></label>
                                        <label id='resNome'>{$residuo->getNome()}</label>
                                    </div>
                                    <div id='divTipoResiduo'>
                                        <label id='lbltipoResiduo'><b>Tipo:</b></label>
                                        <label id='resTipo'>{$tipos_residuo[$residuo->getIdTipoResiduo() - 1]->getTipo()}</label>
                                    </div>
                                         <div id='divImgResiduo'>
                                <img id='imgResiduo' src='../../uploads/{$residuo->getImagem()}.jpg'>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </a>
                </div>";
        }

        echo "</main>";
    }
    ?>
    <footer></footer>
</body>

</html>
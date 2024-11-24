<?php 
include_once __DIR__ . "/../../vendor/autoload.php";

$residuos = Residuo::findAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../../img/LogoReciclaIF.png" type="image/x-icon">
    <title>Visualizar Resíduo</title>
</head>
<body>
    <?php 
        include_once __DIR__ . "/../componentes/header_login.html";
    ?>
    <?php
        echo "<div id = 'divBtnBack'><a> <button id= 'btnback'>↩ Voltar</button> </a></div>";
        if(count($residuos) == 0) {
            echo "<div id = 'divNotResiduos'><h1>Lista de resíduos vazia</h1></div>";
        } else {
            $tipos_residuo = TipoResiduo::findAll();
            echo "<main>";

            foreach($residuos as $residuo) {
                echo "<div>
                        <div class='classBtn'>
                            <div id='divEditButton'>
                                <input id='editBtn' type='submit' value='✏️'>
                            </div>
                            <div id='divDeleteButton'>
                                <a href='../excluir_residuo/excluir_residuo.php?id={$residuo->getId()}'><button id='delBtn'>🗑️</button></a>
                            </div>
                        </div>
                    <a href='../visualizar_residuo/index.php?id={$residuo->getId()}'>
                        <div class='container {$tipos_residuo[$residuo->getIdTipoResiduo()-1]->getTipo()}'>
                            <div id='divImgResiduo'>
                                <img id='imgResiduo' src='../../uploads/{$residuo->getImagem()}.jpg'>
                            </div>
                            <div class='conteudo'>
                                <div class='divConteudo'>
                                    <div id='divNomeResiduo'>
                                        <label id='lblnomeResiduo'>Nome: </label>
                                        <label id='resNome'>{$residuo->getNome()}</label>
                                    </div>
                                    <div id='divTipoResiduo'>
                                        <label id='lbltipoResiduo'>Tipo: </label>
                                        <label id='resTipo'>{$tipos_residuo[$residuo->getIdTipoResiduo()-1]->getTipo()}</label>
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
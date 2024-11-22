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
        if(count($residuos) == 0) {
            echo "<h1>Lista de resíduos vazia</h1>";
        } else {
            $tipos_residuo = TipoResiduo::findAll();
            echo "<main>";

            foreach($residuos as $residuo) {
                echo "<div class='container'>
                        <div id='divImgResiduo'>
                            <img id='imgResiduo' src='../../uploads/' . {$residuo->getImagem()} . '.jpg'>
                        </div>
                        <div class='conteudo'>
                            <div class='classBtn'>
                                <div id='divEditButton'>
                                    <input id='editBtn' type='submit' value='✏️'>
                                </div>
                                <div id='divDeleteButton'>
                                    <input id='delBtn' type='submit' value='🗑️'>
                                </div>
                            </div>
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
                    </div>";
            }

            echo "</main>";
        }
    ?>
    <footer></footer>
</body>
</html>
<?php 
include_once __DIR__ . "/../../vendor/autoload.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ol>
        <?php 
            $residuos = Residuo::findAll();
            $tipos_residuo = TipoResiduo::findAll();

            foreach($residuos as $residuo) {
                echo "<li>
                <img src='../../uploads/{$residuo->getImagem()}.jpg'/>
                {$residuo->getNome()} - {$tipos_residuo[$residuo->getIdTipoResiduo()-1]->getTipo()}</li>";
            }
        ?>
    </ol>
</body>
</html>
<?php 
include_once __DIR__ . "/../../vendor/autoload.php";

if(isset($_GET['erro'])) {
    echo "<script>alert('Dados incorretos!');</script></script>";
}

if(isset($_POST['submit'])) {
    if($_POST['email'] != null && $_POST['senha'] != null) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $logado = Usuario::login($email, $senha);

        if($logado) {
            header("Location: ../listar_residuo/");
        } else {
            $erro = true;
        }
    } else {
        $erro = true;
    }
}

if(isset($erro)) {
    header("Location: index.php?erro");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <header>
        <div id="divLogo">
            <a href="">
                <img id="imgLogo" src="../../img/LogoReciclaIF3.png" alt="">
            </a>
        </div>
        <div id="divUser">
            <a href="./"><button id="BtnLeave">Fazer Login</button></a>
        </div>
    </header>
    <main>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div id="divTitulo">
                <h1>Fazer Login</h1>
            </div>
            <div id=divInputs>
                <div id="divNomeResiduo">
                    <input type="text" name="email" id="nomeResiduo" placeholder="Email..." required>
                </div>
                <div id="divDescricaoResiduo">
                    <input type="text" name="senha" id="descricaoResiduo" placeholder="Senha..." required>
                </div>
            </div>
            <div id="divBtn">
                <div id="divCancelarResiduo">
                    <button id="btnCancelar" onclick="window.location.href = '../listar_residuo/'">Cancelar</button>
                </div>
                <div id="divCadastrarResiduo">
                    <input type="submit" name="submit" id="btnCadastrar" value="Acessar"/>
                </div>
            </div>
        </form>
    </main>
    <footer>
    </footer>
</body>
</html>
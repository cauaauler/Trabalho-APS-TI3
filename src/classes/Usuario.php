<?php 
class Usuario {
    public function __construct(
        private string $email,
        private string $senha
    ){}

    public static function login(string $email, string $senha): bool {
        $conexao = new MySQL();

        $sql = "SELECT * FROM usuario WHERE email = ? AND senha = ?";
        $type_param = "ss";
        $param = [$email, $senha];

        $resultados = $conexao->consulta($sql, $type_param, $param);

        if(empty($resultados)) {
            return false;
        }

        session_start();
        $_SESSION['logado'] = true;

        return true;
    }
}
?>
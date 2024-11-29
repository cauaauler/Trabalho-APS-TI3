<?php 

include_once __DIR__ . "/../classes/ActiveRecord.php";

class Residuo implements ActiveRecord{
    private int $id;
    private bool $ativo;

    public function __construct(
        private string $nome,
        private string $descricao,
        private string $imagem,
        private int $id_tipo_residuo
    ){}

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function getImagem(): string {
        return $this->imagem;
    }

    public function getIdTipoResiduo(): int {
        return $this->id_tipo_residuo;
    }

    public function setAtivo(bool $ativo): void {
        $this->ativo = $ativo;
    }

    public function getAtivo(): bool {
        return $this->ativo;
    }
    
    public function save(): bool {
        $conexao = new MySQL();

        if(isset($this->id)){
            $sql = "UPDATE residuo SET nome = ?, descricao = ?, imagem = ?,
            id_tipo_residuo = ?, ativo = ? WHERE id = ?";
            $type_param = "sssiii";
            $param = [$this->nome, $this->descricao, $this->imagem, $this->id_tipo_residuo, $this->ativo, $this->id];
        } else {
            $sql = "INSERT INTO residuo (nome, descricao, imagem, id_tipo_residuo) VALUES (?, ?, ?, ?)";
            $type_param = "sssi";
            $param = [$this->nome, $this->descricao, $this->imagem, $this->id_tipo_residuo];
        }

        return $conexao->executa($sql, $type_param, $param);
    }

    public function delete(): bool {
        $conexao = new MySQL();

        $sql = "UPDATE residuo SET ativo = false WHERE id = ?";
        $type_param = "i";
        $param = [$this->id];

        $this->ativo = false;

        return $conexao->executa($sql, $type_param, $param);
    }

    public static function find($id): ?Object {
        $conexao = new MySQL();

        $sql = "SELECT * FROM residuo WHERE id = ?";
        $type_param = "i";
        $param = [$id];

        $resultados = $conexao->consulta($sql, $type_param, $param);

        if(empty($resultados)) {
            return null;
        }

        $residuo = new Residuo($resultados[0]['nome'], $resultados[0]['descricao'], $resultados[0]['imagem'], $resultados[0]['id_tipo_residuo']);
        $residuo->setId($resultados[0]['id']);
        $residuo->setAtivo($resultados[0]['ativo']);

        return $residuo;
    }

    public static function findAll(): array {
        $conexao = new MySQL();

        $sql = "SELECT * FROM residuo WHERE ativo = true";

        $resultados = $conexao->consulta($sql);

        $tiposResiduos = array();

        foreach ($resultados as $resultado) {
            $tipoResiduo = new Residuo($resultado['nome'], $resultado['descricao'], $resultado['imagem'], $resultado['id_tipo_residuo']);
            $tipoResiduo->setId($resultado['id']);
            $tipoResiduo->setAtivo($resultado['ativo']);

            $tiposResiduos[] = $tipoResiduo;
        }

        return $tiposResiduos;
    }
}
?>
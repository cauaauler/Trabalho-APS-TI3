<?php 

class Residuo implements ActiveRecord{
    private int $id;

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

    public function getIdTipoRe(): int {
        return $this->id_tipo_residuo;
    }

    public function save(): bool {
        $conexao = new MySQL();

        if(isset($this->id)){
            $sql = "UPDATE residuo SET nome = ?, descricao = ?, imagem = ?,
            id_tipo_residuo = ? WHERE id = ?";
            $type_param = "sssii";
            $param = [$this->nome, $this->descricao, $this->imagem, $this->id_tipo_residuo, $this->id];
        } else {
            $sql = "INSERT INTO residuo (nome, descricao, imagem, id_tipo_residuo) VALUES (?, ?, ?, ?)";
            $type_param = "sssi";
            $param = [$this->nome, $this->descricao, $this->imagem, $this->id_tipo_residuo];
        }

        return $conexao->executa($sql, $type_param, $param);
    }
}
?>
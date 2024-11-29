<?php

include_once __DIR__ . "/../classes/ActiveRecord.php";
include_once __DIR__ . "/../classes/MySQL.php";

class TipoResiduo {
    private int $id;
    
    public function __construct(
        private string $tipo
    ){}

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTipo(): string {
        return $this->tipo;
    }

    public static function find($id): Object {
        $conexao = new MySQL();

        $sql = "SELECT * FROM tipo_residuo WHERE id = ?";
        $type_param = "i";
        $param = [$id];

        $resultados = $conexao->consulta($sql, $type_param, $param);

        $tipoResiduo = new TipoResiduo($resultados[0]['tipo']);
        $tipoResiduo->setId($resultados[0]['id']);

        return $tipoResiduo;
    }

    public static function findAll(): array {
        $conexao = new MySQL();

        $sql = "SELECT * FROM tipo_residuo";

        $resultados = $conexao->consulta($sql);

        $tiposResiduos = array();

        foreach ($resultados as $resultado) {
            $tipoResiduo = new TipoResiduo($resultado['tipo']);
            $tipoResiduo->setId($resultado['id']);

            $tiposResiduos[] = $tipoResiduo;
        }

        return $tiposResiduos;
    }
}
?>
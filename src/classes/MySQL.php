<?php
require_once __DIR__."/Configuracao.php";

class MySQL{
	private $connection;
	
	public function __construct(){
		$this->connection = new mysqli(HOST,USUARIO,SENHA,BANCO);
		$this->connection->set_charset("utf8");
	}

	public function executa($sql, $type_param = "", $param = []){
		$result = $this->connection->prepare($sql);
		$result->bind_param($type_param, ...$param);
		
		return $result->execute();
	}

	public function consulta($sql, $type_param = "", $param = []){
		$query = $this->connection->prepare($sql);

		if(!empty($param)) {
			$query->bind_param($type_param, ...$param);
		}

		$query->execute();
		$result = $query->get_result();

		$data = array();

		while($item = mysqli_fetch_array($result)) {
			$data[] = $item;
		}

		return $data;
	}
}
?>
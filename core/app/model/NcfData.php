<?php
class NcfData {
	public static $tablename = "nfc";

	public function NcfData(){
		$this->tipo = "";
		$this->secuencia = "";
		
	
	}

	
	public function add(){
		$sql = "insert into ".self::$tablename." (tipo,secuencia,cantidad) ";
		$sql .= "value (\"$this->tipo\",\"$this->secuencia\",\"$this->cantidad\")";
		return Executor::doit($sql);
	}
	


	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto ProductData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set tipo=\"$this->tipo\",secuencia=\"$this->secuencia\",cantidad=\"$this->cantidad\" where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new NcfData());

	}

	public static function getAllNcf(){
		$sql = "select * from ".self::$tablename." limit 1";
		$query = Executor::doit($sql);
		return Model::one($query[0],new NcfData());
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new NcfData());
	}







}

?>
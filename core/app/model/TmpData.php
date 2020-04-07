<?php
class TmpData {
	public static $tablename = "tmp";



	public function TmpData(){
		$this->cantidad_tmp = "";
		$this->precio_tmp = "";
		
	}
	public function getProduct(){ return ProductoData::getById($this->id_producto);}
	
	public function add(){
		$sql = "insert into tmp (id_producto,cantidad_tmp,precio_tmp) ";
		$sql .= "value (\"$this->id_producto\",\"$this->cantidad_tmp\",\"$this->precio_tmp\")";
		Executor::doit($sql);
	}

	public function addTmp(){
		$sql = "insert into tmp (id_producto,cantidad_tmp,precio_tmp,sessionn_id) ";
		$sql .= "value (\"$this->id_producto\",\"$this->cantidad_tmp\",\"$this->precio_tmp\",\"$this->sessionn_id\")";
		Executor::doit($sql);
	}



	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id_tmp=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_tmp=$this->id_tmp";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto





	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id_tmp=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new TmpData());

	}

	
	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new TmpData());
	}
	
	public static function getAllTemporal($id_session){
		$sql = "select * from ".self::$tablename." where sessionn_id=\"$id_session\" ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TmpData());
	}
	


}

?>
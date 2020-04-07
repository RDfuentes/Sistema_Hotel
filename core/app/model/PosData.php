<?php
class PosData {
	public static $tablename = "pos"; 

	public function PosData(){
		$this->fecha = "";
		$this->noches = "";
		$this->pago_efectivo = "";
		$this->numero_boleta = "";
		$this->pago_pos = "";
		$this->autorizacion = "";
		$this->numero_factura = "";
		$this->fecha_creada = "NOW()";
	}

	public function add(){
		$sql = "insert into pos (fecha,noches,pago_efectivo,numero_boleta,pago_pos,autorizacion,numero_factura,fecha_creada) ";
		$sql .= "value (\"$this->fecha\",\"$this->noches\",$this->pago_efectivo,$this->numero_boleta,$this->pago_pos,$this->autorizacion,$this->numero_factura,$this->fecha_creada)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CategoriaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set fecha=\"$this->fecha\", noches=\"$this->noches\",pago_efectivo=\"$this->pago_efectivo\",numero_boleta=\"$this->numero_boleta\",pago_pos=\"$this->pago_pos\",autorizacion=\"$this->autorizacion\",numero_factura=\"$this->numero_factura\" where id=$this->id";
		Executor::doit($sql);
	}




	   public static function getReporte($hoy){
	$sql = "select * from ".self::$tablename." where date(fecha_creada) = \"$hoy\" ";
	$query = Executor::doit($sql);
	return Model::many($query[0],new PosData());
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PosData());

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PosData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where noches like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PosData());

	}


}

?>
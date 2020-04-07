<?php
class ProcesoVentaData {
	public static $tablename = "proceso_venta";


	public function ProcesoVentaData(){
		$this->cantidad = ""; 
		$this->precio = "";
		$this->fecha_creada = "NOW()";
	} 

	public function getProducto(){ return ProductoData::getById($this->id_producto);}
	public function getProceso(){ return ProcesoData::getById($this->id_operacion);}
	public function getUsuario(){ return UserData::getById($this->id_usuario);}


	public function add(){ 
		$sql = "insert into proceso_venta (id_producto,id_operacion,cantidad,precio,id_usuario,fecha_creada,id_caja) ";
		$sql .= "value ($this->id_producto,$this->id_operacion,$this->cantidad,\"$this->precio\",$this->id_usuario,$this->fecha_creada,$this->id_caja)";
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

// partiendo de que ya tenemos creado un objecto PersonaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",descripcion=\"$this->descripcion\",id_categoria=$this->id_categoria where id=$this->id";
		Executor::doit($sql);
	}

	public function updateFecha(){
		$sql = "update ".self::$tablename." set fecha_creada=\"$this->fecha_creada\" where id=$this->id";
		Executor::doit($sql);
	}

	

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProcesoVentaData());

	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoVentaData());
	}

 
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where id like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoVentaData());

	}

	public static function getByAll($id){
		$sql = "select * from ".self::$tablename." where id_operacion=$id ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoVentaData());

	}

	public static function getReporteDiario($hoy){
		$sql = "select * from ".self::$tablename." where date(fecha_creada) = \"$hoy\"  ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoVentaData());

	}

	public static function getReporteDiarioUser($hoy,$user){
		$sql = "select * from ".self::$tablename." where date(fecha_creada) = \"$hoy\"  and id_usuario=$user ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoVentaData());
	}

  
	public static function getIngresoCaja($id_caja){
		$sql = "select * from ".self::$tablename." where id_caja=$id_caja and date(fecha_creada) != 'NULL'  ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoVentaData());
	}


}

?>
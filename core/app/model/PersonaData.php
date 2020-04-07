<?php
class PersonaData {
	public static $tablename = "persona";


	public function PersonaData(){
		$this->documento = ""; 
		$this->nombre = "";
		$this->apellido = "";
		$this->telefono = "";
		$this->nacionalidad = "";
		$this->direccion = "";
		$this->extendido = "";
		$this->razon_social = "";
		$this->fecha_nac = "";
		$this->profesion = "";
		$this->fecha_creada = "NOW()";
	} 

	public function getTipoDocumento(){ return TipoDocumentoData::getById($this->tipo_documento);}

	public function addCliente(){
		$sql = "insert into persona (tipo_documento,documento,nombre,apellido,telefono,nacionalidad,direccion,extendido,razon_social,fecha_nac,profesion,tipo,fecha_creada) ";
		$sql .= "value ($this->tipo_documento,\"$this->documento\",\"$this->nombre\",\"$this->apellido\",\"$this->telefono\",\"$this->nacionalidad\",\"$this->direccion\",\"$this->extendido\",\"$this->razon_social\",\"$this->fecha_nac\",\"$this->profesion\",1,$this->fecha_creada)";
		return Executor::doit($sql);
	}

	public function add(){
		$sql = "insert into persona (tipo_documento,documento,nombre,apellido,telefono,nacionalidad,direccion,extendido,razon_social,profesion,tipo,fecha_creada) ";
		$sql .= "value ($this->tipo_documento,\"$this->documento\",\"$this->nombre\",\"$this->apellido\",\"$this->telefono\",\"$this->nacionalidad\",\"$this->direccion\",\"$this->extendido\",\"$this->razon_social\",\"$this->profesion\",1,$this->fecha_creada)";
		return Executor::doit($sql);
	}

	public function addProveedor(){
		$sql = "insert into persona (tipo_documento,documento,nombre,apellido,nacionalidad,razon_social,direccion,tipo,fecha_creada) ";
		$sql .= "value ($this->tipo_documento,\"$this->documento\",\"$this->nombre\",\"$this->apellido\",\"$this->nacionalidad\",\"$this->razon_social\",\"$this->direccion\",1,$this->fecha_creada)";
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

	public function updatecliente(){
		$sql = "update ".self::$tablename." set tipo_documento=$this->tipo_documento,documento=\"$this->documento\",nombre=\"$this->nombre\",apellido=\"$this->apellido\",telefono=\"$this->telefono\",nacionalidad=\"$this->nacionalidad\",direccion=\"$this->direccion\",extendido=\"$this->extendido\",razon_social=\"$this->razon_social\",fecha_nac=\"$this->fecha_nac\",profesion=\"$this->profesion\" where id=$this->id";
		Executor::doit($sql);
	}

	

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PersonaData());

	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." where tipo=1 ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PersonaData());
	}

	public static function getProveedor(){
		$sql = "select * from ".self::$tablename." where tipo=2 ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PersonaData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where nombre like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PersonaData());

	}

	public static function getLikeDni($documento){
		$sql = "select * from ".self::$tablename." where documento=\"$documento\" ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PersonaData());

	}

}

?>
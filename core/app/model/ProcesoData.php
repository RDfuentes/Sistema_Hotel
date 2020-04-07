<?php
class ProcesoData {
	public static $tablename = "proceso";


	public function ProcesoData(){
		$this->dinero_dejado = ""; 
		$this->fecha_entrada = "";
		$this->cant_personas = "";
		$this->num_factura = "";
		$this->fecha_entra = "";
		$this->fecha_salida = "";
		$this->fecha_creada = "NOW()";
	} 

	public function getHabitacion(){ return HabitacionData::getById($this->id_habitacion);}
	public function getCliente(){ return PersonaData::getById($this->id_cliente);}
	public function getUsuario(){ return UserData::getById($this->id_usuario);}

	public function addIngreso(){
		$sql = "insert into proceso (id_habitacion,id_cliente,dinero_dejado,id_tipo_pago,fecha_entrada,fecha_entra,id_usuario,cant_personas,num_factura,id_caja,fecha_creada) ";
		$sql .= "value ($this->id_habitacion,\"$this->id_cliente\",\"$this->dinero_dejado\",1,\"$this->fecha_entrada\",\"$this->fecha_entra\",$this->id_usuario,\"$this->cant_personas\",\"$this->num_factura\",\"$this->id_caja\",$this->fecha_creada)";
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

// partiendo de que ya tenemos creado un objecto PersonaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",descripcion=\"$this->descripcion\",id_categoria=$this->id_categoria where id=$this->id";
		Executor::doit($sql);
	}

	public function updateSalida(){
		$sql = "update ".self::$tablename." set fecha_salida=\"$this->fecha_salida\",total=\"$this->total\",id_tipo_pago=$this->id_tipo_pago,estado=1 where id=$this->id";
		Executor::doit($sql);
	}
	

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProcesoData());

	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where id_habitacion like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoData());

	}

	public static function getProceso(){
		$sql = "select * from ".self::$tablename." where estado=0 ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoData());

	}

	public static function getReporteDiario($hoy){
		$sql = "select * from ".self::$tablename." where date(fecha_entrada) = \"$hoy\" or date(fecha_salida) = \"$hoy\" ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoData());

	}

	public static function getReporteDiarioUser($hoy,$user){
		$sql = "select * from ".self::$tablename." where date(fecha_entrada) = \"$hoy\" or date(fecha_salida) = \"$hoy\" and id_usuario=$user ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoData());

	}

	public static function getIngresoCaja($id_caja){
		$sql = "select * from ".self::$tablename." where id_caja=$id_caja  ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoData());
	}

	public static function getReporteMensualUser($anio,$mes,$user){
		$sql = "select * from ".self::$tablename." where ( year(fecha_entrada) = $anio or year(fecha_salida) = $anio) and (month(fecha_entrada) = $mes or month(fecha_salida) = $mes) and id_usuario=$user ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoData());

	}

	public static function getReporteMensual($anio,$mes){
		$sql = "select * from ".self::$tablename." where ( year(fecha_entrada) = $anio or year(fecha_salida) = $anio) and (month(fecha_entrada) = $mes or month(fecha_salida) = $mes)  ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoData());

	}

	public static function getReporteMensual11($dia,$mes){
		$sql = "select * from ".self::$tablename." where day(fecha_entrada) = \"$dia\"  and month(fecha_entrada) = \"$mes\" ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoData());

	}

	



} 

?>
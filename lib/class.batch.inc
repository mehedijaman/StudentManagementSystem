<?php 

class batch{

	private $_batch_id;
	private $_batch_name;
	private $_is_active;


	public function __get($property_name){

		$private_property_name = '_'.$property_name;
		if(property_exists($this, $private_property_name)){
			return $this->$private_property_name;
		}		trigger_error('Undefined property named through __get(), field name='.$property_name);
		return null;

	}


	public function __set($property_name, $value){

		$private_property_name = '_'.$property_name;
		if(property_exists($this, $private_property_name)){
			$this->$private_property_name = $value;
		}
	}
	public function create($data){
		$objDB = new db;

		$this->_batch_name = $data['batch_name'];
		$this->_is_active = $data['is_active'];
		$sql = "INSERT INTO batch(
			batch_name,is_active )";
		$sql.= " VALUES('$this->_batch_name',$this->_is_active)";
		$objDB->execute($sql);
		$this->_batch_id = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM batch WHERE batch_id = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_batch_id = $id;
		$this->_batch_name = $data[0]['batch_name'];
		$this->_is_active = $data[0]['is_active'];
		$objDB->close();
		return $data;
	}
	public function delete($id){
		$this->_batch_id = $id;
		$sql = "DELETE FROM batch WHERE batch_id = $this->_batch_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update(){
		$sql = "UPDATE batch SET batch_name = '$this->_batch_name',	is_active = $this->_is_active WHERE batch_id = $this->_batch_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function get_all(){
		$sql = "SELECT * FROM batch";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_all_active(){
		$sql = "SELECT * FROM batch WHERE is_active = 1";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}
}

  ?>
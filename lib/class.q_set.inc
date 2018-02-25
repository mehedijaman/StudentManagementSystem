<?php 

class q_set{

	private $_setID;
	private $_set_name;


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

		$this->_set_name = $data['set_name'];
		$sql = "INSERT INTO q_set(
			set_name )";
		$sql.= " VALUES('$this->_set_name')";
		$objDB->execute($sql);
		$this->_setID = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM q_set WHERE setID = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_setID = $id;
		$this->_set_name = $data[0]['set_name'];
		$objDB->close();
		return $data;
	}
	public function delete(){
		$sql = "DELETE FROM q_set WHERE setID = $this->_setID";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update($data){
		$this->_set_name = $data['set_name'];
		$this->_setID = $data['setID'];


		echo $sql = "UPDATE q_set SET 
		set_name = '$this->_set_name' WHERE setID = $this->_setID";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}

	public function get_all(){
		$sql = "SELECT * FROM q_set";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}
}

 

?>
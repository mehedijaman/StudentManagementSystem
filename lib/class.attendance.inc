<?php 
class attendance{

	private $_attendance_id;
	private $_student_id;
	private $_is_present;
	private $_date;


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

		$this->_student_id = $data['student_id'];
		$this->_is_present = $data['is_present'];
		$this->_date = $data['date'];
		$sql = "INSERT INTO attendance(
			student_id,is_present,date )";
		$sql.= " VALUES($this->_student_id,$this->_is_present,'$this->_date')";
		$objDB->execute($sql);
		$this->_attendance_id = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM attendance WHERE attendance_id = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_attendance_id = $id;
		$this->_student_id = $data[0]['student_id'];
		$this->_is_present = $data[0]['is_present'];
		$this->_date = $data[0]['date'];
		$objDB->close();
		return $data
	}
	public function delete($id){
		$this->_attendance_id = $id;
		$sql = "DELETE FROM attendance WHERE attendance_id = $this->_attendance_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update(){
		$sql = "UPDATE attendance SET 
		student_id = $this->_student_id,		is_present = $this->_is_present,		date = $this->_date WHERE attendance_id = $this->_attendance_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function get_all(){
		$sql = "SELECT * FROM attendance";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}
}

 

 ?>
<?php 
class exam{

	private $_exam_id;
	private $_exam_name;
	private $_date;
	private $_marks;
	private $_duration;


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

		$this->_exam_name = $data['exam_name'];
		$this->_date = $data['date'];
		$this->_marks = $data['marks'];
		$this->_duration = $data['duration'];
		$sql = "INSERT INTO exam(
			exam_name,date,marks,duration )";
		$sql.= " VALUES('$this->_exam_name','$this->_date',$this->_marks,'$this->_duration')";
		$objDB->execute($sql);
		$this->_exam_id = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM exam WHERE exam_id = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_exam_id = $id;
		$this->_exam_name = $data[0]['exam_name'];
		$this->_date = $data[0]['date'];
		$this->_marks = $data[0]['marks'];
		$this->_duration = $data[0]['duration'];
		$objDB->close();
		return $data;
	}
	public function delete($id){
		$this->_exam_id = $id;
		$sql = "DELETE FROM exam WHERE exam_id = $this->_exam_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update(){
		$sql = "UPDATE exam SET 
		exam_name = '$this->_exam_name', date = '$this->_date', marks = $this->_marks,		duration = '$this->_duration' WHERE exam_id = $this->_exam_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function get_all(){
		$sql = "SELECT * FROM exam";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}
}

  ?>
<?php class result{

	private $_result_id;
	private $_student_id;
	private $_exam_id;
	private $_marks;


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
		$this->_exam_id = $data['exam_id'];
		$this->_marks = $data['marks'];
		$sql = "INSERT INTO result(
			student_id,exam_id,marks )";
		$sql.= " VALUES($this->_student_id,$this->_exam_id,$this->_marks)";
		$objDB->execute($sql);
		$this->_result_id = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM result WHERE result_id = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_result_id = $id;
		$this->_student_id = $data[0]['student_id'];
		$this->_exam_id = $data[0]['exam_id'];
		$this->_marks = $data[0]['marks'];
		$objDB->close();
		return $data;
	}
	public function delete($id){
		$this->_result_id = $id;
		$sql = "DELETE FROM result WHERE result_id = $this->_result_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update(){
		$sql = "UPDATE result SET 
		student_id = $this->_student_id,		exam_id = $this->_exam_id,		marks = $this->_marks WHERE result_id = $this->_result_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function get_all(){
		$sql = "SELECT * FROM result";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_student_result($student_id){
		$sql = "SELECT * FROM result WHERE student_id = $student_id";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_exam_result($exam_id){
		$sql = "SELECT * FROM result where exam_id=$exam_id";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}
}

  ?>
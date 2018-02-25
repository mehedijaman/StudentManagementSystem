<?php 
class subject{

	private $_subjectID;
	private $_subject_name;


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

		$this->_subject_name = $data['subject_name'];
		$sql = "INSERT INTO subject(
			subject_name )";
		$sql.= " VALUES('$this->_subject_name')";
		$objDB->execute($sql);
		$this->_subjectID = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM subject WHERE subjectID = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_subjectID = $id;
		$this->_subject_name = $data[0]['subject_name'];
		$objDB->close();
		return $data;
	}
	public function delete(){
		$sql = "DELETE FROM subject WHERE subjectID = $this->_subjectID";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update($data){
		$this->_subject_name = $data['subject_name'];
		$this->_subjectID = $data['subjectID'];
		$sql = "UPDATE subject SET 
		subject_name = '$this->_subject_name' WHERE subjectID = $this->_subjectID";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}

	public function get_all(){
		$sql = "SELECT * FROM subject";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}
}

 
?>
<?php

class settings{

	private $_settingsID;
	private $_institute_name;
	private $_director_name;
	private $_address;
	private $_phone;
	private $_email;
	private $_username;
	private $_pass;


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

		$this->_institute_name = $data['institute_name'];
		$this->_director_name = $data['director_name'];
		$this->_address = $data['address'];
		$this->_phone = $data['phone'];
		$this->_email = $data['email'];
		$this->_username = $data['username'];
		$this->_pass = $data['pass'];
		$sql = "INSERT INTO settings(
			institute_name,director_name,address,phone,email,username,pass )";
		$sql.= " VALUES('$this->_institute_name','$this->_director_name','$this->_address','$this->_phone','$this->_email','$this->_username','$this->_pass')";
		$objDB->execute($sql);
		$this->_settingsID = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM settings WHERE settingsID = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_settingsID = $id;
		$this->_institute_name = $data[0]['institute_name'];
		$this->_director_name = $data[0]['director_name'];
		$this->_address = $data[0]['address'];
		$this->_phone = $data[0]['phone'];
		$this->_email = $data[0]['email'];
		$this->_username = $data[0]['username'];
		$this->_pass = $data[0]['pass'];
		$objDB->close();
		return $result;
	}
	public function delete($id){
		$this->_settingsID = $id;
		$sql = "DELETE FROM settings WHERE settingsID = $this->_settingsID";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update($data){
		$this->_settingsID = $data['settingsID'];
		$this->_institute_name = $data['institute_name'];
		$this->_director_name = $data['director_name'];
		$this->_address = $data['address'];
		$this->_phone = $data['phone'];
		$this->_email = $data['email'];
		$this->_username = $data['username'];
		$this->_pass = $data['pass'];
		
		$sql = "UPDATE settings SET 
		institute_name = '$this->_institute_name',		director_name = '$this->_director_name',		address = '$this->_address',		phone = '$this->_phone',		email = '$this->_email',		username = '$this->_username',		pass = '$this->_pass' WHERE settingsID = $this->_settingsID";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
}

 
?>
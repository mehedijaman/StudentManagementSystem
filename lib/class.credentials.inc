<?php 
class credentials{

	private $_username;
	private $_password;


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
	// public function create($data){
	// 	$objDB = new db;

	// 	$this->_username = mysql_real_escape_string($data['username']);
	// 	$this->_password = $data['password'];
	// 	$sql = "INSERT INTO credentials(
	// 		username,password )";
	// 	$sql.= " VALUES('$this->_username','$this->_password')";
	// 	$objDB->execute($sql);
	// 	$this->_username = $data['username'];

	// 	$objDB->close();
	// }
	// public function get_by_pk($id){
	// 	$sql = "SELECT * FROM credentials WHERE username = '$id'";
	// 	$objDB = new db;

	// 	$data = $objDB->fetch_result($sql);
	// 	$this->_username = $id;
	// 	$this->_password = $data[0]['password'];
	// 	$objDB->close();
	// 	return $data;
	// }
	public function delete(){
		$sql = "DELETE FROM credentials WHERE username = '$this->_username'";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update(){
		$sql = "UPDATE credentials SET 
		password = '$this->_password' WHERE username = '$this->_username'";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}

	public function get_all(){
		$sql = "SELECT * FROM credentials";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function check_credentials($username,$password){
		$sql = "SELECT * FROM credentials WHERE username = '$username' AND password = '$password'";

		$objDB = new db;
		echo $result = $objDB->execute($sql);
		// $result = mysql_num_rows($row);
		$objDB->close();
		return $result;
	}
}

  ?>
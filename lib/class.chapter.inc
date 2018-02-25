<?php 
class chapter{

	private $_chapterID;
	private $_chapter_name;


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

		$this->_chapter_name = $data['chapter_name'];
		$sql = "INSERT INTO chapter(
			chapter_name )";
		$sql.= " VALUES('$this->_chapter_name')";
		$objDB->execute($sql);
		$this->_chapterID = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM chapter WHERE chapterID = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_chapterID = $id;
		$this->_chapter_name = $data[0]['chapter_name'];
		$objDB->close();
		return $data;
	}
	public function delete(){
		$sql = "DELETE FROM chapter WHERE chapterID = $this->_chapterID";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update($data){
		$this->_chaperID = $data['chapterID'];
		$this->_chapter_name = $data['chapter_name'];

		$sql = "UPDATE chapter SET 
		chapter_name = '$this->_chapter_name' WHERE chapterID = $this->_chapterID";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}

	public function get_all(){
		$sql = "SELECT * FROM chapter";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}
}

 

 ?>
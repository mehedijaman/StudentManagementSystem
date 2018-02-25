<?php class payment{

	private $_payment_id;
	private $_student_id;
	private $_month;
	private $_year;
	private $_payment_date;
	private $_amound_paid;
	private $_remarks;


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
		$this->_month = $data['month'];
		$this->_year = $data['year'];
		$this->_payment_date = $data['payment_date'];
		$this->_amound_paid = $data['amound_paid'];
		$this->_remarks = $data['remarks'];
		$sql = "INSERT INTO payment(
			student_id,month,year,payment_date,amound_paid,remarks )";
		$sql.= " VALUES($this->_student_id,'$this->_month','$this->_year','$this->_payment_date',$this->_amound_paid,'$this->_remarks')";
		$objDB->execute($sql);
		$this->_payment_id = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM payment WHERE payment_id = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_payment_id = $id;
		$this->_student_id = $data[0]['student_id'];
		$this->_month = $data[0]['month'];
		$this->_year = $data[0]['year'];
		$this->_payment_date = $data[0]['payment_date'];
		$this->_amound_paid = $data[0]['amound_paid'];
		$this->_remarks = $data[0]['remarks'];
		$objDB->close();
		return $data;
	}
	public function delete($id){
		$this->_payment_id = $id;
		$sql = "DELETE FROM payment WHERE payment_id = $this->_payment_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update(){
		$sql = "UPDATE payment SET 
		student_id = $this->_student_id,		month = '$this->_month',		year = '$this->_year',		payment_date = $this->_payment_date,		amound_paid = $this->_amound_paid,		remarks = '$this->_remarks' WHERE payment_id = $this->_payment_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function get_all(){
		$sql = "SELECT * FROM payment";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_yearly_report($year){
		$sql = "SELECT * FROM payment WHERE year=$year";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_monthly_report($data){
		$this->_month = $data['month'];
		$this->_year = $data['year'];

		$sql = "SELECT * FROM payment WHERE year = $this->_year AND month = '$this->_month'";
		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}
}

  ?>
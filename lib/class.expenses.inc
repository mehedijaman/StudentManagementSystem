<?php class expenses{

	private $_expense_id;
	private $_voucher_number;
	private $_receiver;
	private $_date;
	private $_month;
	private $_year;
	private $_description;
	private $_amount;
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

		$this->_voucher_number = $data['voucher_number'];
		$this->_receiver = $data['receiver'];
		$this->_date = $data['date'];
		$this->_month = $data['month'];
		$this->_year = $data['year'];
		$this->_description = $data['description'];
		$this->_amount = $data['amount'];
		$this->_remarks = $data['remarks'];
		$sql = "INSERT INTO expenses(
			voucher_number,receiver,date,month,year,description,amount,remarks )";
		$sql.= " VALUES('$this->_voucher_number','$this->_receiver','$this->_date','$this->_month','$this->_year','$this->_description',$this->_amount,'$this->_remarks')";
		$objDB->execute($sql);
		$this->_expense_id = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM expenses WHERE expense_id = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_expense_id = $id;
		$this->_voucher_number = $data[0]['voucher_number'];
		$this->_receiver = $data[0]['receiver'];
		$this->_date = $data[0]['date'];
		$this->_month = $data[0]['month'];
		$this->_year = $data[0]['year'];
		$this->_description = $data[0]['description'];
		$this->_amount = $data[0]['amount'];
		$this->_remarks = $data[0]['remarks'];
		$objDB->close();
		return $data;
	}
	public function delete($id){
		$this->_expense_id = $id;
		$sql = "DELETE FROM expenses WHERE expense_id = $this->_expense_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update($data){
		$this->_voucher_number = $data['voucher_number'];
		$this->_receiver = $data['receiver'];
		$this->_date = $data['date'];
		$this->_month = $data['month'];
		$this->_year = $data['year'];
		$this->_description = $data['description'];
		$this->_amount = $data['amount'];
		$this->_remarks = $data['remarks'];

		$sql = "UPDATE expenses SET 
		voucher_number = '$this->_voucher_number',receiver = '$this->_receiver',date = '$this->_date',month = '$this->_month',year = '$this->_year',description = '$this->_description',amount = $this->_amount,remarks = '$this->_remarks' WHERE expense_id = $this->_expense_id";
		
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function get_all(){
		$sql = "SELECT * FROM expenses";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_yearly_report($year){
		$sql = "SELECT * FROM expenses WHERE year = '$year'";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_monthly_report($data){
		$this->_year = $data['year'];
		$this->_month = $data['month'];
		$sql = "SELECT * FROM expenses WHERE year = '$this->_year' AND month = '$this->_month' ";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}
}

  ?>
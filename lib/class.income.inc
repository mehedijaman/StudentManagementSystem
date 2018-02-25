<?php 
	class income{

		private $_incomeID;
		private $_description;
		private $_income_source;
		private $_day;
		private $_month;
		private $_year;
		private $_amount;


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

			$this->_description = $data['description'];
			$this->_income_source = $data['income_source'];
			$this->_day = $data['day'];
			$this->_month = $data['month'];
			$this->_year = $data['year'];
			$this->_amount = $data['amount'];
			$sql = "INSERT INTO income(description,income_source,day,month,year,amount )";
			$sql.= " VALUES('$this->_description','$this->_income_source',$this->_day,'$this->_month',$this->_year,$this->_amount)";
			$objDB->execute($sql);
			$this->_incomeID = mysql_insert_id();

			$objDB->close();
		}
		public function get_by_pk($id){
			$sql = "SELECT * FROM income WHERE incomeID = $id";
			$objDB = new db;

			$data = $objDB->fetch_result($sql);
			$this->_incomeID = $id;
			$this->_description = $data[0]['description'];
			$this->_day = $data[0]['day'];
			$this->_month = $data[0]['month'];
			$this->_year = $data[0]['year'];
			$this->_amount = $data[0]['amount'];
			$objDB->close();
			return $data;
		}
		public function delete(){
			$sql = "DELETE FROM income WHERE incomeID = $this->_incomeID";
			$objDB = new db;
			$objDB->execute($sql);
			$objDB->close();
		}
		public function update($id){
			$this->incomeID = $id;
			$sql = "UPDATE income SET 
			description = '$this->_description',		day = $this->_day,		month = '$this->_month',		year = $this->_year,		amount = $this->_amount WHERE incomeID = $this->_incomeID";
			$objDB = new db;
			$objDB->execute($sql);
			$objDB->close();
		}

		public function get_all(){
			$sql = "SELECT * FROM income";
			$objDB = new db;
			$result = $objDB->fetch_result($sql);
			$objDB->close();
			return $result;
		}
		public function get_yearly_report($year){
			$sql = "SELECT * FROM income WHERE year = '$year'";

			$objDB = new db;
			$result = $objDB->fetch_result($sql);
			$objDB->close();
			return $result;
		}

		public function get_monthly_report($data){
			$this->_year = $data['year'];
			$this->_month = $data['month'];
			$sql = "SELECT * FROM income WHERE year = '$this->_year' AND month = '$this->_month' ";

			$objDB = new db;
			$result = $objDB->fetch_result($sql);
			$objDB->close();
			return $result;
		}

		public function get_sourcewise_statemnt($data){
			$this->_income_source = $data['income_source'];
			$this->_year = $data['year'];
			$this->_month = $data['month'];

			$sql = "SELECT * FROM income WHERE year ='$this->_year' AND month = '$this->_month' AND income_source = '$this->_income_source' ";

			$objDB = new db;
			$result = $objDB->fetch_result($sql);
			$objDB->close();
			return $result;
		}
	}
 ?>
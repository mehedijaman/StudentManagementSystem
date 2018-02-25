<?php 
	class income_source{

		private $_incomeSourceID;
		private $_income_source_name;


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

			$this->_income_source_name = $data['income_source_name'];
			$sql = "INSERT INTO income_source(
				income_source_name )";
			$sql.= " VALUES('$this->_income_source_name')";
			$objDB->execute($sql);
			$this->_incomeSourceID = mysql_insert_id();

			$objDB->close();
		}
		public function get_by_pk($id){
			$sql = "SELECT * FROM income_source WHERE incomeSourceID = $id";
			$objDB = new db;

			$data = $objDB->fetch_result($sql);
			$this->_incomeSourceID = $id;
			$this->_income_source_name = $data[0]['income_source_name'];
			$objDB->close();
			return $data;
		}
		public function delete(){
			$sql = "DELETE FROM income_source WHERE incomeSourceID = $this->_incomeSourceID";
			$objDB = new db;
			$objDB->execute($sql);
			$objDB->close();
		}
		public function update($data){
			$this->_incomeSourceID = $data['incomeSourceID'];
			$this->_income_source_name = $data['source_name'];
			
			$sql = "UPDATE income_source SET 
			income_source_name = '$this->_income_source_name' WHERE incomeSourceID = $this->_incomeSourceID";
			$objDB = new db;
			$objDB->execute($sql);
			$objDB->close();
		}

		public function get_all(){
			$sql = "SELECT * FROM income_source";

			$objDB = new db;
			$result = $objDB->fetch_result($sql);
			$objDB->close();
			return $result;
		}

		
	}
?>
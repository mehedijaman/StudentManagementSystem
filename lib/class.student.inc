<?php class student{

	private $_student_id;
	private $_batch_id;
	private $_full_name;
	private $_nick_name;
	private $_institution;
	private $_department;
	private $_date_of_birth;
	private $_gender;
	private $_mobile;
	private $_viber;
	private $_whats_app;
	private $_email;
	private $_address;
	private $_remarks;
	private $_father_name;
	private $_father_profession;
	private $_father_mobile;
	private $_mother_name;
	private $_mother_profession;
	private $_mother_mobile;
	private $_blood_group;
	private $_computer_no;
	private $_exam1_name;
	private $_exam1_board;
	private $_exam1_institution;
	private $_exam1_group;
	private $_exam1_gpa;
	private $_exam2_name;
	private $_exam2_board;
	private $_exam2_institution;
	private $_exam2_group;
	private $_exam2_gpa;
	private $_image;
	private $_course_fee;
	private $_is_active;


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

		$this->_batch_id = $data['batch_id'];
		$this->_full_name = $data['full_name'];
		$this->_nick_name = $data['nick_name'];
		$this->_institution = $data['institution'];
		$this->_department = $data['department'];
		$this->_date_of_birth = $data['date_of_birth'];
		$this->_gender = $data['gender'];
		$this->_mobile = $data['mobile'];
		$this->_viber = $data['viber'];
		$this->_whats_app = $data['whats_app'];
		$this->_email = $data['email'];
		$this->_address = $data['address'];
		$this->_remarks = $data['remarks'];
		$this->_father_name = $data['father_name'];
		$this->_father_profession = $data['father_profession'];
		$this->_father_mobile = $data['father_mobile'];
		$this->_mother_name = $data['mother_name'];
		$this->_mother_profession = $data['mother_profession'];
		$this->_mother_mobile = $data['mother_mobile'];
		$this->_blood_group = $data['blood_group'];
		$this->_computer_no = $data['computer_no'];
		$this->_exam1_name = $data['exam1_name'];
		$this->_exam1_board = $data['exam1_board'];
		$this->_exam1_institution = $data['exam1_institution'];
		$this->_exam1_group = $data['exam1_group'];
		$this->_exam1_gpa = $data['exam1_gpa'];
		$this->_exam2_name = $data['exam2_name'];
		$this->_exam2_board = $data['exam2_board'];
		$this->_exam2_institution = $data['exam2_institution'];
		$this->_exam2_group = $data['exam2_group'];
		$this->_exam2_gpa = $data['exam2_gpa'];
		$this->_image = $data['image'];
		$this->_course_fee = $data['course_fee'];
		$this->_is_active = $data['is_active'];
		$sql = "INSERT INTO student(
			batch_id,full_name,nick_name,institution,department,date_of_birth,gender,mobile,viber,whats_app,email,address,remarks,father_name,father_profession,father_mobile,mother_name,mother_profession,mother_mobile,blood_group,computer_no,exam1_name,exam1_board,exam1_institution,exam1_group,exam1_gpa,exam2_name,exam2_board,exam2_institution,exam2_group,exam2_gpa,image,course_fee,is_active )";
		$sql.= " VALUES($this->_batch_id,'$this->_full_name','$this->_nick_name','$this->_institution','$this->_department','$this->_date_of_birth','$this->_gender','$this->_mobile','$this->_viber','$this->_whats_app','$this->_email','$this->_address','$this->_remarks','$this->_father_name','$this->_father_profession','$this->_father_mobile','$this->_mother_name','$this->_mother_profession','$this->_mother_mobile','$this->_blood_group','$this->_computer_no','$this->_exam1_name','$this->_exam1_board','$this->_exam1_institution','$this->_exam1_group','$this->_exam1_gpa','$this->_exam2_name','$this->_exam2_board','$this->_exam2_institution','$this->_exam2_group','$this->_exam2_gpa','$this->_image',$this->_course_fee,$this->_is_active)";
		$objDB->execute($sql);
		$this->_student_id = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM student WHERE student_id = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_student_id = $id;
		$this->_batch_id = $data[0]['batch_id'];
		$this->_full_name = $data[0]['full_name'];
		$this->_nick_name = $data[0]['nick_name'];
		$this->_institution = $data[0]['institution'];
		$this->_department = $data[0]['department'];
		$this->_date_of_birth = $data[0]['date_of_birth'];
		$this->_gender = $data[0]['gender'];
		$this->_mobile = $data[0]['mobile'];
		$this->_viber = $data[0]['viber'];
		$this->_whats_app = $data[0]['whats_app'];
		$this->_email = $data[0]['email'];
		$this->_address = $data[0]['address'];
		$this->_remarks = $data[0]['remarks'];
		$this->_father_name = $data[0]['father_name'];
		$this->_father_profession = $data[0]['father_profession'];
		$this->_father_mobile = $data[0]['father_mobile'];
		$this->_mother_name = $data[0]['mother_name'];
		$this->_mother_profession = $data[0]['mother_profession'];
		$this->_mother_mobile = $data[0]['mother_mobile'];
		$this->_blood_group = $data[0]['blood_group'];
		$this->_computer_no = $data[0]['computer_no'];
		$this->_exam1_name = $data[0]['exam1_name'];
		$this->_exam1_board = $data[0]['exam1_board'];
		$this->_exam1_institution = $data[0]['exam1_institution'];
		$this->_exam1_group = $data[0]['exam1_group'];
		$this->_exam1_gpa = $data[0]['exam1_gpa'];
		$this->_exam2_name = $data[0]['exam2_name'];
		$this->_exam2_board = $data[0]['exam2_board'];
		$this->_exam2_institution = $data[0]['exam2_institution'];
		$this->_exam2_group = $data[0]['exam2_group'];
		$this->_exam2_gpa = $data[0]['exam2_gpa'];
		$this->_image = $data[0]['image'];
		$this->_course_fee = $data[0]['course_fee'];
		$this->_is_active = $data[0]['is_active'];
		$objDB->close();
		return $data;
	}
	public function delete($id){
		$this->_student_id = $id;
		$sql = "DELETE FROM student WHERE student_id = $this->_student_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update(){
		$sql = "UPDATE student SET 
		batch_id = $this->_batch_id,		full_name = '$this->_full_name',		nick_name = '$this->_nick_name',		institution = '$this->_institution',		department = '$this->_department',		date_of_birth = '$this->_date_of_birth',		gender = '$this->_gender',		mobile = '$this->_mobile',		viber = '$this->_viber',		whats_app = '$this->_whats_app',		email = '$this->_email',		address = '$this->_address',		remarks = '$this->_remarks',		father_name = '$this->_father_name',		father_profession = '$this->_father_profession',		father_mobile = '$this->_father_mobile',		mother_name = '$this->_mother_name',		mother_profession = '$this->_mother_profession',		mother_mobile = '$this->_mother_mobile',		blood_group = '$this->_blood_group',		computer_no = '$this->_computer_no',		exam1_name = '$this->_exam1_name',		exam1_board = '$this->_exam1_board',		exam1_institution = '$this->_exam1_institution',		exam1_group = '$this->_exam1_group',		exam1_gpa = '$this->_exam1_gpa',		exam2_name = '$this->_exam2_name',		exam2_board = '$this->_exam2_board',		exam2_institution = '$this->_exam2_institution',		exam2_group = '$this->_exam2_group',		exam2_gpa = '$this->_exam2_gpa',		image = '$this->_image',		course_fee = $this->_course_fee,		is_active = $this->_is_active WHERE student_id = $this->_student_id";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function get_all(){
		$sql = "SELECT * FROM student";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_all_active(){
		$sql = "SELECT * FROM student WHERE is_active=1";
		
		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_all_inactive(){
		$sql = "SELECT * FROM student WHERE is_active=0";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_batch_student($batch_id){
		$sql = "SELECT * FROM student WHERE batch_id = $batch_id";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}
}

  ?>
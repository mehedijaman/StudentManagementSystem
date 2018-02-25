<?php 
class question{

	private $_questionID;
	private $_subjectID;
	private $_chapterID;
	private $_setID;
	private $_question_description;
	private $_ans_one;
	private $_ans_two;
	private $_ans_three;
	private $_ans_four;
	private $_true_ans;


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

		$this->_subjectID = $data['subjectID'];
		$this->_chapterID = $data['chapterID'];
		$this->_setID = $data['setID'];
		$this->_question_description = $data['question_description'];
		$this->_ans_one = $data['ans_one'];
		$this->_ans_two = $data['ans_two'];
		$this->_ans_three = $data['ans_three'];
		$this->_ans_four = $data['ans_four'];
		$this->_true_ans = $data['true_ans'];
		$sql = "INSERT INTO question(
			subjectID,chapterID,setID,question_description,ans_one,ans_two,ans_three,ans_four,true_ans )";
		$sql.= " VALUES($this->_subjectID,$this->_chapterID,$this->_setID,'$this->_question_description','$this->_ans_one','$this->_ans_two','$this->_ans_three','$this->_ans_four','$this->_true_ans')";
		$objDB->execute($sql);
		$this->_questionID = mysql_insert_id();

		$objDB->close();
	}
	public function get_by_pk($id){
		$sql = "SELECT * FROM question WHERE questionID = $id";
		$objDB = new db;

		$data = $objDB->fetch_result($sql);
		$this->_questionID = $id;
		$this->_subjectID = $data[0]['subjectID'];
		$this->_chapterID = $data[0]['chapterID'];
		$this->_setID = $data[0]['setID'];
		$this->_question_description = $data[0]['question_description'];
		$this->_ans_one = $data[0]['ans_one'];
		$this->_ans_two = $data[0]['ans_two'];
		$this->_ans_three = $data[0]['ans_three'];
		$this->_ans_four = $data[0]['ans_four'];
		$this->_true_ans = $data[0]['true_ans'];
		$objDB->close();
		return $data;
	}
	public function delete($id){
		$this->_questionID = $id;
		$sql = "DELETE FROM question WHERE questionID = $this->_questionID";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}
	public function update($data){
		$this->_questionID = $data['questionID'];
		$this->_subjectID = $data['subjectID'];
		$this->_chapterID = $data['chapterID'];
		$this->_setID = $data['setID'];
		$this->_question_description = $data['question_description'];
		$this->_ans_one = $data['ans_one'];
		$this->_ans_two = $data['ans_two'];
		$this->_ans_three = $data['ans_three'];
		$this->_ans_four = $data['ans_four'];
		$this->_true_ans = $data['true_ans'];


		$sql = "UPDATE question SET 
		subjectID = $this->_subjectID,		chapterID = $this->_chapterID,		setID = $this->_setID,		question_description = '$this->_question_description',		ans_one = '$this->_ans_one',		ans_two = '$this->_ans_two',		ans_three = '$this->_ans_three',		ans_four = '$this->_ans_four',		true_ans = '$this->_true_ans' WHERE questionID = $this->_questionID";
		$objDB = new db;
		$objDB->execute($sql);
		$objDB->close();
	}

	public function get_all(){
		$sql = "SELECT * FROM question";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_all_by_subject($subjectID){
		$this->_subjectID = $subjectID;

		$sql = "SELECT * FROM question WHERE subjectID = $this->_subjectID";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_all_by_chapter($subjectID, $chapterID){
		$this->_subjectID = $subjectID;
		$this->_chapterID = $chapterID;

		$sql = "SELECT * FROM question WHERE subjectID = $this->_subjectID AND chapterID = $this->_chapterID";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function get_all_by_set($setID){
		$this->_setID = $setID;

		$sql = "SELECT * FROM question WHERE setID = $this->_setID";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function print_000($num){

		$sql = "SELECT * FROM question ORDER BY RAND() ASC LIMIT $num";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}


	public function print_001($num, $setID){

		$sql = "SELECT * FROM question WHERE setID = $setID ORDER BY RND() ASC LIMIT $num";

		$objDB = new db;
		$result= $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function print_010($num, $chapterID){
		$sql = "SELECT * FROM question WHERE chapterID = $chapterID ORDER BY RND() ASC LIMIT $num";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function print_011($num, $ChapterID, $setID){
		$sql = "SELECT * FROM question WHERE chapterID = $chapterID AND setID = $setID ORDER BY RND() ASC LIMIT $num";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function print_100($num, $subjectID){
		$sql = "SELECT * FROM question WHERE subjectID = $subjectID ORDER BY RAND() ASC LIMIT $num";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function print_101($num, $subjectID, $setID){
		$sql = "SELECT * FROM question WHERE subjectID = $sujectID AND setID = $setID ORDER BY RAND() ASC LIMIT $num";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	public function print_110($num, $subjectID, $chapterID){
		$sql = "SELECT * FROM question WHERE subjectID = $subjectID AND chapterID = $chapterID ORDER BY RAND() ASC LIMIT $num";

		$objDB =  new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result();
	}

	public function print_111($num, $subjectID, $chapterID, $setID){
		$sql = "SELECT * FROM question WHERE subjectID = $subjectID AND chapterID = $chapterID AND setID = $setID ORDER BY RAND() ASC LIMIT $num";

		$objDB = new db;
		$result = $objDB->fetch_result($sql);
		$objDB->close();
		return $result;
	}

	
}

 
?>
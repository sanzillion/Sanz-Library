<?php
 function connect(){
 	$db = new PDO("mysql:host=localhost;dbname=sad","root","", array(
 		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
 		PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE,
 		//PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 		PDO::MYSQL_ATTR_LOCAL_INFILE => TRUE,
 		PDO::MYSQL_ATTR_USE_BUFFERED_QUERY));
 	return $db;
 }

  function finduser($user, $password){
 	$db = connect();
	$query = $db->prepare("SELECT * From admin WHERE user = ? AND pass = ?");
	$query->bindParam(1,$user);
	$query->bindParam(2,$password);

		if($query->execute()){
			if($query->rowCount() > 0){
				return true;
			}
			else{
				return false;
			}
		}
	}

function find($name){
	$db = connect();
	$query = $db->prepare("SELECT * From sanction WHERE s_name = ?");
	$query->bindParam(1,$name);
	if($query->execute()){
		if($query->rowCount() > 0){
			return true;
		}
		else{
			return false;
		}
	}
}

function getstudentsbyid($id){
	$db = connect();
	$sth = $db->prepare("SELECT * From student WHERE s_id = ?");
	$sth->bindParam(1,$id);
	$sth->execute();
	$results = $sth->fetch(PDO::FETCH_OBJ);
	return $results;
}

function findstudents($name){
	$db = connect();
	$query = $db->prepare("SELECT * From student WHERE name ?");
	$query->bindParam(1,$name);

	if($query->execute()){
		if($query->rowCount() > 0){
			return true;
		}
		else{
			return false;
		}
	}
}


function getstudents(){
	$db = connect();
	$sth = $db->prepare("SELECT * From student");
	$sth->execute();
	$results = $sth->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getbyyr($yr){
	$db = connect();
	$query = $db->prepare("SELECT * FROM student WHERE year = ?");
	$query->bindParam(1,$yr);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getmeet(){
	$db = connect();
	$sth = $db->prepare("SELECT * From meeting");
	$sth->execute();
	$results = $sth->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getmeetbyid($id){
	$db = connect();
	$stmt = $db->prepare("SELECT * from meeting where m_id = :id");
	$stmt->bindValue('id',$id);
	$stmt->execute();
	return $account = $stmt->fetch(PDO::FETCH_OBJ);
}

function deletemeetbyid($id){
	$db = connect();
	$sth = $db->prepare("DELETE FROM meeting Where m_id = :id");
	$sth->bindValue('id',$id);
	$sth->execute();
}

function getdescription(){
	$db = connect();
	$sth = $db->prepare("SELECT DISTINCT description From meeting");
	$sth->execute();
	$results = $sth->fetchAll(PDO::FETCH_ASSOC);
	return $results;
}

function descrow(){
	$db = connect();
	$sth = $db->prepare("SELECT DISTINCT description From meeting");
	$sth->execute();
	$results = $sth->rowCount();
	return $results;
}

function disname(){
	$db = connect();
	$stmt2 = $db->prepare("SELECT distinct name from student");
	$stmt2->execute();
	$data = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function getsanction(){
	$db = connect();
	$sth = $db->prepare("SELECT * From sanction");
	$sth->execute();
	$results = $sth->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getsanctionbyname($name){
	$db = connect();
	$sth = $db->prepare("SELECT * From sanction WHERE s_name = ?");
	$sth->bindParam(1,$name);
	$sth->execute();
	$results = $sth->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function getsanctionbyid($id){
	$db = connect();
	$stmt = $db->prepare("SELECT * from sanction where sanc_id = :id");
	$stmt->bindValue('id',$id);
	$stmt->execute();
	$account = $stmt->fetch(PDO::FETCH_OBJ);
	return $account;
}

function sancbyyear($yr){
	$db = connect();
	$sth = $db->prepare("SELECT *
						FROM sanction
						INNER JOIN student
						ON sanction.s_name = student.name
						WHERE student.year = ?");

	$sth->bindParam(1,$yr);
	$sth->execute();
	$results = $sth->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

function gn(){
	$db = connect();
	$sth = $db->prepare("SELECT meeting From sanction");

	if($sth->execute()){
		if($sth->rowCount() > 0){
			return true;
		}
		else{
			return false;
		}
	}
}

function getrecord(){
	$db = connect();
	$stmt = $db->prepare("SELECT * from record ORDER BY r_id DESC LIMIT 50");
	$stmt->execute();
	$account = $stmt->fetchAll(PDO::FETCH_OBJ);
	return $account;
}

function getstudent2($name){ //getemp2
	$names = "";
	$names.= '%';
	$names.= $name;
	$names.= '%';
	$db = connect();
	$query = $db->prepare("SELECT * From student
		WHERE name LIKE ? ");
	$query->bindParam(1,$names);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	return $results;
}

 function findname($name){
 	$names = "";
 	$names.= '%';
 	$names.= $name;
 	$names.= '%';
 	$db = connect();
	$query = $db->prepare("SELECT * From student
		WHERE name LIKE ? ");
	$query->bindParam(1,$names);

		if($query->execute()){
			if($query->rowCount() > 0){
				return true;
			}
			else{
				return false;
			}
		}
	}

 function deleteall(){
 	$db = connect();
	$sth = $db->prepare("DELETE FROM student");
	$sth->execute();
	}

 function deleteallsanction(){
 	$db = connect();
	$sth = $db->prepare("DELETE FROM sanction");
	$sth->execute();
	}

 function deleteone($id){
 	$db = connect();
	$sth = $db->prepare("DELETE FROM sanction Where sanc_id = :id");
	$sth->bindValue('id',$id);
	$sth->execute();
 }

 function deleteallmeetings(){
 	$db = connect();
	$sth = $db->prepare("DELETE FROM meeting");
	$sth->execute();
	}

function deletefromsanc($name){
	$db = connect();
	$sth = $db->prepare("DELETE * From sanction WHERE s_name = ?");
	$sth->bindParam(1,$name);
	$sth->execute();
}

function getadmin($var){
	$db = connect();
	$stmt = $db->prepare("SELECT * from admin where user = ?");
	$stmt->bindParam(1,$var);
	$stmt->execute();
	return $account = $stmt->fetch(PDO::FETCH_OBJ);
}
function deleteonestudent($var){
	$db = connect();
	$sth = $db->prepare("DELETE FROM student Where s_id = :id");
	$sth->bindValue('id',$var);
	$sth->execute();
}


<?php
session_start();
include "../process/functions.php";
$db = connect();

if(isset($_POST['update'])){

	$id = $_POST['id'];
 	$name = $_POST['name'];
 	$cpnum = $_POST['cpnum'];
	$year = $_POST['yr'];

	$stmt = $db->prepare("UPDATE student SET
								name = :name,
		                 		year = :year,
		                 		cpnum = :cpnum
		                 		WHERE s_id = :id");

			$stmt->bindValue('name',$name);
			$stmt->bindValue('year',$year);
			$stmt->bindValue('id',$id);
			$stmt->bindValue('cpnum',$cpnum);

			$stmt->execute();
			header('Location:../pages/student.php#popup2');
}

if(isset($_POST['updato'])){

	$id = $_POST['id'];
 	$des = $_POST['des'];
	$dat = $_POST['dat'];

	$stmt = $db->prepare("SELECT * from meeting where m_id = :id");
		$stmt->bindValue('id',$id);
		$stmt->execute();
		$account = $stmt->fetch(PDO::FETCH_OBJ);

	$desc = $account->description;

	$sth = $db->prepare("ALTER TABLE `sanction` CHANGE `$desc` `$des` VARCHAR(11) NOT NULL");
	$sth->execute();

	$stmt = $db->prepare("UPDATE meeting SET
								description = :des,
								m_date = :dat
		                 		WHERE m_id = :id");

			$stmt->bindValue('des',$des);
			$stmt->bindValue('dat',$dat);
			$stmt->bindValue('id',$id);

			$stmt->execute();


	header('Location:../pages/meeting.php#popup2');
}

function getpay(){
 $db = connect();
 $sth = $db->prepare("SELECT p_id, firstname, surname, month, rate,
           mandays, deduction, total FROM payroll
           INNER JOIN employees
           ON payroll.emp_id = employees.emp_id
           ORDER BY p_id");
 $sth->execute();
 $results = $sth->fetchAll(PDO::FETCH_OBJ);
 return $results;
}

function getpaybymonth($month){
 $db = connect();
 $sth = $db->prepare("SELECT * FROM payroll INNER JOIN employees
           ON payroll.emp_id = employees.emp_id
           WHERE month = ? ORDER BY month");
 $sth->bindParam(1,$month);
 $sth->execute();
 $results = $sth->fetchAll(PDO::FETCH_OBJ);
 return $results;
}

function getpay2($name){
 $names = "";
 $names.= '%';
 $names.= $name;
 $names.= '%';
 $db = connect();
 $query = $db->prepare("SELECT * From payroll INNER JOIN employees
             ON payroll.emp_id = employees.emp_id
             WHERE firstname LIKE ? OR surname LIKE ?
             ORDER BY surname");
 $query->bindParam(1,$names);
 $query->bindParam(2,$names);
 $query->execute();
 $results = $query->fetchAll(PDO::FETCH_OBJ);
 return $results;
}

?>

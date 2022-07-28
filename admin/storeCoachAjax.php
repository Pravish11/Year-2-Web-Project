<?php 
    require_once "includes/db_connect.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $email=$_POST['email'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $dob=$_POST['dob'];
    $address=$_POST['address'];
    $tel_no=$_POST['tel_no'];
    $gender=$_POST['gender'];
    $sql="call insertUserDetails(:email,:firstname,:lastname,:dob,:address,:tel_no,:gender)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":firstname",$firstname);
    $stmt->bindParam(":lastname",$lastname);
    $stmt->bindParam(":dob",$dob);
    $stmt->bindParam(":address",$address);
    $stmt->bindParam(":tel_no",$tel_no);
    $stmt->bindParam(":gender",$gender);
    $stmt->execute();

    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $type='coach';
    $sql = 'CALL insertAccounts(:email,:password,:type)';
	$stmt=$conn->prepare($sql);
    $stmt->bindParam(':email',$email);
	$stmt->bindParam(':password',$password);
	$stmt->bindParam(':type',$type);
    $stmt->execute();

    $specialisation=$_POST['specialisation'];
    $sql="CALL insertCoach(:email,:specialisation)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":specialisation",$specialisation);
    $stmt->execute();

    $working_day=$_POST['working_day'];
    $working_time=$_POST['working_time'];
    $sql="CALL insertWorkingHours(:email,:working_day,:working_time)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":working_day",$working_day);
    $stmt->bindParam(":working_time",$working_time);
    $stmt->execute(); 



    

?>
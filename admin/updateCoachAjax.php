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
    $old_mail=$_POST['old_mail'];
    $sql="CALL updateUserDetails(:email,:lastname,:firstname,:dob,:address,:tel_no,:gender,:old_mail)";
    //$sql="insert into table '$email' '$lastname' '$firstname' '$dob' '$address' '$tel_no' '$gender' '$old_mail'";
    //echo $sql;
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":firstname",$firstname);
    $stmt->bindParam(":lastname",$lastname);
    $stmt->bindParam(":dob",$dob);
    $stmt->bindParam(":address",$address);
    $stmt->bindParam(":tel_no",$tel_no);
    $stmt->bindParam(":gender",$gender);
    $stmt->bindParam(":old_mail",$old_mail);
    $stmt->execute();

    $specialisation=$_POST['specialisation'];
    $sql="UPDATE coach SET specialisation='$specialisation' WHERE email='$email'";
    $conn->exec($sql);

    $password=$_POST['password'];
    if($password!="")
    {
        $hashed=password_hash($password,PASSWORD_DEFAULT);
        $sql="UPDATE accounts SET password='$hashed' WHERE email='$email'";
        $conn->exec($sql);
    }

    $working_day=$_POST['working_day'];
    $working_time=$_POST['working_time'];
    $sql="UPDATE working_hours SET working_day='$working_day',working_time='$working_time' WHERE coach_mail='$email'";
    $conn->exec($sql);
?>
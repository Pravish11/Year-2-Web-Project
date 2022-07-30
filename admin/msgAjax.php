<?php 
    require_once "includes/db_connect.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $email=$_POST['mail'];
    $date_posted=$_POST['date_posted'];
    $sql="DELETE FROM contact_us WHERE email='$email' AND date_posted='$date_posted'";
    $conn->exec($sql);
?>
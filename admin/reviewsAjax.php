<?php 
     require_once "includes/db_connect.php";
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $review_id=$_POST['review_id'];
     if($_POST['action']=='unflag')
     {
        $sql="UPDATE review SET flag='0' WHERE review_id='$review_id'";
        $conn->exec($sql);
     }
     if($_POST['action']=="ban")
     {
        $sql="DELETE FROM review WHERE review_id='$review_id'";
        $conn->exec($sql);
     }
?>
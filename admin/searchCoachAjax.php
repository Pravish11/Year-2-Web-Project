<?php  
    require_once "includes/db_connect.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $email=$_POST['email'];
    $sql="SELECT u.email,acc_type FROM user_details u,accounts a WHERE u.email=a.email AND u.email='$email' AND acc_type='coach'";
    $Result=$conn->query($sql);
    if($Result->rowCount()==0)
    {
        echo false;
    }
    else
    {
        echo true;
    }
?>
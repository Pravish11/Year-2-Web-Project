<?php  
    require_once "includes/db_connect.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $email=$_POST['email'];
    if($_POST['action']=="search")
    {
        $sql="SELECT * FROM user_details u,accounts a WHERE u.email=a.email AND acc_type='member' AND u.email='$email'";
        $result=$conn->query($sql);
        if($result->rowCount()==0)
        {
            echo false;
        }
        else
        {
            echo true;
        }
    }
    if($_POST['action']=="reset")
    {
        $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
        $sql="UPDATE accounts SET password='$password' WHERE email='$email'";
        $conn->exec($sql);
    }
    if($_POST['action']=="payment")
    {
        $a=getdate();
        $b=date_create($a['year']."-".$a['mon']."-".$a['mday']);
        $currentDate=date_format($b,'Y-m-d'); 
        $amount=$_POST['amount'];
        $noMonths=$_POST['months']." months";
        $old_membership_end=$_POST['membership_end'];
        $new_membership_end="";
        $c=date_create($old_membership_end);
        $date=date_format($c,"Y-m-d");
        if($date<$currentDate)
        {
            date_add($b,date_interval_create_from_date_string($noMonths));
            $new_membership_end=date_format($b,'Y-m-d');

        }
        else
        {
            date_add($c,date_interval_create_from_date_string($noMonths));
            $new_membership_end=date_format($c,'Y-m-d');
        }
        $sql="UPDATE membership SET membership_end='$new_membership_end' WHERE email='$email'";
        $conn->exec($sql);
        $conn==null;
        $sql="INSERT INTO payment (member_mail,amount,payment_date) VALUES('$email','$amount','$currentDate')";
        $conn->exec($sql);
    } 
    if($_POST['action']=="delete")
    {
        $sql="DELETE FROM user_details WHERE email='$email'";
        $conn->exec($sql);
    }
?>
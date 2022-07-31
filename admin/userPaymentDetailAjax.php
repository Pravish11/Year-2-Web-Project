<?php 
    require_once "includes/db_connect.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $a=getdate();
    $b=date_create($a['year']."-".$a['mon']."-".$a['mday']);
    $currentDate=date_format($b,'Y-m-d'); 
    $email=$_POST['email'];
    $sql="SELECT * FROM membership WHERE email='$email'";
    $result=$conn->query($sql);
    $row=$result->fetch();
    $mEnd=date_format(date_create($row['membership_end']),'Y-m-d');
    if($mEnd<$currentDate)
    {
        ?>
        <label>Membership Ended On: <span style="font-weight:bold; color:red;"><?php echo $row['membership_end']; ?></span></label><br>
        <?php
    }
    else
    {
        ?>
        <label>Membership Ends On: <span style="font-weight:bold; color:#32cd32;"><?php echo $row['membership_end']; ?></span></label><br>
        <?php
    }
    ?>
    
        <label>No of Months: </label>
        <input type="text" name="noMonths"><br>
        <label for="">Amount(Rs):</label>
        <input type="text" name="amount" id=""><br>
        <button type="button" class="passwordBtn" id="pay_cancel_btn">Cancel</button>
        <button type="button" class="passwordBtn" id="pay_confirm_btn">Confirm</button>
        <?php
?>
<?php 
	session_start();
	$email=$_SESSION['username'];
	require_once "includes/db_connect.php";
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sQuery="SELECT * FROM membership WHERE email='$email'";
	$Result=$conn->query($sQuery);
	$membership=$Result->fetch();
	$type=$membership['type'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
	<style>
		*{
			text-align: center;
			font-family: sans-serif;
		}
		.current_info,.payment{
			border:1px solid black;
			padding: 20px;
			border-radius: 10px;
			width: 500px;
			position: relative;
			left: 31%;
		}
		.current_info label,input{
			margin-bottom: 20px;
		}
		input:disabled{
			background-color: transparent;
			border:none;
			outline: none;
		}
		input{
			border: 1px solid grey;
			border-radius: 15px;
			padding: 5px;
			outline: none;
		}
		button{
			width: 150px;
			height:25px;
			font-size: 16px;
			background-color: lightgrey;
			outline: none;
			border:1px solid lightgrey;
			border-radius: 15px;
			cursor: pointer;
		}
		button:hover{
			border:1px solid #32cd32;
			background-color: #32cd32;
			color: white;
		}
	</style>
	<script>
		
	</script>
	<title>Extreme Fitness</title>
</head>
<body>
	<?php
	if ($_SERVER['REQUEST_METHOD']=="POST")
	{
		$a=getdate();
        $b=date_create($a['year']."-".$a['mon']."-".$a['mday']);
        $currentDate=date_format($b,'Y-m-d'); 
		$membership_end="";
		if($type=='monthly')
		{

			date_add($b,date_interval_create_from_date_string("1 months"));
			$membership_end=date_format($b,'Y-m-d');
		}
		else
		{
			date_add($b,date_interval_create_from_date_string("1 years"));
			$membership_end=date_format($b,'Y-m-d');
		}
		$sql="UPDATE membership SET membership_end='$membership_end' WHERE email='$email'";
		$conn->exec($sql);
		$query = "SELECT * FROM user_details WHERE email='$email'";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result=$conn->query($query);
    	$userResult=$result->fetch(PDO::FETCH_ASSOC);
        $_SESSION['firstname']=$userResult['firstname'];
		header("Location:home.php");
		die();

	}
	else
	{
	?>
	<h2 class='head'>Settle payment to continue.</h2>
	<div class="current_info">
			<label class="info_label">Current Subscription Type:</label>
			<input type="text" name="txt_type" value='<?php echo $type ?>' disabled><br>
			<label class='info_label'>Expired On:</label>
			<input type="text" name="txt_expire" value='<?php echo $membership["membership_end"]; ?>' disabled><br>
			<label class="info_label">Monthly Payment:</label>
			<input type="text" name="" value=
				<?php
					if ($type=='monthly')
					{
						echo "'Rs 1149.00'";
					}
					else
					{
						echo "'Rs 1049.00'";
					} 
				?>
			 disabled><br>		
			<a href="account.php">Change subscription type</a>
	</div>
	<br>
	<div class="payment">
		<?php
			if ($type=='monthly')
			{?>
				<h3>Payment can also be made in cash at counter.</h3>
				<form method='post' action='<?php echo $_SERVER["PHP_SELF"]?>'>
					<label class="payment_label">Account No:</label>
					<input type="text" name="" placeholder="1111-2222-3333-4444" required><br>
					<label class="payment_label">Amount:</label>
					<input type="text" name="" value='Rs 1149.00' disabled><br>
					<label class="payment_label">Pin:</label>
					<input type="password" name="" maxlength="4" required><br>
					<button>Confirm Payment</button>
				</form>
			<?php }
			else
			{?>
				<form method='post' action='<?php echo $_SERVER["PHP_SELF"]?>'>
					<h3>Rs 1049.00 will be debited monthly from this account</h3>
					<label class='payment_label'>Account No:</label>
					<input type="text" name="" placeholder="1111-2222-3333-4444" required><br>
					<label class="payment_label">Expiry Date:</label>
					<input type="text" name="" placeholder="mm/yy" required><br>
					<label class="payment_label">CVV:</label>
					<input type="text" name="" placeholder='123' required><br>
					<label class="payment_label">Amount:</label>
					<input type="text" name="" value='Rs 1049.00' disabled><br>
					<label class="payment_label">Pin: </label>
					<input type="text" name="" required><br>
					<button>Confirm Payment</button>
				</form>

			<?php } ?>	
	</div>
	<?php 
	}
	?>
</body>
</html>
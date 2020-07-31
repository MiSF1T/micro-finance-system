<?php
session_start();

require "../common variables/common_var.php";				//Get minimum balance

$date = date('Y-m-d');
$id = $_GET['id'];

$status = "Successful";
$type = "Term Deposit Amount";

$db = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
{	
	$sql = $db->query("SELECT * FROM TD WHERE Td_Id='". $id ."'");
    $row = $sql->fetch();
	$creation = $row['Creation_Date'];
	$tenure = $row['Tenure'];
	$amount = $row['Amount'];

	//get TD interest rate
	$querySql = $db->query("SELECT * FROM Interests WHERE Type= 'Term Deposit' AND Tenure= '". $tenure ."'");
    $row = $querySql->fetch();
	$rate = $row['Rate'];

	$td_amount = $amount*pow((1+($rate/100)), $tenure);

	$sql = $db->query("SELECT Balance FROM Account where Account_No= '".$_SESSION["account"]."'");
	$row = $sql->fetch();
	
	if($row['Balance'] < $min_balance)			//Check if min. balance is maintained
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("Minimum Balance not maintained.");'; 
		echo 'window.location.href = "td.php";';
		echo '</script>';
		
	}
	elseif($row['Balance'] < $td_amount)		//Check if balance is sufficient for renewing TD
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("Insufficient balance.");'; 
		echo 'window.location.href = "td.php";';
		echo '</script>';
	}
	else
	{
		//renew TD with current date and previous amount with interest.
		$queryStr = "UPDATE TD SET Amount = '" . $td_amount . "' , Creation_Date = '". $date ."' WHERE Td_Id = '". $id ."'";
		$query = $db->prepare($queryStr);
		$query->execute();

		//Deduct term deposit amount from balance
		$queryStr = $db->query("UPDATE Account SET Balance = ".$row['Balance']." - ".$td_amount." WHERE Account_No= '".$_SESSION["account"]."'");
		$queryStr->execute();

		//Create transaction
		$queryStr = "INSERT INTO Transactions(Account_No,Amount,Date,Status,Type) VALUES(?,?,?,?,?)";
		$query = $db->prepare($queryStr);
		$query->execute([$_SESSION["account"],$td_amount,$date,$status,$type]);
		
		//Notify user
		echo '<script type="text/javascript">'; 
		echo 'alert("Selected term deposit has been renewed.");'; 
		echo 'window.location.href = "td.php";';
		echo '</script>';
	}
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>
<?php
$date = date('Y-m-d');
$id = $_GET['id'];

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

	//renew TD with current date and previous amount with interest.
	$queryStr = "UPDATE TD SET Amount = '" . $td_amount . "' , Creation_Date = '". $date ."' WHERE Td_Id = '". $id ."'";
	$query = $db->prepare($queryStr);
	$query->execute();
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

header('location:td.php');
?>
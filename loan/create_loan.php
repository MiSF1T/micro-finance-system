<?php
$amount = $_GET["amount"];
$installments = $_GET["slct1"];
$income= $_GET["ann"];
$date = date('Y-m-d');

$db = new PDO('mysql:host=localhost;dbname=omfs', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
{
	$queryStr = "INSERT INTO loan(amount,installments,income,creation_date) VALUES(?,?,?,?)";
	$query = $db->prepare($queryStr);
	$query->execute([$amount,$installments,$income,$date]);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

header('location:loan.php');
?>
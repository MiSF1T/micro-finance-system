<?php
$amount = $_GET["amount"];
$tenure = $_GET["slct1"];
$date = date('Y-m-d');

$db = new PDO('mysql:host=localhost;dbname=omfs', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
{
	$queryStr = "INSERT INTO td(amount,tenure,creation_date) VALUES(?,?,?)";
	$query = $db->prepare($queryStr);
	$query->execute([$amount,$tenure,$date]);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

header('location:td.php');
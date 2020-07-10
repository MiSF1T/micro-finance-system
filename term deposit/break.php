<?php 
//echo "hello";

$id = $_GET['id'];

$db = new PDO('mysql:host=localhost;dbname=omfs', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
{
	$queryStr = "DELETE FROM `td` WHERE `td_id`='". $id ."'";
	$query = $db->prepare($queryStr);
	$query->execute();
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

header('location:td.php');

?>
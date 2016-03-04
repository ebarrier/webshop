<?php
require_once "config.php";
include "header.php";
 $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error)
  die("Connection to database failed:".$conn->connect_error);
$conn->query("set names utf8");
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8"/>
<meta name="description" content="Etienne page to learn HTML/PHP">
<title>description</title>
</head>


<body>

<a href="index.php">Go back to main page</a>

<?php 
$statement = $conn->prepare("SELECT Name, Description, Price FROM etienne WHERE id = ?");
$statement->bind_param("i", $_GET["id"]); //GET to extract it from the page's URL (?id=12)
$statement->execute();
$result = $statement->get_result();
$row = $result->fetch_assoc();
?>

<h1><?=$row["Name"];?></h1>
<h2><?=$row["Price"];?> eur</h2>

<p>
  <?=$row["Description"];?>
</p>

<form method="post" action="cart.php">
  <input type="hidden" name="id" value="<?=$_GET["id"];?>"/>
  <input type="hidden" name="count" value="1"/>
  <input type="submit" value="Add to cart"/>
<select name="count">
  <option value="one">1</option>
  <option value="two">2</option>
  <option value="three">3</option>
  <option value="four">4</option>
</select>
</form>


<?php
include 'footer.php';
?>

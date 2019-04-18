<?php
require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

/*
$u_id = (int) $_POST["id"];
$u_firstname = $_POST["firstname"];

$sqlquery = "INSERT INTO test ('id', 'firstname') VALUES('$u_id', '$u_firstname');";
$result = mysql_query($sqlquery) or die(mysql_error());
*/

$result = mysql_query("INSERT INTO test VALUES(112, 'jjk');") or die(mysql_error());

?>
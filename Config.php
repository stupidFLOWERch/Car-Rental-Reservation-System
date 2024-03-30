<?php
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="COMP1044_database";
$con= new  mysqli($host, $user, $password, $dbname, $port, $socket)
or die('Could not connet to the database server'.mysqli_connect_error());
?>
<?php

$servername = "localhost";
$dbname = "dora30319318_Mod_NRG";
$username = "dora30319318_Mod_NRG";
$password = "@BEGanUq4$@$";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn) {

die(" PROBLEM WITH CONNECTION : " . mysqli_connect_error());

}
  
?>
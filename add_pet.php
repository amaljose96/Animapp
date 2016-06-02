<?php

$doctorid=$_SESSION['DOCTOR_ID'];
$PET_NAME=$_POST['NAME'];
$PET_BREED=$_POST['BREED'];

$count_results=execute_MYSQL("SELECT * FROM PETS;");
$PET_ID=$count_results->num_rows;

execute_MYSQL("INSERT INTO PETS VALUES ($PET_ID,$PET_NAME,$PET_BREED,$doctorid);");

function execute_MYSQL($sql){
  //DATABASE DETAILS
  $servername="mysql9.000webhost.com";
  $username = "a2122877_amal";
  $password='Amaljose96';
  $database= "a2122877_db";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);
  // Check connection
  if ($conn->connect_error)
  {
     die("Connection failed: " . $conn->connect_error);
  }
  $result = $conn->query($sql);
  $conn->close();
  return $result;
}
 ?>

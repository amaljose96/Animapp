<?php
session_start();

$doctor_name=$_POST['DOCTOR_NAME'];
$doctor_designation=$_POST['DOCTOR_DESIGNATION'];
$doctor_email=$_POST['DOCTOR_EMAIL'];
$doctor_password=$_POST['DOCTOR_PASSWORD'];
$doctor_confpassword=$_POST['DOCTOR_CONFPASSWORD'];

$count_results=execute_MYSQL("SELECT * FROM DOCTORS;");
$_SESSION['DOCTOR_ID']=$count_results->num_rows;
$doctor_id=$count_results->num_rows;

if($doctor_password!=$doctor_confpassword){
  echo "1";
  exit(0);
}





execute_MYSQL("INSERT INTO DOCTORS VALUES ($PET_ID,$PET_NAME,$PET_BREED,$doctorid);");

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

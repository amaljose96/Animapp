<?php
session_start();
$_SESSION['DOCTOR_ID']=-1;
$doctor_email=$_POST['DOCTOR_EMAIL'];
$doctor_password=$_POST['DOCTOR_PASSWORD'];
//CHECK IF ACCOUNT EXISTS
$search_results=execute_MYSQL("SELECT * FROM DOCTORS WHERE DOCTOR_EMAIL='$doctor_email'");
if($search_results->num_rows==0){                 //DUPLICACY CHECK
  echo "1";
  exit(0);
}
//NOW CHECK FOR CORRECT PASSWORD
$row = $search_results->fetch_assoc();
if($row['DOCTOR_PASSWORD']!=$doctor_password){
  echo "2";
  exit(0);
}
$_SESSION['DOCTOR_ID']=$row['DOCTOR_ID'];
if($_SESSION['DOCTOR_ID']==1){
  $_SESSION['SUPERADMIN']=1;
}
echo "<script>window.location.href='view.html';</script>";

function execute_MYSQL($sql){
  //DATABASE DETAILS
  $servername="localhost";
  $username = "root";
  $password='Amaljose@96';
  $database= "Animapp";
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

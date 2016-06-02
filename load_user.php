<?php

$doctorid=$_SESSION['DOCTOR_ID'];
$results=execute_MYSQL("SELECT * FROM DOCTORS WHERE DOCTOR_ID=$doctorid");
if($results->num_rows==1){
  $row = $result->fetch_assoc();
  $doctor_name=$row['DOCTOR_NAME'];
  $doctor_designation=$row['DOCTOR_DESIGNATION'];
  echo"
  <div id="doctor_name">Dr. $doctor_name</div>
  <div id="doctor_desig">$doctor_designation</div>";
}
else{
  echo "<script>window.location.href='index.html';";
}

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

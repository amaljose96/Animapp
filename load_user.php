<?php
session_start();
$doctorid=$_SESSION['DOCTOR_ID'];
$results=execute_MYSQL("SELECT * FROM DOCTORS WHERE DOCTOR_ID=$doctorid");
echo "<script>console.log('SELECT * FROM DOCTORS WHERE DOCTOR_ID=$doctorid');</script>";
if($results->num_rows==1){
  $row = $results->fetch_assoc();
  $doctor_name=$row['DOCTOR_NAME'];
  $doctor_designation=$row['DOCTOR_DESIGNATION'];
  echo "<div id='doctor_name'>Dr. ".$doctor_name."</div><div id='doctor_desig'>".$doctor_designation."</div>";
}
else{
  echo "<script>alert('There are $results->num_rows accounts');</script>";
}

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
     exit("Connection failed: " . $conn->connect_error);
  }
  $result = $conn->query($sql);
  $conn->close();
  return $result;
}

 ?>

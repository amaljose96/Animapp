<?php
session_start();
$doctorid=$_SESSION['DOCTOR_ID'];
if($doctorid==-1){
  echo "<script>window.location.href='index.html';</script>";
  exit(0);
}
$results=execute_MYSQL("SELECT * FROM DOCTORS WHERE DOCTOR_ID=$doctorid");
echo "<script>console.log('SELECT * FROM DOCTORS WHERE DOCTOR_ID=$doctorid');</script>";
if($results->num_rows==1){
  $row = $results->fetch_assoc();
  $doctor_name=$row['DOCTOR_NAME'];
  $doctor_designation=$row['DOCTOR_DESIGNATION'];
  echo "<img id='doctor_image' src='user_images/$doctorid'><div id='doctor_name' contenteditable='true'>Dr. ".$doctor_name."</div><div id='doctor_desig' contenteditable='true'>".$doctor_designation."</div><div id='logout' onclick='activate_logOut()'>Log Out</div>";
}
else{
  $wer=$results->num_rows;
  echo "<script>alert('There are ".$wer." accounts');</script>";
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

<?php
session_start();
$PET_ID=$_POST['PET_ID'];
$EVENT_DATE=$_POST['EVENT_DATE'];
$EVENT_MEDICINE=$_POST['EVENT_MEDICINE'];
$EVENT_COST=$_POST['EVENT_COST'];
$EVENT_DESCRIPTION=$_POST['EVENT_DESCRIPTION'];

$count_results=execute_MYSQL("SELECT * FROM EVENTS;");
$EVENT_ID=$count_results->num_rows;
$okay=0;
while($okay!=1){
  $check_results=execute_MYSQL("SELECT * FROM EVENTS WHERE EVENT_ID=$EVENT_ID");
  if($check_results->num_rows==1){
    $okay=0;
    $EVENT_ID=$EVENT_ID+1;
  }
  else{
    $okay=1;
  }
}
execute_MYSQL("INSERT INTO EVENTS VALUES ($EVENT_ID,$PET_ID,'$EVENT_DATE','$EVENT_MEDICINE',$EVENT_COST,'$EVENT_DESCRIPTION');");

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

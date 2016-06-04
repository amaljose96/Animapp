<?php
session_start();
$doctorid=$_SESSION['DOCTOR_ID'];
$PET_NAME=$_POST['PET_NAME'];
$PET_BREED=$_POST['PET_BREED'];

$count_results=execute_MYSQL("SELECT * FROM PETS;");
$PET_ID=$count_results->num_rows;
echo "<script>alert('line=INSERT INTO PETS VALUES ($PET_ID,\"$PET_NAME\",\"$PET_BREED\",$doctorid'));</script>";
execute_MYSQL("INSERT INTO PETS VALUES ($PET_ID,'$PET_NAME','$PET_BREED',$doctorid);");
echo "<script>window.location.href='view.html'</script>"
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

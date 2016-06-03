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
echo"<script>alert('Calculated id as $doctor_id');</script>";

if($doctor_password!=$doctor_confpassword){       //PASSWORDS MATCH
  echo "1";
  exit(0);
}

$search_results=execute_MYSQL("SELECT * FROM DOCTORS WHERE DOCTOR_EMAIL=$doctor_email");
if($search_results->num_rows!=0){                 //DUPLICACY CHECK
  echo "2";
  exit(0);
}

//NO ISSUES. WRITE TO DB

if($_SESSION['DOCTOR_ID']==1){
  $_SESSION['SUPERADMIN']=1;
}
echo "<script>alert('INSERT INTO DOCTORS VALUES ($doctor_id,\'$doctor_name\',\'$doctor_email\',\'$doctor_password\',\'$doctor_designation\');')</script>";
$result=execute_MYSQL("INSERT INTO DOCTORS VALUES ($doctor_id,'$doctor_name','$doctor_email','$doctor_password','$doctor_designation');");
echo "<script>alert('$result');window.location.href='view.html';</script>";

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

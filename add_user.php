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

execute_MYSQL("INSERT INTO DOCTORS VALUES ($DOCTOR_ID,$DOCTOR_NAME,$DOCTOR_EMAIL,$DOCTOR_PASSWORD,$DOCTOR_DESIGNATION);");
echo "<script>window.location.href='view.html'</script>";
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

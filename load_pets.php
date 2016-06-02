<?php

$doctorid=$_SESSION['DOCTOR_ID'];
$superadmin=$SESSION['SUPERADMIN'];

//EXCECUTE SELECT * FROM PETS


$results=execute_MYSQL("SELECT * FROM PETS;");

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $pet_id=$row['PET_ID'];
    $pet_name=$row['PET_NAME'];
    $pet_breed=$row['PET_BREED'];
    $pet_doctor=$row['PET_DOCTOR'];
    echo "  <div class='pet_row' id='pet$pet_id'>
      <div class='pet_name' id='pet$pet_id_name'>$pet_name</div>
      <div class='pet_breed' id='pet$pet_id_breed'>$pet_breed</div>
      <div class='pet_id' id='pet$pet_id_id'>$pet_id</div>";
      $event_results=execute_MYSQL("SELECT * FROM EVENTS WHERE PET_ID=$pet_id;");
      $authorisation =0;
      if($superadmin==1||$pet_doctor==$doctorid){
        $authorisation=1;
      }
      $totalcost=0;
      if($event_results->num_rows>0){
          while($event_row=$event_results->fetch_assoc()){
              $event_id=$event_row['EVENT_ID'];
              $event_date=$event_row['EVENT_DATE'];
              $event_medicine=$event_row['EVENT_MEDICINE'];
              $event_cost=$event_row['EVENT_COST'];
              $totalcost+=$event_cost;
              $event_description=$event_row[''];
              echo"<div class='pet_event_row' id='pet_event$event_id_row'>
                <div class='pet_event_date' id='pet_event$event_id_date'>$event_date</div>
                <div class='pet_event_medication' id='pet_event$event_id_medication'>$event_medicine</div>
                <div class='pet_event_cost' id='pet_event$event_id_cost'>$event_cost</div>
                <div class='pet_event_description' id='pet_event$event_id_description'>$event_description</div>";
              if($authorisation==1){
                echo"  <img src='http://image005.flaticon.com/1/svg/61/61456.svg' style='width:40px' onclick='activate_edit($event_id)'>
                  <img src='http://image005.flaticon.com/43/svg/54/54528.svg' style='width:40px' onclick='activate_delete($event_id)'>";
              }
              echo"</div>";
          }
      }
      else{
        echo "No events";
      }
      echo "
      <div class='pet$pet_id_total_cost'>$totalcost</div>
    </div>";
  }
}
else{
  echo "No pets admitted";
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

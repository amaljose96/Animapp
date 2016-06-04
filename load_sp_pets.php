<?php
session_start();
$doctorid=$_SESSION['DOCTOR_ID'];
$superadmin=$_SESSION['SUPERADMIN'];

//EXCECUTE SELECT * FROM PETS
//echo "loading special pets";

$results=execute_MYSQL("SELECT * FROM PETS WHERE PET_DOCTOR=$doctorid;");

if ($results->num_rows !=0) {
  while($row = $results->fetch_assoc()) {
    $pet_id=$row['PET_ID'];
    $pet_name=$row['PET_NAME'];
    $pet_breed=$row['PET_BREED'];
    $pet_doctor=$row['PET_DOCTOR'];
    $authorisation=0;
    if($superadmin==1||$pet_doctor==$doctorid){
      $authorisation=1;
    }
    //echo "authorisation=".$authorisation."superadmin=".$superadmin."current doctor=".$doctorid." pet's doctor=".$pet_doctor;

    if($authorisation==0){
  //    echo "not authorised for $pet_name";
      continue;
    }
    echo "  <div class='pet_row' id='pet$pet_id'>
    <img class='pet_image' id='pet$pet_id_image' src='/pet_images/$pet_id.jpeg'>
      <div class='pet_name' id='pet$pet_id_name' contenteditable='true'>$pet_name</div>
      <div class='pet_breed' id='pet$pet_id_breed' contenteditable='true'>$pet_breed</div>
      <div class='pet_id' id='pet$pet_id_id'>$pet_id</div>";
      $event_results=execute_MYSQL("SELECT * FROM EVENTS WHERE PET_ID=$pet_id;");

      $totalcost=0;
      if($event_results->num_rows>0){
          while($event_row=$event_results->fetch_assoc()){
              $event_id=$event_row['EVENT_ID'];
              $event_date=$event_row['EVENT_DATE'];
              $event_medicine=$event_row['EVENT_MEDICINE'];
              $event_cost=$event_row['EVENT_COST'];
              $totalcost+=$event_cost;
              $event_description=$event_row['EVENT_DESCRIPTION'];
              echo"<div class='pet_event_row' id='pet_event".$event_id."_row'>
                <div class='pet_event_date' id='pet_event".$event_id."_date'>$event_date</div>
                <div class='pet_event_medication' id='pet_event".$event_id."_medication' contenteditable='true'>$event_medicine</div>
                <div class='pet_event_cost' id='pet_event".$event_id."_cost'>$event_cost</div>
                <div class='pet_event_description' id='pet_event".$event_id."_description' contenteditable='true'>$event_description</div>";
              if($authorisation==1){
                echo"  <img class='pet_event_edit' src='http://image005.flaticon.com/1/svg/61/61456.svg' style='width:40px' onclick='activate_edit($event_id)'>
                  <img class='pet_event_delete' src='http://image005.flaticon.com/43/svg/54/54528.svg' style='width:40px' onclick='activate_delete($event_id)'>";
              }
              echo"</div>";
          }
      }
      else{
        echo "No events";
      }
      echo "
      <div class='add_pet_event_button' onclick='show_add_event_popup($pet_id)'><img class='add_pet_event' src='add.svg'>Add event</div>
      <div class='pet_total_cost'>$totalcost</div>
    </div>";
  }
}
else{
  echo "<br><br>You have no pets";
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
     die("Connection failed: " . $conn->connect_error);
  }
  $result = $conn->query($sql);
  $conn->close();
  return $result;
}



?>

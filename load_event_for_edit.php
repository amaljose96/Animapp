<?php
$event_id=$_POST['EVENT_ID'];
$event_results=execute_MYSQL("SELECT * FROM EVENTS WHERE EVENT_ID=$event_id;");
if($event_results->num_rows==1){
    $event_row=$event_results->fetch_assoc();
        $event_id=$event_row['EVENT_ID'];
        $event_date=$event_row['EVENT_DATE'];
        $event_medicine=$event_row['EVENT_MEDICINE'];
        $event_cost=$event_row['EVENT_COST'];
        $pet_id=$event_row['PET_ID'];
        $event_description=$event_row['EVENT_DESCRIPTION'];
  echo"      <div id='Heading' style='font-weight:400'>Edit event</div>
        <div id='id_label' style='font-weight:100'>Id:</div>
        <div id='id' contenteditable='false' style='font-weight:100'>$event_id</div>
        <div id='pet_id_label' style='font-weight:100'>Pet Id:</div>
        <div id='pet_id' contenteditable='false' style='font-weight:100'>$pet_id</div>
        <div id='date_label' style='font-weight:100'>Date:</div>
        <div id='date' contenteditable='true' style='font-weight:100'>$event_date</div>
        <div id='medicine_label' style='font-weight:100'>Medicine:</div>
        <div id='medicine' contenteditable='true' style='font-weight:100'>$event_medicine</div>
        <div id='cost_label' style='font-weight:100'>Cost:</div>
        <div id='cost' contenteditable='true' style='font-weight:100'>$event_cost</div>
        <div id='description_label' style='font-weight:100'>Description:</div>
        <div id='description' contenteditable='true' style='font-weight:100'>$event_description</div>
        <div id='add_trigger' onclick='save_trigger()' style='font-weight:400'>Save event</div>";
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

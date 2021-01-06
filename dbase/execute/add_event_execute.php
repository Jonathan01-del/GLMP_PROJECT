<?php
include '../parts/connect.php';

if(isset($_POST['submit'])){
    // $delegate_id = $_POST['delegate_id'];

    $event_name = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['event_name'])));
    $start = htmlspecialchars(strtoupper(mysqli_real_escape_string($con, $_POST['start'])));
    $end = htmlspecialchars(strtoupper(mysqli_real_escape_string($con, $_POST['end'])));
    // $show_selected = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['selected_show'])));


 
    $add_event ="INSERT INTO tbl_event (event_name, date_start, date_end, date_created) VALUE('$event_name','$start','$end',NOW())";

    $add_result = $con->query($add_event);

    echo '<script>window.alert("Successfully added an Event!");window.location="../index.php";</script>';

    // echo '<script>window.alert("Successfully Updated!");window.location="view-delegate.php?id='.$delegate_id.'";</script>';    
    

}

$con -> close();
?>
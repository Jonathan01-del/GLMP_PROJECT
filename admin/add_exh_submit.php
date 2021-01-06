<?php
include 'parts/connect.php';

if(isset($_POST['submit'])){
    // $delegate_id = $_POST['delegate_id'];

    $exhibitor_name = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['exhibitor_name'])));
    $show_selected = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['selected_show'])));


 
    $add_exhibitor ="INSERT INTO tbl_exhibitor(Exhibitor_name,SHOW_JOINED,date_created) VALUE('$exhibitor_name','$show_selected',NOW())";

    $add_result = $con->query($add_exhibitor);

    echo '<script>window.alert("Successfully Updated!");window.location="index.php";</script>';

    // echo '<script>window.alert("Successfully Updated!");window.location="view-delegate.php?id='.$delegate_id.'";</script>';    
    

}

$con -> close();
?>
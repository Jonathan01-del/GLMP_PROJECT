<?php
include 'parts/connect.php';

if(isset($_POST['submit'])){

    $tracks = $_POST['track_select'];
    $delegate_id = $_POST['delegate_id'];

    $add_track = "INSERT INTO selected_track(DELEGATE_ID, TRACK_CODE,TCK_NEW, DATE_CREATED)
    VALUES('$delegate_id','$tracks','1',NOW())";

    $update_result = $con->query($add_track);

    echo '<script>window.alert("Successfully Updated!");window.location="view-delegate.php?id='.$delegate_id.'";</script>';

}

$con -> close();
?>
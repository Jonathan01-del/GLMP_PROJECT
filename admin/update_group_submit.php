<?php
include 'parts/connect.php';

if(isset($_POST['submit'])){
    $status = $_POST['status'];
    $date_paid = date('Y-m-d', strtotime($_POST['date_paid']));
    $remarks = htmlspecialchars(mysqli_real_escape_string($con, $_POST['remarks']));
    $delegate_id = $_POST['delegate_id'];
    $or_no = $_POST['or_no'];
    $company = $_POST['company'];
      

    $update_qry = "UPDATE group_request SET 
    STATUS = '$status', 
    OR_NO = '$or_no', 
    OR_NAME = '$company',
    REMARKS = '$remarks', 
    DATE_UPDATED = '$date_paid'
    WHERE ID = $delegate_id";

    $update_result = $con->query($update_qry);

    echo '<script>window.alert("Successfully Updated!");window.location="view-group.php?id='.$delegate_id.'";</script>';

}

$con -> close();
?>
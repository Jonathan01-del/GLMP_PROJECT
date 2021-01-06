<?php
include 'parts/connect.php';

if(isset($_POST['submit'])){
    $status = $_POST['status'];
    $date_paid = date('Y-m-d', strtotime($_POST['date_paid']));
    $or_no = $_POST['or_no'];
    $remarks = htmlspecialchars(mysqli_real_escape_string($con, $_POST['remarks']));
    $delegate_id = $_POST['delegate_id'];

    $vat = $_POST['vat'];
    $amt = $_POST['amount'];
    $tracks = $_POST['tracks'];


    $update_qry = "UPDATE delegate SET 
    STATUS = '$status', 
    OR_NO = '$or_no', 
    REMARKS = '$remarks', 
    DATE_UPDATED = '$date_paid',
    VAT ='$vat',
    TRACK_COUNT = '$tracks',
    TOTAL_AMOUNT = '$amt'
    WHERE ID = $delegate_id";

    $update_result = $con->query($update_qry);

    echo '<script>window.alert("Successfully Updated!");window.location="view-delegate.php?id='.$delegate_id.'";</script>';

}

$con -> close();
?>
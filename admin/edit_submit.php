<?php
include 'parts/connect.php';

if(isset($_POST['submit'])){
    $delegate_id = $_POST['delegate_id'];
    $fname = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['fname'])));
    $mname = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['mname'])));
    $lname = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['lname'])));
    $newname = $fname." ".$mname." ".$lname;
    $companyname = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['company'])));
    $jobtitle = htmlspecialchars(mysqli_real_escape_string($con,$_POST['jobtitle']));
    $address1 = htmlspecialchars(mysqli_real_escape_string($con,$_POST['address1']));
    $address2 = htmlspecialchars(mysqli_real_escape_string($con,$_POST['address2']));
    $city = htmlspecialchars(mysqli_real_escape_string($con,$_POST['city']));
    $state = htmlspecialchars(mysqli_real_escape_string($con,$_POST['state']));
    $zip = htmlspecialchars(mysqli_real_escape_string($con,$_POST['zip']));
    $country = htmlspecialchars(mysqli_real_escape_string($con,$_POST['country']));
    $telephone = htmlspecialchars(mysqli_real_escape_string($con,$_POST['telephone']));
    $mobile = htmlspecialchars(mysqli_real_escape_string($con,$_POST['mobile']));
    $email = $_POST['email'];
    $oldname = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['old_name'])));
    $remarks = 'Change Name: '.$oldname.' - '.$newname;

 
    $update_qry = "UPDATE delegate SET FNAME = '$fname', MNAME = '$mname', LNAME = '$lname', COMPANY = '$companyname', JOB_TITLE = '$jobtitle', ADDRESS1 = '$address1', ADDRESS2 = '$address2', CITY = '$city', STATE = '$state', ZIP = '$zip', TELEPHONE = '$telephone', EMAIL = '$email', MOBILE = '$mobile', CHANGE_NAME = '$remarks' WHERE ID = $delegate_id";

    $update_result = $con->query($update_qry);

    echo '<script>window.alert("Successfully Updated!");window.location="view-delegate.php?id='.$delegate_id.'";</script>';
    

}

$con -> close();
?>
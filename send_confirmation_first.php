<?php
include "includes/connect.php";
include 'includes/functions_first.php';

if(isset($_POST['submit'])){

    $fullname = htmlspecialchars(strtoupper(mysqli_real_escape_string($con, $_POST['fullname'])));
    $email = $_POST['email'];
    $company = htmlspecialchars(strtoupper(mysqli_real_escape_string($con, $_POST['company'])));
    $delegate_id = $_POST['delegate_id'];




    include_once 'includes/swift/swift_required.php';
    $info = array(
        'username' => $fullname,
        'email' => $email,
        'company' => $company,      
        'delegate_id' => $delegate_id);

    //send the email
    send_email($info);

    $update_qry = "UPDATE delegate SET DATE_SENT = now() WHERE ID = $delegate_id";

    $update_result = $con->query($update_qry);

    echo '<script>window.alert("Thank you! An email message has been sent out to the Delegate\'s email address.");window.location="admin/index.php";</script>';
}

 $con -> close();
?>

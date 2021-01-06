<?php
include '../parts/connect.php';

if(isset($_POST['submit'])){
    // $delegate_id = $_POST['delegate_id'];

    $assoc_name = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['association_name'])));
    // $show_selected = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['selected_show'])));


 
    $add_association ="INSERT INTO tbl_association (association,date_created) VALUE('$assoc_name',NOW())";

    $add_result = $con->query($add_association);

    echo '<script>window.alert("Successfully added an association!");window.location="../index.php";</script>';

    // echo '<script>window.alert("Successfully Updated!");window.location="view-delegate.php?id='.$delegate_id.'";</script>';    
    

}

$con -> close();
?>
<?php
include '../parts/connect.php';

if(isset($_POST['submit'])){
    // $delegate_id = $_POST['delegate_id'];

    $directory_name = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['directory_name'])));
    $category_name = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['category'])));
    // $show_selected = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['selected_show'])));


 
    $add_directory ="INSERT INTO tbl_directory (directory, cat_id ,date_created) VALUE('$directory_name','$category_name',NOW())";

    $add_result = $con->query($add_directory);

    echo '<script>window.alert("Successfully added an industry!");window.location="../add-directory.php";</script>';

    // echo '<script>window.alert("Successfully Updated!");window.location="view-delegate.php?id='.$delegate_id.'";</script>';    
    

}

$con -> close();
?>
<?php
include '../parts/connect.php';

if(isset($_POST['submit'])){
    // $delegate_id = $_POST['delegate_id'];

    $ind_name = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['industry_name'])));
    // $show_selected = htmlspecialchars(strtoupper(mysqli_real_escape_string($con,$_POST['selected_show'])));


 
    $add_industry ="INSERT INTO tbl_industry (industry,date_created) VALUE('$ind_name',NOW())";

    $add_result = $con->query($add_industry);

    echo '<script>window.alert("Successfully added an industry!");window.location="../index.php";</script>';

    // echo '<script>window.alert("Successfully Updated!");window.location="view-delegate.php?id='.$delegate_id.'";</script>';    
    

}

$con -> close();
?>
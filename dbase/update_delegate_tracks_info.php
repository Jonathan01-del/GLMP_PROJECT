<?php
include 'parts/connect.php';


    $delegate_id = $_GET['id'];


    $qry = "SELECT d.ID, 
    COUNT(t.TRACK_CODE) AS TRACKS_COUNT,
    (COUNT(t.TRACK_CODE) * d.PACKAGE_AMOUNT) * .12 AS VAT,
    (COUNT(t.TRACK_CODE) * d.PACKAGE_AMOUNT) + ((COUNT(t.TRACK_CODE) * d.PACKAGE_AMOUNT) * .12)  AS TOTAL_AMOUNT
    FROM delegate AS d 
    INNER JOIN selected_track AS t ON d.ID = t.DELEGATE_ID 
    LEFT JOIN list_track as l ON t.TRACK_CODE = l.CODE
    WHERE d.ID=$delegate_id AND l.STATUS !='Free'";

    $qry_res = $con->query($qry);
    $qry_row = $qry_res->fetch_assoc();
    $track = $qry_row['TRACKS_COUNT'];
    $vat = $qry_row['VAT'];
    $amt =$qry_row['TOTAL_AMOUNT'];

   



	$add_track = "UPDATE delegate SET TRACK_COUNT='$track',VAT='$vat',TOTAL_AMOUNT='$amt' WHERE ID= $delegate_id";

    $update_result = $con->query($add_track);

    echo '<script>window.alert("Successfully Updated!");window.location="view-delegate.php?id='.$delegate_id.'";</script>';



$con -> close();
?>
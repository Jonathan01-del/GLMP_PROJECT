<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "vx_report";
$conn = new mysqli($serverName, $userName, $password, $dbName); //createConnection
//checkConnection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id =$_GET['id'];


require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';

$result = mysqli_query($conn,"SELECT d.token_id,d.email,s.fullname,s.firstname,s.lastname, sum(d.no_of_visit) as days FROM tbl_exhibitor as x INNER JOIN tbl_day as d ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 1' GROUP BY d.token_id ORDER by days DESC");

$result1 = mysqli_query($conn,"SELECT d.token_id,d.email,s.fullname,s.firstname,s.lastname, sum(d.no_of_visit) as days FROM tbl_exhibitor as x INNER JOIN tbl_day as d ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 2' GROUP BY d.token_id ORDER by days DESC");

$result2 = mysqli_query($conn,"SELECT d.token_id,d.email,s.fullname,s.firstname,s.lastname, sum(d.no_of_visit) as days FROM tbl_exhibitor as x INNER JOIN tbl_day as d ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 3' GROUP BY d.token_id ORDER by days DESC");

$result3 = mysqli_query($conn,"SELECT d.token_id,d.email,s.fullname,s.firstname,s.lastname, sum(d.no_of_visit) as days FROM tbl_exhibitor as x INNER JOIN tbl_day as d ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 4' GROUP BY d.token_id ORDER by days DESC");

$result4 = mysqli_query($conn,"SELECT d.token_id,d.email,s.fullname,s.firstname,s.lastname, sum(d.no_of_visit) as days FROM tbl_exhibitor as x INNER JOIN tbl_day as d ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 5' GROUP BY d.token_id ORDER by days DESC");

$result5 = mysqli_query($conn,"SELECT d.token_id,d.email,s.fullname,s.firstname,s.lastname, sum(d.no_of_visit) as days FROM tbl_exhibitor as x INNER JOIN tbl_day as d ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 6' GROUP BY d.token_id ORDER by days DESC");

$result6 = mysqli_query($conn,"SELECT d.token_id,d.email,s.fullname,s.firstname,s.lastname, sum(d.no_of_visit) as days FROM tbl_exhibitor as x INNER JOIN tbl_day as d ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 7' GROUP BY d.token_id ORDER by days DESC");




// ----------End of new Data --------------
/* Create new PHPExcel object*/
$objPHPExcel = new PHPExcel();

// ------------------------------------------------------------------------------------------------------
// ------------- Start Code for Total No. of Visits Per Visitor

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NUMBER OF VISITOR VISIT ON DAY 1');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'EMAIL');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'FULLNAME');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'FIRST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'LAST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'QUANTITY');

$objPHPExcel->getActiveSheet()->setCellValue('I2', 'TOTAL NO. OF VISITORS ON DAY 1');

$i=2;

while($query_count= mysqli_fetch_array($result)) {
	$token = $query_count['token_id'];
	$fullname =$query_count['fullname'];
	$fname = $query_count['firstname'];
	$lname =$query_count['lastname'];
	$email_cnt=$query_count['email']; 
	$cnt=$query_count['days'];

	$objPHPExcel->getActiveSheet()->setCellValue("A$i",utf8_encode($token));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i",utf8_encode($email_cnt));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i",utf8_encode($fullname));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i",utf8_encode($fname));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i",utf8_encode($lname));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$cnt);

		// Design of Cells 

	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
	
$i++;
}

/* Unique Visitor Database*/
$objPHPExcel->getActiveSheet()->setTitle('DAY 1');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();


$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NUMBER OF VISITOR VISIT ON DAY 2');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'EMAIL');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'FULLNAME');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'FIRST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'LAST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'QUANTITY');

$objPHPExcel->getActiveSheet()->setCellValue('I2', 'TOTAL NO. OF VISITORS ON DAY 2');
$i=2;
while($query_cnt1= mysqli_fetch_array($result1)) {
	$token1 = $query_cnt1['token_id'];
	$fullname1 =$query_cnt1['fullname'];
	$fname1 = $query_cnt1['firstname'];
	$lname1 = $query_cnt1['lastname'];
	$email1=$query_cnt1['email']; 
	$cnt1=$query_cnt1['days'];


	$objPHPExcel->getActiveSheet()->setCellValue("A$i",utf8_encode($token1));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i",utf8_encode($email1));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i",utf8_encode($fullname1));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i",utf8_encode($fname1));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i",utf8_encode($lname1));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$cnt1);

			// Design of Cells 

	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
	
$i++;
}

/* Unique Visitor Database*/
$objPHPExcel->getActiveSheet()->setTitle('DAY 2');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();


$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NUMBER OF VISITOR VISIT ON DAY 3');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'EMAIL');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'FULLNAME');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'FIRST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'LAST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'QUANTITY');

$objPHPExcel->getActiveSheet()->setCellValue('I2', 'TOTAL NO. OF VISITORS ON DAY 3');
$i=2;
while($query_cnt2= mysqli_fetch_array($result2)) {
	$token2 = $query_cnt2['token_id'];
	$fullname2=$query_cnt2['fullname'];
	$fname2 = $query_cnt2['firstname'];
	$lname2 = $query_cnt2['lastname'];
	$email2=$query_cnt2['email']; 
	$cnt2=$query_cnt2['days'];


	$objPHPExcel->getActiveSheet()->setCellValue("A$i",utf8_encode($token2));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i",utf8_encode($email2));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i",utf8_encode($fullname2));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i",utf8_encode($fname2));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i",utf8_encode($lname2));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$cnt2);

			// Design of Cells 

	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
	
$i++;
}

/* Unique Visitor Database*/
$objPHPExcel->getActiveSheet()->setTitle('DAY 3');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();


$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NUMBER OF VISITOR VISIT ON DAY 4');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'EMAIL');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'FULLNAME');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'FIRST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'LAST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'QUANTITY');
$objPHPExcel->getActiveSheet()->setCellValue('I2', 'TOTAL NO. OF VISITORS ON DAY 4');
$i=2;
while($query_cnt3= mysqli_fetch_array($result3)) {
	$token3 = $query_cnt3['token_id'];
	$fullname3=$query_cnt3['fullname'];
	$fname3 = $query_cnt3['firstname'];
	$lname3 = $query_cnt3['lastname'];
	$email3= $query_cnt3['email']; 
	$cnt3=$query_cnt3['days'];


	$objPHPExcel->getActiveSheet()->setCellValue("A$i",utf8_encode($token3));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i",utf8_encode($email3));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i",utf8_encode($fullname3));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i",utf8_encode($fname3));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i",utf8_encode($lname3));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$cnt3);

			// Design of Cells 

	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
	
$i++;
}

/* Unique Visitor Database*/
$objPHPExcel->getActiveSheet()->setTitle('DAY 4');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();


$objPHPExcel->setActiveSheetIndex(4);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NUMBER OF VISITOR VISIT ON DAY 5');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'EMAIL');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'FULLNAME');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'FIRST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'LAST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'QUANTITY');
$objPHPExcel->getActiveSheet()->setCellValue('I2', 'TOTAL NO. OF VISITORS ON DAY 5');
$i=2;
while($query_cnt4= mysqli_fetch_array($result4)) {
	$token4 = $query_cnt4['token_id'];
	$fullname4=$query_cnt4['fullname'];
	$fname4 = $query_cnt4['firstname'];
	$lname4 = $query_cnt4['lastname'];
	$email4= $query_cnt4['email']; 
	$cnt4=$query_cnt4['days'];


	$objPHPExcel->getActiveSheet()->setCellValue("A$i",utf8_encode($token4));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i",utf8_encode($email4));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i",utf8_encode($fullname4));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i",utf8_encode($fname4));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i",utf8_encode($lname4));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$cnt4);

			// Design of Cells 

	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
	
$i++;
}

/* Unique Visitor Database*/
$objPHPExcel->getActiveSheet()->setTitle('DAY 5');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();


$objPHPExcel->setActiveSheetIndex(5);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NUMBER OF VISITOR VISIT ON DAY 6');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'EMAIL');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'FULLNAME');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'FIRST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'LAST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'QUANTITY');
$objPHPExcel->getActiveSheet()->setCellValue('I2', 'TOTAL NO. OF VISITORS ON DAY 6');
$i=2;
while($query_cnt5= mysqli_fetch_array($result5)) {
	$token5 = $query_cnt5['token_id'];
	$fullname5=$query_cnt5['fullname'];
	$fname5 = $query_cnt5['firstname'];
	$lname5 = $query_cnt5['lastname'];
	$email5= $query_cnt5['email']; 
	$cnt5=$query_cnt5['days'];


	$objPHPExcel->getActiveSheet()->setCellValue("A$i",utf8_encode($token5));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i",utf8_encode($email5));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i",utf8_encode($fullname5));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i",utf8_encode($fname5));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i",utf8_encode($lname5));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$cnt5);

			// Design of Cells 

	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
	
$i++;
}

/* Unique Visitor Database*/
$objPHPExcel->getActiveSheet()->setTitle('DAY 6');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();


$objPHPExcel->setActiveSheetIndex(6);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'NUMBER OF VISITOR VISIT ON DAY 7');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'EMAIL');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'FULLNAME');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'FIRST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'LAST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'QUANTITY');
$objPHPExcel->getActiveSheet()->setCellValue('I2', 'TOTAL NO. OF VISITORS ON DAY 7');
$i=2;
while($query_cnt6= mysqli_fetch_array($result6)) {
	$token6 = $query_cnt6['token_id'];
	$fullname6=$query_cnt6['fullname']; 
	$fname6 = $query_cnt6['firstname'];
	$lname6 = $query_cnt6['lastname'];
	$email6= $query_cnt6['email']; 
	$cnt6=$query_cnt6['days'];


	$objPHPExcel->getActiveSheet()->setCellValue("A$i",utf8_encode($token6));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i",utf8_encode($email6));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i",utf8_encode($fullname6));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i",utf8_encode($fname6));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i",utf8_encode($lname6));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$cnt6);

			// Design of Cells 

	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);


$i++;
}

/* Unique Visitor Database*/
$objPHPExcel->getActiveSheet()->setTitle('DAY 7');

/* Redirect output to a client’s web browser (Excel5)*/
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Export_Daily_Visitor_Visit_PHILCONVX.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>
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

$result=mysqli_query($conn,"SELECT d.token_id as token_day1, s.fullname, s.lastname, s.firstname, s.email, s.phone, s.company, s.position, s.country, s.city FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 1' AND x.exhibitor_id =$id ORDER BY s.Company ASC");

$result1=mysqli_query($conn,"SELECT  d.token_id as token_day2,s.fullname, s.lastname, s.firstname, s.email, s.phone, s.company, s.position, s.country, s.city FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 2' AND x.exhibitor_id =$id ORDER BY s.Company ASC");

$result2 = mysqli_query($conn,"SELECT d.token_id as token_day3, s.fullname, s.lastname, s.firstname, s.email, s.phone, s.company, s.position, s.country, s.city FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 3' AND x.exhibitor_id =$id ORDER BY s.Company ASC");

$result3 = mysqli_query($conn,"SELECT d.token_id as token_day4,s.fullname, s.lastname, s.firstname, s.email, s.phone, s.company, s.position, s.country, s.city FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 4' AND x.exhibitor_id =$id ORDER BY s.Company ASC");

// ------------------New Code --------------
$result4 = mysqli_query($conn,"SELECT d.token_id as token_day5,s.fullname, s.lastname, s.firstname, s.email, s.phone, s.company, s.position, s.country, s.city FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 5' AND x.exhibitor_id =$id ORDER BY s.Company ASC");

$result5 = mysqli_query($conn,"SELECT d.token_id as token_day6, s.fullname, s.lastname, s.firstname, s.email, s.phone, s.company, s.position, s.country, s.city
	FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id
	WHERE d.day='Day 6' AND x.exhibitor_id =$id ORDER BY s.Company ASC");

$result6 = mysqli_query($conn,"SELECT d.token_id as token_day7, s.fullname, s.lastname, s.firstname, s.email, s.phone, s.company, s.position, s.country, s.city
	FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id
	WHERE d.day='Day 7' AND x.exhibitor_id =$id ORDER BY s.Company ASC");

$query= mysqli_query($conn,"SELECT DISTINCT(d.token_id) AS token,s.email,s.fullname, s.lastname, s.firstname, s.phone, s.company, s.position, s.country, s.city FROM tbl_exhibitor as x INNER JOIN tbl_day as d ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id");

$query_cnt = mysqli_query($conn, "SELECT  d.token_id, d.email,s.fullname, s.firstname, s.lastname, sum(d.no_of_visit) as days FROM tbl_exhibitor as x INNER JOIN tbl_day as d ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id 
	WHERE x.exhibitor_id=$id GROUP BY d.token_id ORDER by days DESC");

// ----------End of new Data --------------

//---------------- Start Quick Summary Visitors Count Query -----------

$query_sum1= mysqli_query($conn,"SELECT sum(d.no_of_visit) as DAY1 FROM tbl_exhibitor as x INNER JOIN tbl_day as d 
	ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 1'");

$query_sum2= mysqli_query($conn,"SELECT sum(d.no_of_visit) as DAY2 FROM tbl_exhibitor as x INNER JOIN tbl_day as d 
	ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 2'");

$query_sum3= mysqli_query($conn,"SELECT sum(d.no_of_visit) as DAY3 FROM tbl_exhibitor as x INNER JOIN tbl_day as d 
	ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 3'");

$query_sum4= mysqli_query($conn,"SELECT sum(d.no_of_visit) as DAY4 FROM tbl_exhibitor as x INNER JOIN tbl_day as d 
	ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 4'");

$query_sum5= mysqli_query($conn,"SELECT sum(d.no_of_visit) as DAY5 FROM tbl_exhibitor as x INNER JOIN tbl_day as d 
	ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 5'");

$query_sum6= mysqli_query($conn,"SELECT sum(d.no_of_visit) as DAY6 FROM tbl_exhibitor as x INNER JOIN tbl_day as d 
	ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 6'");

$query_sum7= mysqli_query($conn,"SELECT sum(d.no_of_visit) as DAY7 FROM tbl_exhibitor as x INNER JOIN tbl_day as d 
	ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id AND d.day='Day 7'");

$query_sum = mysqli_query($conn,"SELECT sum(d.no_of_visit) as DAY0 FROM tbl_exhibitor as x INNER JOIN tbl_day as d 
	ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id");

$ex_name = mysqli_query($conn,"SELECT DISTINCT(x.Exhibitor_name) AS EXHIBITOR_NAME FROM tbl_exhibitor as x INNER JOIN tbl_day as d ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id 
WHERE x.exhibitor_id=$id");

// QUERY TO GET Unique Visitor Count per Day

$query_num1 = mysqli_query($conn, "SELECT COUNT(d.token_id) as num_day1 FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 1' AND x.exhibitor_id =$id ORDER BY s.Company ASC");

$query_num2 = mysqli_query($conn, "SELECT COUNT(d.token_id) as num_day2 FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 2' AND x.exhibitor_id =$id ORDER BY s.Company ASC");

$query_num3 = mysqli_query($conn,"SELECT COUNT(d.token_id) as num_day3 FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 3' AND x.exhibitor_id =$id ORDER BY s.Company ASC");

$query_num4 = mysqli_query($conn, "SELECT COUNT(d.token_id) as num_day4 FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 4' AND x.exhibitor_id =$id ORDER BY s.Company ASC");


$query_num5 = mysqli_query($conn, "SELECT COUNT(d.token_id) as num_day5 FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 5' AND x.exhibitor_id =$id ORDER BY s.Company ASC");


$query_num6 = mysqli_query($conn, "SELECT COUNT(d.token_id) as num_day6 FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 6' AND x.exhibitor_id =$id ORDER BY s.Company ASC");


$query_num7 = mysqli_query($conn, "SELECT COUNT(d.token_id) as num_day7 FROM tbl_day AS d INNER JOIN tbl_summary AS s ON d.token_id=s.token_id INNER JOIN tbl_exhibitor as x ON d.exhibitor_id=x.exhibitor_id WHERE d.day='Day 7' AND x.exhibitor_id =$id ORDER BY s.Company ASC");

$query_num0 = mysqli_query($conn,"SELECT COUNT(DISTINCT(d.token_id)) as num_day0 FROM tbl_exhibitor as x INNER JOIN tbl_day as d ON x.exhibitor_id=d.exhibitor_id INNER JOIN tbl_summary as s ON d.token_id=s.token_id WHERE x.exhibitor_id=$id");


// END OF QUERY TO GET Unique Visitor Count per Day


//---------------- End Quick Summary Visitors Count Query -----------

/* Create new PHPExcel object*/
$objPHPExcel = new PHPExcel();

// ------------------------------------------------------------------------------------------------------
//---------------- Start Quick Summary Visitors Count Sheet -----------
$objPHPExcel->setActiveSheetIndex(0);
// $objPHPExcel->getActiveSheet()->setCellValue('A2', 'DAY 1');
$objPHPExcel->setActiveSheetIndex(0);
// $objPHPExcel->getActiveSheet()->setCellValue('A2', 'DAY 1');
$objPHPExcel->getActiveSheet()->setCellValue('B4', '05-NOV');
$objPHPExcel->getActiveSheet()->setCellValue('C4', '06-NOV');
$objPHPExcel->getActiveSheet()->setCellValue('D4', '07-NOV');
$objPHPExcel->getActiveSheet()->setCellValue('E4', '08-NOV');
$objPHPExcel->getActiveSheet()->setCellValue('F4', '09-NOV');
$objPHPExcel->getActiveSheet()->setCellValue('G4', '10-NOV');
$objPHPExcel->getActiveSheet()->setCellValue('H4', '11-NOV');
$objPHPExcel->getActiveSheet()->setCellValue('B5', 'DAY 1');
$objPHPExcel->getActiveSheet()->setCellValue('C5', 'DAY 2');
$objPHPExcel->getActiveSheet()->setCellValue('D5', 'DAY 3');
$objPHPExcel->getActiveSheet()->setCellValue('E5', 'DAY 4');
$objPHPExcel->getActiveSheet()->setCellValue('F5', 'DAY 5');
$objPHPExcel->getActiveSheet()->setCellValue('G5', 'DAY 6');
$objPHPExcel->getActiveSheet()->setCellValue('H5', 'DAY 7');
$objPHPExcel->getActiveSheet()->setCellValue('I5', 'Total Number of Visit Counts');
$objPHPExcel->getActiveSheet()->setCellValue('J5', '*Total Unique Access Link Count');
$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Number of Visits');
$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Unique Access Link Count per Day');
$objPHPExcel->getActiveSheet()->setCellValue('A9', '* This number represents the number of visitor that visited your booth according to their unique access link');

$i=6;
$a=2;
$t=7;

while($query_sum1_cnt= mysqli_fetch_array($query_sum1)) {
	$cnt_sum1=$query_sum1_cnt['DAY1'];

while($query_sum2_cnt= mysqli_fetch_array($query_sum2)) {
	$cnt_sum2=$query_sum2_cnt['DAY2'];

while($query_sum3_cnt= mysqli_fetch_array($query_sum3)) {
	$cnt_sum3=$query_sum3_cnt['DAY3'];	

while($query_sum4_cnt= mysqli_fetch_array($query_sum4)) {
	$cnt_sum4=$query_sum4_cnt['DAY4'];

while($query_sum5_cnt= mysqli_fetch_array($query_sum5)) {
	$cnt_sum5=$query_sum5_cnt['DAY5'];	

while($query_sum6_cnt= mysqli_fetch_array($query_sum6)) {
	$cnt_sum6=$query_sum6_cnt['DAY6'];

while($query_sum7_cnt= mysqli_fetch_array($query_sum7)) {
	$cnt_sum7=$query_sum7_cnt['DAY7'];

while($query_sum8_cnt= mysqli_fetch_array($query_sum)) {
	$cnt_sum8=$query_sum8_cnt['DAY0'];

while($exname= mysqli_fetch_array($ex_name)) {
	$exhibitor=$exname['EXHIBITOR_NAME'];

while($num1= mysqli_fetch_array($query_num1)) {
	$cnt_num1=$num1['num_day1'];		

while($num2= mysqli_fetch_array($query_num2)) {
	$cnt_num2=$num2['num_day2'];

while($num3= mysqli_fetch_array($query_num3)) {
	$cnt_num3=$num3['num_day3'];

while($num4= mysqli_fetch_array($query_num4)) {
	$cnt_num4=$num4['num_day4'];

while($num5= mysqli_fetch_array($query_num5)) {
	$cnt_num5=$num5['num_day5'];

while($num6= mysqli_fetch_array($query_num6)) {
	$cnt_num6=$num6['num_day6'];

while($num7= mysqli_fetch_array($query_num7)) {
	$cnt_num7=$num7['num_day7'];

while($num0= mysqli_fetch_array($query_num0)) {
	$cnt_num0=$num0['num_day0'];	



	// $objPHPExcel->getActiveSheet()->setCellValue("A$i",$email_cnt);
	$objPHPExcel->getActiveSheet()->setCellValue("A$a",$exhibitor);
	$objPHPExcel->getActiveSheet()->setCellValue("B$i",$cnt_sum1);
	$objPHPExcel->getActiveSheet()->setCellValue("B$t",$cnt_num1);
	$objPHPExcel->getActiveSheet()->setCellValue("C$i",$cnt_sum2);
	$objPHPExcel->getActiveSheet()->setCellValue("C$t",$cnt_num2);
	$objPHPExcel->getActiveSheet()->setCellValue("D$i",$cnt_sum3);
	$objPHPExcel->getActiveSheet()->setCellValue("D$t",$cnt_num3);
	$objPHPExcel->getActiveSheet()->setCellValue("E$i",$cnt_sum4);
	$objPHPExcel->getActiveSheet()->setCellValue("E$t",$cnt_num4);
	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$cnt_sum5);
	$objPHPExcel->getActiveSheet()->setCellValue("F$t",$cnt_num5);
	$objPHPExcel->getActiveSheet()->setCellValue("G$i",$cnt_sum6);
	$objPHPExcel->getActiveSheet()->setCellValue("G$t",$cnt_num6);
	$objPHPExcel->getActiveSheet()->setCellValue("H$i",$cnt_sum7);
	$objPHPExcel->getActiveSheet()->setCellValue("H$t",$cnt_num7);
	$objPHPExcel->getActiveSheet()->setCellValue("I$i",$cnt_sum8);
	$objPHPExcel->getActiveSheet()->setCellValue("J$t",$cnt_num0);



	// Design of Cells 

	$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B5')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('D5')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('E5')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('F5')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('G5')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('H5')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('I5')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('J5')->getFont()->setBold(true);
    


    $objPHPExcel->getActiveSheet()->getStyle('I5')->applyFromArray(
        array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFFF33')
            )
        )

);
        $objPHPExcel->getActiveSheet()->getStyle('J5')->applyFromArray(
        array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FF0000')
            )
        )

);
// Border Thin
    $styleArray = array(
  	'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);

$objPHPExcel->getActiveSheet()->getStyle('A5:J7')->applyFromArray($styleArray);
unset($styleArray);
	
$i++;
								}
							}
						}
					}
				}
			}
		}
	}
}
	}
		}
			}	
				}
					}
						}
							}
								}
/* Unique Visitor Database*/
$objPHPExcel->getActiveSheet()->setTitle('Quick Summary Visitors Count');
// ------------- End Code for Total No. of Visits Per Visitor
/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();


//---------------- End Quick Summary Visitors Count Sheet -----------


// ------------- Start Code for Total No. of Visits Per Visitor
/* Add some data to the second sheet, resembling some different data types*/
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'USER UNIQUE TOKEN'); 
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'EMAIL');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'FULLNAME');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'FIRST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'LAST NAME');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'DAY 1 - 7');
$i=2;
while($query_count= mysqli_fetch_array($query_cnt)) {
	$token = $query_count['token_id'];
	$fname = $query_count['firstname'];
	$lname =$query_count['lastname'];
	$email_cnt=$query_count['email'];
	$fullname= $query_count['fullname'];
	$cnt=$query_count['days'];

	$objPHPExcel->getActiveSheet()->setCellValue("A$i",utf8_encode($token));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i",utf8_encode($email_cnt));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i",utf8_encode($fullname));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i",utf8_encode($fname));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i",utf8_encode($lname));	
	$objPHPExcel->getActiveSheet()->setCellValue("F$i",$cnt);
	
$i++;
}

/* Unique Visitor Database*/
$objPHPExcel->getActiveSheet()->setTitle('Total No. of Visits Per Visitor');
// ------------- End Code for Total No. of Visits Per Visitor
/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();

// ------------- Start Code for Unique Visitor Database

/* Add some data to the second sheet, resembling some different data types*/
$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'USER UNIQUE TOKEN');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Full Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'First Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Last Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Mobile #');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Position');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Country');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'City');
$i=2;
while($qry= mysqli_fetch_array($query)) {
	$token_qry =$qry['token'];
	$fullname=$qry['fullname']; 
	$lname=$qry['lastname'];
	$fname =$qry['firstname'];
	$email=$qry['email'];
	$phone =$qry['phone'];
	$company=$qry['company'];
	$pos =$qry['position'];
	$country=$qry['country'];
	$city =$qry['city'];

	$objPHPExcel->getActiveSheet()->setCellValue("A$i", utf8_encode($token_qry));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i", utf8_encode($fullname));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i", utf8_encode($lname));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i", utf8_encode($fname));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i", utf8_encode($email));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i", utf8_encode($phone));
	$objPHPExcel->getActiveSheet()->setCellValue("G$i", utf8_encode($company));
	$objPHPExcel->getActiveSheet()->setCellValue("H$i", utf8_encode($pos));
	$objPHPExcel->getActiveSheet()->setCellValue("I$i", utf8_encode($country));
	$objPHPExcel->getActiveSheet()->setCellValue("J$i", utf8_encode($city));	
$i++;
}

/* Unique Visitor Database*/
$objPHPExcel->getActiveSheet()->setTitle('Unique Visitor Database');
// ------------- End Code for Unique Visitor Database
/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();
// ------------------------------------------------------------------------------------------------------

/* Create a first sheet, representing sales data*/
$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'USER UNIQUE TOKEN');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Full Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'First Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Last Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Mobile #');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Positin');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Country');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'City');
// $objPHPExcel->getActiveSheet()->setCellValue('J1', 'No Of Visit');

$i=2;
while($row = mysqli_fetch_array($result)) {
	$token_day1 = $row['token_day1'];
	$fullname=$row['fullname']; 
	$lname=$row['lastname'];
	$fname =$row['firstname'];
	$email_day1=$row['email'];
	$phone =$row['phone'];
	$company=$row['company'];
	$pos =$row['position'];
	$country=$row['country'];
	$city =$row['city'];

	$objPHPExcel->getActiveSheet()->setCellValue("A$i", utf8_encode($token_day1));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i", utf8_encode($fullname));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i", utf8_encode($lname));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i", utf8_encode($fname));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i", utf8_encode($email_day1));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i", utf8_encode($phone));
	$objPHPExcel->getActiveSheet()->setCellValue("G$i", utf8_encode($company));
	$objPHPExcel->getActiveSheet()->setCellValue("H$i", utf8_encode($pos));
	$objPHPExcel->getActiveSheet()->setCellValue("I$i", utf8_encode($country));
	$objPHPExcel->getActiveSheet()->setCellValue("J$i", utf8_encode($city));	

$i++;
}



/*Rename sheet*/ 
$objPHPExcel->getActiveSheet()->setTitle('Day 1 Visitors List');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();

/* Add some data to the second sheet, resembling some different data types*/
$objPHPExcel->setActiveSheetIndex(4);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'USER UNIQUE TOKEN');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Full Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'First Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Last Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Mobile #');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Positin');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Country');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'City');
$i=2;
while($row1= mysqli_fetch_array($result1)) {
	$token_day2=$row1['token_day2'];
	$fullname=$row1['fullname']; 
	$lname=$row1['lastname'];
	$fname =$row1['firstname'];
	$email_day2=$row1['email'];
	$phone =$row1['phone'];
	$company=$row1['company'];
	$pos =$row1['position'];
	$country=$row1['country'];
	$city =$row1['city'];

	$objPHPExcel->getActiveSheet()->setCellValue("A$i", utf8_encode($token_day2));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i", utf8_encode($fullname));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i", utf8_encode($lname));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i", utf8_encode($fname));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i", utf8_encode($email_day2));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i", utf8_encode($phone));
	$objPHPExcel->getActiveSheet()->setCellValue("G$i", utf8_encode($company));
	$objPHPExcel->getActiveSheet()->setCellValue("H$i", utf8_encode($pos));
	$objPHPExcel->getActiveSheet()->setCellValue("I$i", utf8_encode($country));
	$objPHPExcel->getActiveSheet()->setCellValue("J$i", utf8_encode($city));		
$i++;
}

/* Rename 2nd sheet*/
$objPHPExcel->getActiveSheet()->setTitle('Day 2 Visitors List');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();

/* Add some data to the second sheet, resembling some different data types*/
$objPHPExcel->setActiveSheetIndex(5);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'USER UNIQUE TOKEN');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Full Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'First Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Last Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Mobile #');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Positin');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Country');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'City');
$i=2;
while($row2= mysqli_fetch_array($result2)) {
	$token_day3=$row2['token_day3'];
	$fullname=$row2['fullname']; 
	$lname=$row2['lastname'];
	$fname =$row2['firstname'];
	$email_day3=$row2['email'];
	$phone =$row2['phone'];
	$company=$row2['company'];
	$pos =$row2['position'];
	$country=$row2['country'];
	$city =$row2['city'];

	$objPHPExcel->getActiveSheet()->setCellValue("A$i", utf8_encode($token_day3));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i", utf8_encode($fullname));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i", utf8_encode($lname));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i", utf8_encode($fname));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i", utf8_encode($email_day3));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i", utf8_encode($phone));
	$objPHPExcel->getActiveSheet()->setCellValue("G$i", utf8_encode($company));
	$objPHPExcel->getActiveSheet()->setCellValue("H$i", utf8_encode($pos));
	$objPHPExcel->getActiveSheet()->setCellValue("I$i", utf8_encode($country));
	$objPHPExcel->getActiveSheet()->setCellValue("J$i", utf8_encode($city));		
$i++;
}

/* Rename 3rd sheet*/
$objPHPExcel->getActiveSheet()->setTitle('Day 3 Visitors List');
/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();

/* Add some data to the second sheet, resembling some different data types*/
$objPHPExcel->setActiveSheetIndex(6);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'USER UNIQUE TOKEN');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Full Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'First Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Last Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Mobile #');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Position');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Country');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'City');
$i=2;
while($row3= mysqli_fetch_array($result3)) {
	$token_day4=$row3['token_day4'];
	$fullname=$row3['fullname']; 
	$lname=$row3['lastname'];
	$fname =$row3['firstname'];
	$email_day4=$row3['email'];
	$phone =$row3['phone'];
	$company=$row3['company'];
	$pos =$row3['position'];
	$country=$row3['country'];
	$city =$row3['city'];

	$objPHPExcel->getActiveSheet()->setCellValue("A$i", utf8_encode($token_day4));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i", utf8_encode($fullname));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i", utf8_encode($lname));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i", utf8_encode($fname));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i", utf8_encode($email_day4));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i", utf8_encode($phone));
	$objPHPExcel->getActiveSheet()->setCellValue("G$i", utf8_encode($company));
	$objPHPExcel->getActiveSheet()->setCellValue("H$i", utf8_encode($pos));
	$objPHPExcel->getActiveSheet()->setCellValue("I$i", utf8_encode($country));
	$objPHPExcel->getActiveSheet()->setCellValue("J$i", utf8_encode($city));		
$i++;
}

/* Rename 4th sheet*/
$objPHPExcel->getActiveSheet()->setTitle('Day 4 Visitors List');

// ------------------New Code --------------

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();

/* Add some data to the second sheet, resembling some different data types*/
$objPHPExcel->setActiveSheetIndex(7);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'USER UNIQUE TOKEN');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Full Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'First Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Last Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Mobile #');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Position');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Country');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'City');
$i=2;
while($row4= mysqli_fetch_array($result4)) {
	$token_day5 = $row4['token_day5'];
	$fullname=$row4['fullname']; 
	$lname=$row4['lastname'];
	$fname =$row4['firstname'];
	$email_day5=$row4['email'];
	$phone =$row4['phone'];
	$company=$row4['company'];
	$pos =$row4['position'];
	$country=$row4['country'];
	$city =$row4['city'];

	$objPHPExcel->getActiveSheet()->setCellValue("A$i", utf8_encode($token_day5));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i", utf8_encode($fullname));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i", utf8_encode($lname));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i", utf8_encode($fname));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i", utf8_encode($email_day5));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i", utf8_encode($phone));
	$objPHPExcel->getActiveSheet()->setCellValue("G$i", utf8_encode($company));
	$objPHPExcel->getActiveSheet()->setCellValue("H$i", utf8_encode($pos));
	$objPHPExcel->getActiveSheet()->setCellValue("I$i", utf8_encode($country));
	$objPHPExcel->getActiveSheet()->setCellValue("J$i", utf8_encode($city));		
$i++;
}

/* Rename 4th sheet*/
$objPHPExcel->getActiveSheet()->setTitle('Day 5 Visitors List ');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();

/* Add some data to the second sheet, resembling some different data types*/
$objPHPExcel->setActiveSheetIndex(8);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'USER UNIQUE TOKEN');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Full Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'First Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Last Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Mobile #');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Position');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Country');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'City');
$i=2;
while($row5= mysqli_fetch_array($result5)) {
	$token_day6=$row5['token_day6'];
	$fullname=$row5['fullname']; 
	$lname=$row5['lastname'];
	$fname =$row5['firstname'];
	$email_day6=$row5['email'];
	$phone =$row5['phone'];
	$company=$row5['company'];
	$pos =$row5['position'];
	$country=$row5['country'];
	$city =$row5['city'];

	$objPHPExcel->getActiveSheet()->setCellValue("A$i", utf8_encode($token_day6));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i", utf8_encode($fullname));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i", utf8_encode($lname));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i", utf8_encode($fname));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i", utf8_encode($email_day6));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i", utf8_encode($phone));
	$objPHPExcel->getActiveSheet()->setCellValue("G$i", utf8_encode($company));
	$objPHPExcel->getActiveSheet()->setCellValue("H$i", utf8_encode($pos));
	$objPHPExcel->getActiveSheet()->setCellValue("I$i", utf8_encode($country));
	$objPHPExcel->getActiveSheet()->setCellValue("J$i", utf8_encode($city));		
$i++;
}

/* Rename 4th sheet*/
$objPHPExcel->getActiveSheet()->setTitle('Day 6 Visitors List');

/* Create a new worksheet, after the default sheet*/
$objPHPExcel->createSheet();

/* Add some data to the second sheet, resembling some different data types*/
$objPHPExcel->setActiveSheetIndex(9);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'USER UNIQUE TOKEN');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Full Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'First Name');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Last Name');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Mobile #');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Position');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Country');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'City');
$i=2;
while($row6= mysqli_fetch_array($result6)) {
	$token_day7=$row6['token_day7'];
	$fullname=$row6['fullname']; 
	$lname=$row6['lastname'];
	$fname =$row6['firstname'];
	$email_day7=$row6['email'];
	$phone =$row6['phone'];
	$company=$row6['company'];
	$pos =$row6['position'];
	$country=$row6['country'];
	$city =$row6['city'];

	$objPHPExcel->getActiveSheet()->setCellValue("A$i", utf8_encode($token_day7));
	$objPHPExcel->getActiveSheet()->setCellValue("B$i", utf8_encode($fullname));
	$objPHPExcel->getActiveSheet()->setCellValue("C$i", utf8_encode($lname));
	$objPHPExcel->getActiveSheet()->setCellValue("D$i", utf8_encode($fname));
	$objPHPExcel->getActiveSheet()->setCellValue("E$i", utf8_encode($email_day7));
	$objPHPExcel->getActiveSheet()->setCellValue("F$i", utf8_encode($phone));
	$objPHPExcel->getActiveSheet()->setCellValue("G$i", utf8_encode($company));
	$objPHPExcel->getActiveSheet()->setCellValue("H$i", utf8_encode($pos));
	$objPHPExcel->getActiveSheet()->setCellValue("I$i", utf8_encode($country));
	$objPHPExcel->getActiveSheet()->setCellValue("J$i", utf8_encode($city));		
$i++;
}

/* Rename 4th sheet*/
$objPHPExcel->getActiveSheet()->setTitle('Day 7 Visitors List');

// ----------End of new Data --------------


/* Redirect output to a client’s web browser (Excel5)*/
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Export_SUMMARY_Data_PHILCONVX.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

?>
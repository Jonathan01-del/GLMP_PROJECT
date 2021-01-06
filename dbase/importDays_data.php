<?php
// Load the database configuration file
include_once 'parts/dbConfig.php';

if(isset($_POST['importSubmit'])){

    // $days = $_POST['days'];
    // $exhibitor = $_POST['exhibitor'];
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $company =$db->real_escape_string(utf8_encode($line[0]));
                $salutation =$db->real_escape_string(utf8_encode($line[0]));$line[1];
                $fname = $db->real_escape_string(utf8_encode($line[2]));
                $lname = $db->real_escape_string(utf8_encode($line[3]));
                $designation =$db->real_escape_string(utf8_encode($line[4])); 
                $address = $db->real_escape_string(utf8_encode($line[11]));
                $city = $db->real_escape_string(utf8_encode($line[12]));
                $country= $db->real_escape_string(utf8_encode($line[13]));
                $tel = $db->real_escape_string(utf8_encode($line[14]));
                $mobile =$db->real_escape_string(utf8_encode($line[15]));
                $email =$db->real_escape_string(utf8_encode($line[17]));
                $website =$db->real_escape_string(utf8_encode($line[18]));


                $qryComp = "SELECT company_id, company_name FROM tbl_company WHERE company_name = '$company'";
                $qryRowComp = $db->query($qryComp);
                $fetch_comp = $qryRowComp->fetch_assoc();
                $get_comp_id = $fetch_comp["company_id"];

                if ($qryRowComp->num_rows > 0) {
                    $qryName = "SELECT fname, lname FROM tbl_contact WHERE fname = '$fname' AND lname = '$lname' AND company_id = $get_comp_id";
                    $qryRowName = $db->query($qryName);

                    if ($qryRowName->num_rows > 0) {

                        // Update contact data in the database
                        $db->query("UPDATE tbl_contact SET mobile = '$mobile', email = '$email' WHERE fname = '$fname' AND lname = '$lname' AND company_id = $get_comp_id");
                    
                    }else {

                        // Insert contact data in the database
                        $db->query("INSERT INTO tbl_contact (company_id, salutation, fname, lname, designation, address,city, country, mobile, email, date_created) VALUES ('$get_comp_id', '$salutation', '$fname', '$lname', '$designation', '$address', '$city', '$country', '$mobile', '$email', NOW())");
                    }

                } else {
                    // Insert company data in the database
                    $insert_company = "INSERT INTO tbl_company (company_name, address, city, country, telephone, email , website, date_created) VALUES ('$company', '$address', '$city', '$country', '$tel', '$email', '$website', NOW())" ;

                    if ($db->query($insert_company) === TRUE) {
                        $comp_id = $db->insert_id;

                        // Insert contact data in the database
                        $db->query("INSERT INTO tbl_contact (company_id, salutation, fname, lname, designation, address, city, country, mobile, email, date_created) VALUES ('$comp_id', '$salutation', '$fname', '$lname', '$designation', '$address', '$city', '$country', '$mobile', '$email', NOW())");
                    }
                }


               
                

                
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: index.php".$qstring);

                // // Check whether member already exists in the database with the same email
                // $prevQuery = "SELECT id FROM members WHERE email = '".$line[1]."'";
                // $prevResult = $db->query($prevQuery);
                
                // if($prevResult->num_rows > 0){
                //     // Update member data in the database
                //     $db->query("UPDATE members SET name = '".$name."', phone = '".$phone."', status = '".$status."', modified = NOW() WHERE email = '".$email."'");
                // }else{
                //     // Insert member data in the database
                //     $db->query("INSERT INTO members (name, email, phone, created, modified, status) VALUES ('".$name."', '".$email."', '".$phone."', NOW(), NOW(), '".$status."')");
                // }

                    // Insert member data in the database
                    // $db->query("INSERT INTO tbl_day (exhibitor_id, token_id, email, no_of_visit, day, date_created) VALUES ('".$exhibitor."', '".$id."', '".$email."', '".$visit."', '".$days."', NOW())");
                // // Check whether member already exists in the database with the same email
                // $prevQuery = "SELECT company_name FROM tbl_company WHERE company_name = '$company_name'";
                // $prevResult = $db->query($prevQuery);
                
                // if($prevResult->num_rows > 0){
                //     // Update member data in the database
                //     $db->query("UPDATE tbl_company AS b INNER JOIN tbl_contact AS c ON c.company_id=b.company_id SET 
                //         b.company_name = '$company_name', 
                //         b.address = '$address', 
                //         b.city = '$city', 
                //         b.country ='$country', 
                //         b.telephone = '$tel', 
                //         b.email='$email', 
                //         b.website='$website',                      
                //         b.date_created = NOW(),
                //         c.salutation ='$salutation',
                //         c.fname = '$fname',
                //         c.lname = '$lname',
                //         c.address = '$address',
                //         c.city = '$city',
                //         c.country = 'country',
                //         c.mobile = '$mobile',
                //         c.email= '$email',
                //         c.date_updated=NOW()
                //         WHERE b.company_name = '$company_name' ");

                // }else{
                //     // Insert member data in the database
                //     $db->query("INSERT INTO tbl_company (company_name, address, city, country, telephone, email, website, date_created) VALUES ('$company_name', '$address', '$city', '$country', '$tel', '$email', '$website',NOW())");

                //     $last_insert_id=mysqli_insert_id($db);


                //     $db->query("INSERT INTO tbl_contact (salutation, fname, lname, designation, address, city, country, mobile, email, company_id,date_created)
                //         VALUES ('$salutation', '$fname', '$lname', '$designation', '$address', '$city', '$country', '$mobile', '$email', '$last_insert_id', NOW())");

                // }
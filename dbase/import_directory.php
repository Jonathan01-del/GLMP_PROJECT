<?php
// Load the database configuration file
include_once 'parts/dbConfig.php';

if(isset($_POST['importSubmit'])){


    $directory = $_POST['directory'];
    
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
                $salutation =$db->real_escape_string(utf8_encode($line[1]));
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

                $prod_profile =$db->real_escape_string(utf8_encode($line[19]));
                $line_Bus =$db->real_escape_string(utf8_encode($line[22]));


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

                    # New  Query to Insert the tbl_company_profile
                    $qrypro = "SELECT directory_id FROM tbl_company WHERE directory_id = $directory AND company_id='$get_comp_id'";
                    $qryproResult = $db->query($qrypro);
                    if ($qryproResult->num_rows > 0) {

                        //update tbl_company_profile
                        $db->query("UPDATE tbl_company_profile SET directory_id=$directory WHERE company_id='$get_comp_id' ");
                        

                    }else{

                        // Insert tbl_company_profile 
                        $db->query("INSERT INTO tbl_company_profile (company_id, directory_id, date_created) VALUES ('$get_comp_id','$directory', NOW())");

                    }
                    # End  Query to Insert the tbl_company_profile

                } else {
                    // Insert company data in the database
                    $insert_company = "INSERT INTO tbl_company (company_name, address, city, country, telephone, email , product_profile, main_line_of_business, website, directory_id, date_created) VALUES ('$company', '$address', '$city', '$country', '$tel', '$email','$prod_profile', '$line_Bus', '$website', '$directory' , NOW())" ;

                    if ($db->query($insert_company) === TRUE) {
                        $comp_id = $db->insert_id;

                        // Insert contact data in the database
                        $db->query("INSERT INTO tbl_contact (company_id, salutation, fname, lname, designation, address, city, country, mobile, email, date_created) VALUES ('$comp_id', '$salutation', '$fname', '$lname', '$designation', '$address', '$city', '$country', '$mobile', '$email', NOW())");

                        # INSERT THE VALUE TO tbl_company_profile
                        $db->query("INSERT INTO tbl_company_profile(company_id, directory_id, date_created) VALUES ('$comp_id','$directory',  NOW())");
                        # END THE VALUE TO tbl_company_profile
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
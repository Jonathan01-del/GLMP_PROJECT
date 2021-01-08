<?php
// Load the database configuration file
include_once 'parts/dbConfig.php';

if(isset($_POST['importSubmit'])){

    // $days = $_POST['days'];
    // $exhibitor = $_POST['exhibitor'];
    $assoc_id = $_POST['association'];
    $ind_id = $_POST['industry'];
    $encoder=$_POST['encoder'];
    
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
                $address = $db->real_escape_string(utf8_encode($line[6]));
                $city = $db->real_escape_string(utf8_encode($line[7]));
                $country= $db->real_escape_string(utf8_encode($line[8]));
                $tel = $db->real_escape_string(utf8_encode($line[9]));
                $mobile =$db->real_escape_string(utf8_encode($line[10]));
                $fax =$db->real_escape_string(utf8_encode($line[11]));
                $email =$db->real_escape_string(utf8_encode($line[12]));
                $website =$db->real_escape_string(utf8_encode($line[13]));
                $prod_profile =$db->real_escape_string(utf8_encode($line[14]));
                $line_Bus =$db->real_escape_string(utf8_encode($line[16]));
                $last_update=$db->real_escape_string(utf8_encode($line[22]));


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
                    $qrypro = "SELECT assoc_id, ind_id FROM tbl_company WHERE assoc_id ='$assoc_id' OR ind_id='$ind_id' AND company_id='$get_comp_id'";
                    $qryproResult = $db->query($qrypro);
                    if ($qryproResult->num_rows > 0) {

                        //update tbl_company_profile
                        $db->query("UPDATE tbl_company_profile SET assoc_id='$assoc_id' ind_id='$ind_id' WHERE company_id='$get_comp_id' ");
                        

                    }else{

                        // Insert tbl_company_profile 
                        $db->query("INSERT INTO tbl_company_profile (company_id, assoc_id, ind_id, encoder_id, date_encoded, date_created) VALUES ('$get_comp_id','$assoc_id', '$ind_id','$encoder', '$last_update', NOW())");

                    }
                    # End  Query to Insert the tbl_company_profile

                } else {
                    // Insert company data in the database
                    $insert_company = "INSERT INTO tbl_company (company_name, address, city, country, telephone, fax, email , product_profile, main_line_of_business, website, assoc_id, ind_id, date_created) VALUES ('$company', '$address', '$city', '$country', '$tel', '$fax', '$email','$prod_profile', '$line_Bus', '$website', '$assoc_id', '$ind_id', NOW())" ;

                    if ($db->query($insert_company) === TRUE) {
                        $comp_id = $db->insert_id;

                        // Insert contact data in the database
                        $db->query("INSERT INTO tbl_contact (company_id, salutation, fname, lname, designation, address, city, country, mobile, email, date_created) VALUES ('$comp_id', '$salutation', '$fname', '$lname', '$designation', '$address', '$city', '$country', '$mobile', '$email', NOW())");

                        # INSERT THE VALUE TO tbl_company_profile
                        $db->query("INSERT INTO tbl_company_profile (company_id, assoc_id, ind_id, encoder_id, date_encoded, date_created) VALUES ('$comp_id', '$assoc_id', '$ind_id', '$encoder', '$last_update', NOW())");
                        # END THE VALUE TO tbl_company_profile

                        # CLEAR TBL CONTACT IF EMPTY 
                        $db->query("DELETE FROM tbl_contact WHERE fname='' AND lname='' AND designation=''");
                        # CLEAR TBL CONTACT IF EMPTY 
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
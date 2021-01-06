<?php
// Load the database configuration file
include_once 'parts/dbConfig.php';

if(isset($_POST['importSubmit'])){

    $select_show = $_POST['selected_show'];
    
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
                $token = $line[0];
                $fullname  = $line[1];
                $lastname  = $line[2];
                $firstname  = $line[3];
                $email = $line[4];
                $phone = $line[5];
                $company = $line[6];
                $position = $line[7];
                $country = $line[8];
                $city = $line[9];
                $dte = $line[10];

                
                
                    // Insert member data in the database
                    $db->query("INSERT INTO tbl_summary (token_id, fullname, lastname, firstname, email, phone, company, position, country, city, date_upload, show_id, date_created) VALUES ('".$token."','".$fullname."', '".$lastname."', '".$firstname."', '".$email."', '".$phone."', '".$company."', '".$position."', '".$country."', '".$city."', '".$dte."', '".$select_show."', NOW())");
                
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
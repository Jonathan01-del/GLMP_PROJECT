<?php


// call export function
exportMysqlToCsv('Techno_forum_FREE_TRACKS.csv');


// export csv
function exportMysqlToCsv($filename = 'Techno_forum_FREE_TRACKS.csv')
{

   $conn = dbConnection();
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $trk = $_GET['track'];

    $sql_query = sprintf("SELECT d.FNAME AS FIRST_NAME, 
        d.LNAME AS LAST_NAME, 
        d.COMPANY AS COMPANY_NAME, 
        d.MOBILE AS MOBILE_NO, 
        d.EMAIL AS EMAIL_ADDRESS, 
        l.ID AS ID, 
        l.ACTIVITY AS CONFERENCE_NAME, 
        s.TRACK_CODE AS TRACKS_CODE,
        l.TRACK_NO AS TRACKS, 
        l.STATUS AS CONFERENCE_TYPE 
        FROM selected_track AS s INNER JOIN list_track as l ON s.TRACK_CODE=l.CODE INNER JOIN delegate AS d 
        ON s.DELEGATE_ID=d.ID WHERE s.TRACK_CODE ='$trk'");

    // Gets the data from the database
    $result = $conn->query($sql_query);

    $f = fopen('php://temp', 'wt');
    $first = true;
    while ($row = $result->fetch_assoc()) {
        if ($first) {
            fputcsv($f, array_keys($row));
            $first = false;
        }
        fputcsv($f, $row);
    } // end while

    $conn->close();

    $size = ftell($f);
    rewind($f);

    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Length: $size");
    // Output to browser with appropriate mime type, you choose ;)
    header("Content-type: text/x-csv");
    header("Content-type: text/csv");
    header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=$filename");
    fpassthru($f);
    exit;

}

// db connection function
function dbConnection(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "technoforum2020";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    return $conn;
}


?>
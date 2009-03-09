<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * FORMAT: http://localhost/vehicle1/parseGPSRawMessage.php?raw_msg=123519,1045.2059,N,10637.7378,E
 */

$raw_msg = $_GET["raw_msg"];
if($raw_msg)
{

    $words = split(",", $raw_msg);
//    for($i=0; $i<sizeof($words); $i++)
//    {
//        echo $words[$i]."<br>";
//    }

    $gps_time = format_time_string($words[0]);
    $latitude = get_latitude($words[1], $words[2]);
    $longitude = get_longitude($words[3], $words[4]);
    $vehicle_id = $words[5];

    // Configuration
    $host = 'localhost';
    $user = 'trieu';
    $pass = '1234';
    $database = 'demo2';

    $mysqli = mysqli_connect($host, $user, $pass, $database);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    } else {
        $sql = "INSERT INTO `gps_markers`(so_dang_ky_xe,lat,lng,gps_time) VALUES ('$vehicle_id','$latitude','$longitude','$gps_time')";
        $res = mysqli_query($mysqli, $sql);

        if ($res === TRUE) {
            echo "A record has been inserted.";
            echo "<br>\n";
            echo $gps_time;
            echo "<br>\n";
            echo $latitude;
            echo "<br>\n";
            echo $longitude;
            echo "<br>\n";
            echo $vehicle_id;
        } else {
            printf("Could not insert record: %s\n", mysqli_error($mysqli));
        }

        mysqli_close($mysqli);
    }
}
else
echo "null";



function get_longitude($long,$long_dir) {
    // lines of logitude go from pole to pole and so tell you how far east or west you are

    $long_deg = substr($long, 0, 3);
    $long_min = substr($long, 3);
    $longitude = $long_deg + minutes_to_decimal($long_min);

    if ( $long_dir == "W" ) {
        $longitude = $longitude * -1;
    }

    return($longitude);
}

function get_latitude($lat,$lat_dir) {
    // Lines of latitude go around the earth so tell you how far north or south you are

    $lat_deg = substr($lat, 0, 2);
    $lat_min = substr($lat, 2);
    $latitude = $lat_deg + minutes_to_decimal($lat_min);

    if ( $long_dir == "S" ) {
        $latitude = $latitude * -1;
    }

    return($latitude);
}

function format_time_string($time_string) {
    $hrs = substr($time_string ,0,2);
    $min = substr($time_string ,2,2);
    $sec = substr($time_string ,4,2);
    $formatted_string = $hrs . ":" . $min . ":" . $sec;
    return($formatted_string);
}

function minutes_to_decimal($minutes)
{
    return ($minutes / 60);
}


?>

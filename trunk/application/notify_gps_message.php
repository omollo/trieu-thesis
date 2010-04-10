<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * FORMAT: http://localhost/vehicle/system/application/notify_gps_message.php?raw_msg=10.752345,106.62875,122233,52-kKA3775
*/

$raw_msg = $_POST["raw_msg"];
if( isset ($raw_msg) ) {
    $words = split(",", $raw_msg);

    $latitude = $words[0];
    $longitude = $words[1];
    $gps_time = $words[2];
    $vehicle_id = $words[3];

    // Configuration
    $host = 'sql107.byetcluster.com';
    $user = 'sum_1403815';
    $pass = 'bandethuong';
    $database = 'sum_1403815_vehicle';

    $mysqli = mysqli_connect($host, $user, $pass, $database);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    } else {
        $sql = "INSERT INTO `gps_markers`(so_dang_ky_xe,lat,lng,gps_time) VALUES ('$vehicle_id','$latitude','$longitude','$gps_time')";
        $res = mysqli_query($mysqli, $sql);

        if ($res === TRUE) {
            echo "A record 'gps_marker' has been inserted.";
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
else {
    echo "null";
}


?>

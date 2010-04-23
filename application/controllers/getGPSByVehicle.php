<?php

$sdkxe = $_GET["so_dang_ky_xe"];
$from_datetime = $_GET["from_datetime"];
$to_datetime = $_GET["to_datetime"];
$just_latest_location = $_GET["just_latest_location"] === "true";

// Configuration
$host = 'sql107.byetcluster.com';
$user = 'sum_1403815';
$pass = 'bandethuong';
$database = 'sum_1403815_vehicle';
$sql = "";

if( isset($sdkxe)  && isset($from_datetime) && isset($to_datetime) ) {
    $arr = explode("time",$from_datetime);
    $from_datetime = $arr[0]." ".$arr[1];
    $arr = explode("time",$to_datetime);
    $to_datetime = $arr[0]." ".$arr[1];
    //echo $from_datetime . "   ".$to_datetime;
    $sql = "SELECT so_dang_ky_xe,lat,lng,gps_time FROM `gps_markers` WHERE so_dang_ky_xe = '$sdkxe' AND timesave >= '$from_datetime' AND timesave <= '$to_datetime' ORDER BY timesave DESC";
}
else if($just_latest_location) {
    $sql = "SELECT so_dang_ky_xe,lat,lng,gps_time FROM `gps_markers` WHERE so_dang_ky_xe = '$sdkxe' ORDER BY timesave DESC LIMIT 1,1";
}
else {
    echo "{null:null}";
    exit();
}

$mysqli = mysqli_connect($host, $user, $pass, $database);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
    $result_set = mysqli_query($mysqli, $sql);
    $list = array();
    if ($result_set) {
        while ($newArray = mysqli_fetch_array($result_set, MYSQLI_ASSOC)) {
            $object = new stdClass();
            $object->so_dang_ky_xe = $newArray['so_dang_ky_xe'];
            $object->lat = $newArray['lat'];
            $object->lng = $newArray['lng'];
            $object->gps_time = $newArray['gps_time'];

            array_push($list, $object);
        }
        echo json_encode($list);
    } else {
        printf("Could not retrieve records: %s\n", mysqli_error($mysqli));
    }

    mysqli_free_result($result_set);
    mysqli_close($mysqli);
}
?>
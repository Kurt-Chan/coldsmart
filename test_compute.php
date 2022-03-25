<?php

include "includes/config.php";


// Get all devices
$devices = mysqli_query($conn, "SELECT d.id, m.average_consumption, d.name FROM device as d inner join model as m on m.id = d.model");
while ($device = mysqli_fetch_assoc($devices)) {
    // get all actions for device
    $device_id = $device['id'];
    echo "<br/><br/>Device name:" . $device['name'] . "<br/>";
    $actions = mysqli_query($conn, "SELECT * FROM action where device = '$device_id'");
    $i = 0;
    $timeFirst = "";
    $total = 0;
    while ($row = mysqli_fetch_assoc($actions)) {
        if ($i == 0 && $row['action'] == "ON") {
            $timeFirst  = strtotime($row['datetime']);
            $i++;
        } else if ($i == 1) {
            $timeSecond = strtotime($row['datetime']);
            $differenceInSeconds = $timeSecond - $timeFirst;
            $total += $differenceInSeconds;
            $i = 0;
        }
    }
    $hours = $total / 60 / 60;
    $average_consumption = $device['average_consumption'];
    $utility_rate = 14.95;
    echo "<br/>Total seconds:" . $total;
    echo "<br/>Total minutes:" . $total / 60;
    echo "<br/>Total hours:" . $total / 60 / 60;
    echo "<br/>Price:" . ($hours * $average_consumption * $utility_rate);
}

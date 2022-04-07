<?php
include 'func_software.php';
header('Content-Type: application/json');
$query = "SELECT `Move_in`, COUNT(`ID`) AS Total FROM `Tenancy` GROUP BY Move_in";
$result = mysqli_query($GLOBALS['conn'], $query);
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}
echo json_encode($data);
// if (isset($_POST['action'])) {
//     if ($_POST["action"] == 'fetch') {
        
        // $data = array();
        // while ($row = mysqli_fetch_array($result)) {
        //     $data[] = array(
        //         'date' => $row['Move_in'],
        //         'total' => $row['Total'],
        //         'color' => '#' . rand(100000, 999999) . '',
        //     );
        // }
        // foreach ($result as $row) {
        //     $data[] = array(
        //         'date' => $row['Move_in'],
        //         'total' => $row['Total'],
        //         'color' => '#' . rand(100000, 999999) . '',
        //     );
        // }

    // }
// }

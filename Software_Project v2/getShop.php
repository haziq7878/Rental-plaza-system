<?php
// $q = $_GET['input_text'];
// include 'func_software.php';
// if ($q != "") {
//   $sql = "SELECT * FROM `Shop` where `Name` like '" . $q . "%'";
// } else {
//   $sql = "SELECT * FROM `Shop`";
// }
// $result = mysqli_query($conn, $sql);
// $worker_array = array();
// $output = "";
// while ($row = mysqli_fetch_array($result)) {
//   $output .= "<tr><td>{$row['ShopID']}</td><td>{$row['Name']}</td><td>{$row['Owner']}</td>";
//   if ($row['Status'] == "vacant") {
//     $output .= "<td id='status_c'> {$row['Status']}</td>";
//   } else {
//     $output .= "<td  id='status_o'> {$row['Status']}</td>";
//   }
//   $output.="<td><a href='addShop.php?func=edit&id={$row['ShopID']}'>Edit</a></td>
//     <td><a href='registerShop.php?func=delete&id={$row['ShopID']}'>Delete</a></td></tr>";
// }
// echo $output;
// mysqli_close($conn);

include 'func_software.php';
$query="SELECT * FROM `Shop`";
if(isset($_GET["search"]["value"]))
{
 $query .= '
 WHERE Name LIKE "%'.$_GET["search"]["value"].'%"';
}
if(!isset($_GET["order"]))
{
  $query .= 'ORDER BY Name ASC ';
}
$query1 = '';

if($_GET['length'] != -1)
{
 $query1 = 'LIMIT ' . $_GET['start'] . ', ' . $_GET['length'];
}
$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);

$data = array();
$count=1;
while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<tr><td>'.$count.'</td>';
 $sub_array[] = '<td>'.$row['Name'].'</td>';
 $sub_array[] = '<td>'.$row['Owner'].'</td>';
 if ($row['Status'] == "vacant") {
      $sub_array[] .= "<td><p style='color:red'>{$row['Status']}</p></td>";
    } else {
      $sub_array[] .= "<td><p style='color:green'>{$row['Status']}</p></td>";
    }
 $sub_array[] = "<td><a href='addShop.php?func=edit&id={$row['ShopID']}'>Edit</a></td>";
 $sub_array[] = "<td><a href='registerShop.php?func=delete&id={$row['ShopID']}'>Delete</a></td></tr>";
 $data[] = $sub_array;
 $count+=1;
}
function get_all_data($connect)
{
 $query = "SELECT * FROM `Shop`";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_GET["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

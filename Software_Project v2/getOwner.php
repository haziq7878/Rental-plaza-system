<?php
// $q = $_GET['input_text'];
include 'func_software.php';
// if ($q!=""){
// $sql="SELECT * FROM `owner` where `Name` like '".$q."%'";
// }else{
//   $sql="SELECT * FROM `owner`";
// }
// $result = mysqli_query($conn,$sql);
// $worker_array = array();
// $output="";
// while($row = mysqli_fetch_array($result)) {
//     $output .= "<tr><td>{$row['ID']}</td><td>{$row['Name']}</td><td>{$row['Email']}</td>
//     <td><a href='addOwner.php?func=edit&id={$row['ID']}'>Edit</a></td>
//     <td><a href='registerOwner.php?func=delete&id={$row['ID']}'>Delete</a></td></tr>";
//   }
//   echo $output;
//   mysqli_close($conn);

$query="SELECT * FROM `owner`";
$columns = array('No','Name','Email');
if(isset($_GET["search"]["value"]))
{
 $query .= '
 WHERE Name LIKE "%'.$_GET["search"]["value"].'%"';
}
if(isset($_GET["order"]))
{
 $query .= 'ORDER BY '.$columns[$_GET['order']['0']['column']].' '.$_GET['order']['0']['dir'].'';
}
else
{
 $query .= 'ORDER BY id DESC ';
}
$query1 = '';

if($_GET["length"] != -1)
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
 $sub_array[] = '<td>'.$row['Email'].'</td>';
 $sub_array[] = "<td><a href='addOwner.php?func=edit&id={$row['ID']}'>Edit</a></td>";
 $sub_array[] = "<td><a href='registerOwner.php?func=delete&id={$row['ID']}'>Delete</a></td></tr>";
 $data[] = $sub_array;
 $count+=1;
}
function get_all_data($connect)
{
 $query = "SELECT * FROM `owner`";
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
?>
<?php
$q = $_GET['input_text'];
include 'func_software.php';
if ($q!=""){
$sql="SELECT * FROM `Tenancy` where `Name` like '".$q."%'";
}else{
  $sql="SELECT * FROM `Tenancy`";
}
$result = mysqli_query($conn,$sql);
$worker_array = array();
$output="";
while($row = mysqli_fetch_array($result)) {
    $output .= "<tr><td>{$row['ID']}</td><td>{$row['Name']}</td><td>{$row['Shop']}</td><td>{$row['Move_in']}</td><td>{$row['Rent']}</td>
    <td><a href='addTenancy.php?func=edit&id={$row['ID']}&pre={$row['Shop']}'>Edit</a></td>
    <td><a href='registerTenancy.php?func=delete&id={$row['ID']}&pre={$row['Shop']}'>Delete</a></td></tr>";
  }
  echo $output;
  mysqli_close($conn);

 
?>
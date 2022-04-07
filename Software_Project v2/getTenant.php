<?php
$q = $_GET['input_text'];
include 'func_software.php';
if ($q!=""){
$sql="SELECT * FROM `Tenant` where `Name` like '".$q."%'";
}else{
  $sql="SELECT * FROM `Tenant`";
}
$result = mysqli_query($conn,$sql);
$worker_array = array();
$output="";
while($row = mysqli_fetch_array($result)) {
    $output .= "<tr><td>{$row['ID']}</td><td>{$row['Name']}</td><td>{$row['CompanyName']}</td><td>{$row['Email']}</td><td>{$row['Mobile']}</td><td>{$row['CNIC']}</td>
    <td><a href='addTenant.php?func=edit&id={$row['ID']}'>Edit</a></td>
    <td><a href='registerTenant.php?func=delete&id={$row['ID']}'>Delete</a></td></tr>";
  }
  echo $output;
  mysqli_close($conn);

 
?>
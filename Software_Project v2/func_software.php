<?php
include 'database.php';
//Owner functions
function isRegistered($email,$id="")
{
    $sql = "SELECT * FROM `owner` where Email = '$email' ";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    if ($result->num_rows > 0) {
        if($id!="" and $id==$row['ID']){
            return false;
        }
        return true;
    } else {
        return false;
    }
}


function adduser($name,$email,$password)
{
    $sql = "INSERT INTO `owner` (`Name`,`Email`,`Password`) VALUES('$name','$email','$password')";
    $insert = mysqli_query($GLOBALS['conn'], $sql);
    return $insert;
}

function authUser($email, $password)
{
    if (isRegistered($email)) {
        $sql = "SELECT * FROM `owner` where `Email`= '$email' and `Password`='$password'";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        $row = mysqli_fetch_assoc($result);
        if ($result->num_rows == 1) {
            $_SESSION['user'] = $row[`Name`];
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function giveUser($email, $password)
{
    $sql = "SELECT * FROM `owner` where `Email`= '$email' and `Password`='$password'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    if ($result->num_rows == 1) {
        return $row['Name'];
    } else {
        return "nothing";
    }
}
function getOwnerInfo($ID){
    $sql = "SELECT * FROM `owner` where `ID`= $ID";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    if ($result->num_rows == 1) {
        return $row;
    } else {
        return "";
    }
}
function updateuser($name, $email, $password,$id){
    $sql = "UPDATE `owner` SET `Name`='$name',`Email`='$email',`Password`='$password' WHERE `ID`= '$id'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function DeleteOwner($ID){
    $sql = "DELETE FROM `owner` WHERE `ID`='$ID'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function ResetOwnerID(){
    $sql = "set @autoid :=0;";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $sql1 = "update `owner` set ID = @autoid := (@autoid+1);";
    $result1 = mysqli_query($GLOBALS['conn'], $sql1);
    $sql2="alter table owner Auto_Increment = 1";
    $result2 = mysqli_query($GLOBALS['conn'], $sql2);
    var_dump($result);
    return $result;
}
//Shop functions
function isShop($name)
{
    $sql = "SELECT * FROM `Shop` where `Name` = '$name' ";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
function addshop($name,$owner,$status)
{
    $sql = "INSERT INTO `Shop` (`Name`,`Owner`,`Status`) VALUES('$name','$owner','$status')";
    $insert = mysqli_query($GLOBALS['conn'], $sql);
    var_dump($sql);
    return $insert;
}

function updateShop($name,$owner,$status,$id){
    $sql = "UPDATE `Shop` SET `Name`='$name',`Owner`='$owner',`Status`='$status' WHERE `ShopID`= '$id'";
    $result = mysqli_query($GLOBALS['conn'], $sql);

    return $result;
}

function getShopInfo($ID){
    $sql = "SELECT * FROM `Shop` where `ShopID`= $ID";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    if ($result->num_rows == 1) {
        return $row;
    } else {
        return "";
    }
}
function DeleteShop($ID){
    $sql = "DELETE FROM `Shop` WHERE `ShopID`='$ID'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function ResetShopID(){
    $sql = "set @autoid :=0;";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $sql1 = "update `Shop` set ShopID = @autoid := (@autoid+1);";
    $result1 = mysqli_query($GLOBALS['conn'], $sql1);
    $sql2="alter table Shop Auto_Increment = 1";
    $result2 = mysqli_query($GLOBALS['conn'], $sql2);
    var_dump($result);
    return $result;
}
// Tenant function
function isTenant($email,$cnic)
{
    $sql = "SELECT * FROM `Tenant` where `Email` = '$email' ";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    if ($result->num_rows > 1) {
        if($row['CNIC']==$cnic){
            return false;
        }
        return true;
    } else {
        return false;
    }
}
function addtenant($name,$company_name,$email,$mobile,$cnic)
{
    $sql = "INSERT INTO `Tenant` (`Name`,`CompanyName`,`Email`,`Mobile`,`CNIC`) VALUES('$name','$company_name','$email','$mobile',$cnic)";
    $insert = mysqli_query($GLOBALS['conn'], $sql);
    var_dump($sql);
    return $insert;
}

function updatetenant($name,$company_name,$email,$mobile,$cnic,$id){
    $sql = "UPDATE `Tenant` SET `Name`='$name',`CompanyName`='$company_name',`Email`='$email',`Mobile`='$mobile',`CNIC`='$cnic' WHERE `ID`= '$id'";
    $result = mysqli_query($GLOBALS['conn'], $sql);

    return $result;
}
function getTenantInfo($ID){
    $sql = "SELECT * FROM `Tenant` where `ID`= $ID";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    if ($result->num_rows == 1) {
        return $row;
    } else {
        return "";
    }
}
function DeleteTenant($ID){
    $sql = "DELETE FROM `Tenant` WHERE `ID`='$ID'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function ResetTenantID(){
    $sql = "set @autoid :=0;";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $sql1 = "update `Tenant` set ID = @autoid := (@autoid+1);";
    $result1 = mysqli_query($GLOBALS['conn'], $sql1);
    $sql2="alter table Tenant Auto_Increment = 1";
    $result2 = mysqli_query($GLOBALS['conn'], $sql2);
    return $result;
}
function isTenancy($shop)
{
    $sql = "SELECT * FROM `Tenancy` where `Shop` = '$shop' ";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    if ($result->num_rows > 1) {
        return true;
    } else {
        return false;
    }
}
function addtenancy($name,$shop,$move_in,$rent)
{
    $sql = "INSERT INTO `Tenancy` (`Name`,`Shop`,`Move_in`,`Rent`) VALUES('$name','$shop','$move_in','$rent')";
    $insert = mysqli_query($GLOBALS['conn'], $sql);
    return $insert;
}

function updatetenancy($name,$shop,$move_in,$rent,$id){
    $sql = "UPDATE `Tenancy` SET `Name`='$name',`Shop`='$shop',`Move_in`='$move_in',`Rent`='$rent' WHERE `ID`= '$id'";
    $result = mysqli_query($GLOBALS['conn'], $sql);

    return $result;
}
function getTenancyInfo($ID){
    $sql = "SELECT * FROM `Tenancy` where `ID`= $ID";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    if ($result->num_rows == 1) {
        return $row;
    } else {
        return "";
    }
}
function DeleteTenancy($ID,$shop){
    var_dump($shop);
    $sql = "DELETE FROM `Tenancy` WHERE `ID`='$ID'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    statuschangev($shop);
    return $result;
}
function ResetTenancyID(){
    $sql = "set @autoid :=0;";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $sql1 = "update `Tenancy` set ID = @autoid := (@autoid+1);";
    $result1 = mysqli_query($GLOBALS['conn'], $sql1);
    $sql2="alter table Tenancy Auto_Increment = 1";
    $result2 = mysqli_query($GLOBALS['conn'], $sql2);
    var_dump($result);
    return $result;
}
function statuschangeo($shop){
    $sql = "UPDATE `Shop` SET `Status`='occupied' WHERE `Name`= '$shop'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function statuschangev($preshop){
    $sql = "UPDATE `Shop` SET `Status`='vacant' WHERE `Name`= '$preshop'";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    return $result;
}
function countShops(){
    $sql = "SELECT Count(`ShopID`) AS shopcount from `Shop`";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    return $row["shopcount"];
}
function countTenant(){
    $sql = "SELECT Count(`ID`) AS tenantcount from `Tenant`";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_assoc($result);
    return $row["tenantcount"];
}

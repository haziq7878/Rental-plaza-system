<?php
include 'func_software.php';
$func = $_GET['func'];
if ($func == 'add') {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $company_name = $_POST['company_name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $cnic = $_POST['CNIC'];
        if (!isTenant($email,$cnic)) {
            if (addtenant($name,$company_name,$email,$mobile,$cnic)) {
                header("location:Tenant.php");
            }
        } else {
            header("location:addTenant.php?func=add");
        }
    }
} elseif ($func == 'edit') {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $company_name = $_POST['company_name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $cnic = $_POST['CNIC'];
        $id = $_GET['id'];
        if (!isTenant($email,$cnic)) {
                if (updatetenant($name,$company_name,$email,$mobile,$cnic,$id)) {
                    header("location:Tenant.php");
                }
        } else {
            header("location:addTenant.php?func=edit&id=".$id);
        }
    }
} elseif ($func == 'delete') {
    DeleteTenant($_GET['id']);
    ResetTenantID();
    header("location:Tenant.php");
}

<?php
include 'func_software.php';
$func = $_GET['func'];
if ($func == 'add') {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['pswd'];
        $cpass = $_POST['cpwd'];
        if (!isRegistered($email)) {
            if ($password == $cpass) {
                if (adduser($name, $email, $password)) {
                    header("location:owner.php");
                }
            } else {
                header("location:addOwner.php?func=add");
            }
        } else {
            header("location:addOwner.php?func=add");
        }
    }
} elseif ($func == 'edit') {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['pswd'];
        $cpass = $_POST['cpwd'];
        $id = $_GET['id'];
        if (!isRegistered($email,$id)) {
            if ($password == $cpass) {
                if (updateuser($name, $email, $password,$id)) {

                    header("location:owner.php");
                }
            } else {
                header("location:addOwner.php?func=edit&id=".$id);
            }
        } else {
            header("location:addOwner.php?func=edit&id=".$id);
        }
    }
}elseif ($func == 'delete'){
    DeleteOwner($_GET['id']);
    ResetOwnerID();
    header("location:owner.php");
}


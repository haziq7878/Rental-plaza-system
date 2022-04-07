<?php
include 'func_software.php';
$func = $_GET['func'];
if ($func == 'add') {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $owner = $_POST['owner'];
        $status = "vacant";
        if (!isShop($name)) {
            if (addshop($name, $owner, $status)) {
                header("location:shop.php");
            }
        } else {
            header("location:addShop.php?func=add");
        }
    }
} elseif ($func == 'edit') {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $owner = $_POST['owner'];
        $status = "vacant";
        $id = $_GET['id'];
        if (!isShop($name)) {
                if (updateShop($name, $owner, $status,$id)) {
                    header("location:shop.php");
                }
        } else {
            header("location:addShop.php?func=edit&id=".$id);
        }
    }
} elseif ($func == 'delete') {
    DeleteShop($_GET['id']);
    ResetShopID();
    header("location:shop.php");
}

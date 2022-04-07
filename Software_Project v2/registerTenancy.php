<?php
include 'func_software.php';
$func = $_GET['func'];
if ($func == 'add') {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $shop = $_POST['shop'];
        $move_in = $_POST['move_in'];
        $rent = $_POST['rent'];
        if (!isTenancy($shop)) {
            if (addtenancy($name, $shop, $move_in, $rent)) {
                statuschangeo($shop);
                header("location:Tenancy.php");
            }
        } else {
            header("location:addTenancy.php?func=add");
        }
    }
} elseif ($func == 'edit') {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $shop = $_POST['shop'];
        $move_in = $_POST['move_in'];
        $rent = $_POST['rent'];
        $id = $_GET['id'];
        $preshop = $_GET['pre'];
        if (!isTenancy($shop)) {
            if (updatetenancy($name, $shop, $move_in, $rent, $id)) {
                statuschangeo($shop);
                if ($shop != $preshop) {
                    statuschangev($preshop);
                }
                header("location:Tenancy.php");
            }
        } else {
            header("location:addTenancy.php?func=edit&id=" . $id . "&pre=" . $preshop);
        }
    }
} elseif ($func == 'delete') {

    DeleteTenancy($_GET['id'],$_GET['pre']);
    ResetTenancyID();
    header("location:Tenancy.php");
}

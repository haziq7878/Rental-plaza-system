<?php
    include 'func_software.php';
    if ($_SERVER['REQUEST_METHOD']=="POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(authUser($email,$password)){
            $_SESSION['userName']=giveUser($email,$password);
            header('location:./home.php?msg = welcome');
        }
        else{
            $_SESSION['emailErr'] = "Email does not match";
            $_SESSION['passwordErr'] = "password does not match";
            header('location:./login.php?msg=failed');
        }
    }
?>
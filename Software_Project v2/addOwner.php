<!doctype html>
<html lang="en">

<head>
    <title>page_layout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/Software_Project/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="/Software_Project/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="softstyle.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="/Software_Project/jquery-3.6.0.min.js"></script>
    <script src="toggle.js"></script>
    <title>Nazir Trade center</title>
</head>

<body>
    <?php
    include 'func_software.php';
    if (!isset($_SESSION['userName'])) {
        header('location:./login.php?msg=cant');
    }
    if (isset($_GET['id'])) {
        $vname = $vemail = $vpassword = $vcpassword = "";
        $array = getOwnerInfo($_GET['id']);
        $vname = $array['Name'];
        $vemail = $array['Email'];
        $vpassword = $array['Password'];
        $vcpassword = $array['Password'];
    } else {
        $vname = $vemail = $vpassword = $vcpassword = "";
    }
    ?>
    <nav class="navbar navbar-dark navbar-expand-sm d-flex flex-column align-item-start bg-black" id="side_nav">
        <a class="navbar-brand text-light">
            <div class='font-weight-bold text-light'>Nazir trade Center</div>
        </a>
        <ul class="nav flex-column bg-black mb-0" style="width: 100%;">
            <p class="font-weight-bold text-uppercase px-3 small pt-4 mb-0 text-light" style="font-size: 1.25rem;">Dashboard</p>
            <!-- <h1 class="text-gray font-weight-bold text-uppercase px-3 py-24 small pb-4 mb-0 text-light">Dashboard</h1> -->
            <hr style="color: white;height:3px">
            <li class="nav-item">
                <a href="home.php" class="nav-link text-light font-italic">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="owner.php" class="nav-link text-light font-italic">
                    Owner
                </a>
            </li>
            <li class="nav-item">
                <a href="Shop.php" class="nav-link text-light font-italic">
                    Shops
                </a>
            </li>
            <li class="nav-item">
                <a href="Tenant.php" class="nav-link text-light font-italic">
                    Tenant
                </a>
            </li>
            <li class="nav-item">
                <a href="tenancy.php" class="nav-link text-light font-italic">
                    Tenancy
                </a>
            </li>
        </ul>
    </nav>
    </div>
    <section class="p4 my_container">
        <button class="btn my-4" id="menu-btn"><span class="navbar-toggler-icon">
                <i class="fas fa-bars" style="color:black; font-size:28px;"></i>
            </span></button>
        <div class="btn-group" style="float: right;padding-top:18px">
            <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="imageDropdown" style="float:right">
                <img src="avatar.jpeg" alt="Avatar" style="border-radius:50%;width:50px;height:50px;">
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="imageDropdown">
                <li><a class="dropdown-item" href="log_out_soft.php" style="color: black;">log out</a></li>
            </ul>
        </div>
        <div class="container" id="owner">
            <div class="row justify-content-center shadow p-3 mb-5 bg-white rounded" style="border: 1px solid;border-style:groove">
                <div class="col-mg-6">
                    <h1>Add owner</h1>
                    <form action="registerOwner.php?func=<?php echo $_GET['func']; ?><?php if (isset($_GET['id'])) {
                                                                                        echo '&id=' . $_GET['id'];
                                                                                    } ?>" method="POST">
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $vname ?>" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $vemail ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" value="<?php echo $vpassword ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpwd" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" id="cpwd" placeholder="Confirm password" name="cpwd" value="<?php echo $vcpassword ?>" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
                        </div>
                    </form>

                </div>
    </section>
    <script>
        var menu_btn = document.querySelector('#menu-btn');
        var sidebar = document.querySelector('#side_nav')
        var container = document.querySelector('.my_container')
        menu_btn.addEventListener("click", () => {
            sidebar.classList.toggle("active-nav")
            container.classList.toggle("active-cont")
        })
    </script>
</body>

</html>
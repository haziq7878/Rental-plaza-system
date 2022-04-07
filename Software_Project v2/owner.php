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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <title>Nazir Trade center</title>
</head>

<body>
    <?php
    include 'func_software.php';
    if (!isset($_SESSION['userName'])) {
        header('location:./login.php?msg=cant');
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
            <div class="container" style="margin-top: 50px;margin-bottom:20px;width: 100%">
                <form>
                    <a href="addOwner.php?func=add" type="submit" class="btn btn-primary btn-sm">Add new Owner</a>
                    <!-- <div class="input-group" style="float:right;width:20%">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input class="form-control mr-sm-2" id="search_bar" type="search" placeholder="Search" aria-label="Search">
                    </div> -->
                </form>
            </div>
            <table id="owner_table" class="table table-striped table-light table-bordered" style="width: 100%;">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <td scope="col">Edit</td>
                        <td scope="col">Delete</td>
                    </tr>
                </thead>
            </table>
        </div>
        <script>
            $(document).ready(function() {

                fetch_data();

                function fetch_data() {
                    var dataTable = $('#owner_table').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": {
                            url: "getOwner.php",
                            type: "GET"
                        },
                        "ordering": false,
                    });
                }
                //Old version search
                // $('#search_bar').trigger('change');
            })
            // $('#search_bar').on('change', function() {
            //     var input_text = $(this).val()
            //     $.ajax({
            //         type: 'get',
            //         url: 'getOwner.php',
            //         data: {
            //             input_text: input_text
            //         },
            //         success: function(response) {
            //             $('#owner_table').html(response)
            //         }
            //     })
            // })
        </script>
    </section>
    <script>
        var menu_btn = document.querySelector('#menu-btn');
        var sidebar = document.querySelector('#side_nav')
        var container = document.querySelector('.my_container')
        menu_btn.addEventListener("click", () => {
            sidebar.classList.toggle("active-nav")
            container.classList.toggle("active-cont")
        })
        // $('#addOwner').on("click",function(){
        //     window.location.href='Software_Project/addOwner.php';
        // })
    </script>
</body>

</html>
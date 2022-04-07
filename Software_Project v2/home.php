<!doctype html>
<html lang="en">

<head>
    <title>page_layout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/Software_Project/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="softstyle.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
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
            <p id="Heading_nav">Nazir trade Center</p>
        </a>
        <ul class="nav bg-black mb-0" style="width: 100%;">
            <p class="font-weight-bold text-uppercase px-3 small pt-4 mb-0 text-light" id="Heading_base" style="font-size: 1.25rem;">Dashboard</p>
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
        <div class="container-fluid">
            <div class='container' style="width:auto;border:1px;height:100%">
                <div class='row'>
                    <div class="col-md-6" id="first_col">
                        <div class="justify-content-center" style="width: 50%;border:1px solid">
                            <p class="text-center">Number of shops</p>
                            <hr>
                            <p class="text-center" style="transition: 1s;"> <b> <?php echo $count_shop = countShops(); ?></b></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="justify-content-center" style="width: 50%;border:1px solid">
                            <p class="text-center">Number of Tenants</p>
                            <hr>
                            <p class="text-center"><?php echo $count_shop = countTenant(); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='container-fluid'>
            <div class="row">
                <div class="col-md-6">
                    <div class='card mt-4'>
                        <div class="card-header">Bar chart</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="bar_chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class='card mt-4'>
                        <div class="card-header">Pie chart</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="pie_chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="/Software_Project/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/Software_Project/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/js/Chart.min.js"></script>
    <script src="toggle.js"></script>
    <script>
        var menu_btn = document.querySelector('#menu-btn');
        var sidebar = document.querySelector('#side_nav')
        var container = document.querySelector('.my_container')
        menu_btn.addEventListener("click", () => {
            sidebar.classList.toggle("active-nav")
            container.classList.toggle("active-cont")
        })
    </script>

    <script>
        $(document).ready(function() {
            makechart();
        })

        function makechart() {
            $.post("chart.php",
                function(data) {
                    var date = [];
                    var tenants = [];
                    var color = []

                    for (var i in data) {
                        date.push(data[i].Move_in);
                        tenants.push(data[i].Total);
                        color.push("#" + (Math.floor(Math.random() * 999999) + 1).toString())
                    }

                    var chartdata = {
                        labels: date,
                        datasets: [{
                            label: 'Tenants by date',
                            backgroundColor: color,
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: tenants
                        }]
                    };

                    var graphTarget = $("#bar_chart");

                    var option = {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0
                                }
                            }]
                        }
                    };

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: option
                    });

                    var graphTarget1 = $("#pie_chart");

                    var barGraph = new Chart(graphTarget1, {
                        type: 'pie',
                        data: chartdata
                    });
                });
            // $.ajax({
            //     url: "chart.php",
            //     method: "POST",
            //     data: {
            //         action: 'fetch'
            //     },
            //     dataType: "JSON",
            //     success: function(data) {

            //         console.log(data)
            //         var date = [];
            //         var total = [];
            //         var color = [];
            //         for (var count = 0; count < data.length; count++) {
            //             date.push(data[count].date);
            //             total.push(data[count].total);
            //             color.push(data[count].color);
            //         }
            //         var chart_data = {
            //             labels: date,
            //             datasets: [{
            //                 label: 'Tenants',
            //                 backgroundColor: color,
            //                 color: '#fff',
            //                 data: total
            //             }]
            //         };

            //         var options = {
            //             responsive: true,
            //             scales: {
            //                 yAxes: [{
            //                     ticks: {
            //                         min: 0
            //                     }
            //                 }]
            //             }
            //         };

            //         var chart1 = $('#bar_chart');
            //         var graph1 = new Chart(chart1, {
            //             type: 'bar',
            //             datasets: chart_data,
            //             options: options,
            //         })

            //         var chart2 = $('#pie_chart');
            //         var graph1 = new Chart(chart2, {
            //             type: 'pie',
            //             datasets: chart_data,
            //         })
            //     }
            // })
        }
    </script>
</body>

</html>
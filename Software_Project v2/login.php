<!DOCTYPE html>
<htmln lang="en">

  <head>
    <title>page_layout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/Software_Project/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="/Software_Project/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <script src="/Software_Project/jquery-3.6.0.min.js"></script>
    <script>
      function showUser(str) {
        if (str == "") {
          document.getElementById("error").innerHTML = "";
          return;
        } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("error").innerHTML = this.responseText;
            }
          };
          xmlhttp.open("POST", "getError.php?q=" + str, true);
          xmlhttp.send();
        }
      }
    </script>
  </head>

  <body style="background-color:#F5F5F5">
    <?php
    session_start();
    $emailErr = $passwordErr =  "";
    $email = $password =  "";
    if (isset($_SESSION['emailErr']) and isset($_SESSION['passwordErr'])) {
      $emailErr = $_SESSION['emailErr'];
      $passwordErr = $_SESSION['passwordErr'];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["password"])) {
        $passwordErr = "*password is required";
      } else {
        $password = test_input($_POST["password"]);
      }

      if (empty($_POST["email"])) {
        $emailErr = "*Email is required";
      } else {
        $email = test_input($_POST["email"]);
      }
    }
    ?>
    <div class="container" style="margin: 200px 100px;">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1 style="color: blue;"> Nazir Trade Center</h1>
            <p>Best shops and halls with affordable rent</p>
          </div>
          <div class="col-sm-6">
            <div class="container-fluid" style="width: 90%">
              <div class="row p-3 bg-white" style="border: 1px solid;border-style:groove;border-radius:10px; width:400px;height:auto">
                <div class="col-sm-6" style="width: 100%;padding-left:0px;padding-right:0px">
                  <div class="container text-center">
                    <h1>Login</h1>
                  </div>
                  <form method="post" action="login_conf.php">
                    <div class="container" style="padding: 5px 0px;height:auto;margin:5px 0px">
                      <input id='email' type="email" class="form-control" id="email" placeholder="Enter email" name="email" onchange="vdUser(this.value)" required>
                      <span id="error_email" style="color: red"><?php echo $emailErr ?></span>
                    </div>
                    <div class="container" style="padding: 5px 0px;height:50%;margin:5px 0px">
                      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" onchange="vdpUser(this.value)" required>
                      <span id="error_password" style="color: red;"><?php echo $passwordErr ?></span>
                    </div>
                    <div class="form-check mb-3">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember"> Remember me
                      </label>
                    </div>
                    <div class="container" style="padding: 3px 0px;margin:5px 0px">
                      <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;padding:0px 16px">Login</button>
                    </div>
                  </form>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar fixed-bottom justify-content-center">
      <footer class="page-footer font-small">
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
          <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
        </div>
      </footer>
    </div>
  </body>
</htmln>
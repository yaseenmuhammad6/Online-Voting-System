<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="icon" href="Images/logo.png">
    <title>ONLINE VOTING SYSTEM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/csslogin.css">
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <script type="text/javascript" src="js/code.js"></script><script type="text/javascript" src="js/code1.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
      <center>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3">
          <img src="Images/logo.png" height="100px" width="100px">
        </div>
          <div class="col-sm-7"><span style="font-size: 42px;"><b>ONLINE VOTING SYSTEM</span>
            <br> FYP
            <br> <?php echo date("l,M,d.Y");?></b> </div>
            <div class="col-sm-2">
            <div class="shadow p-3 mb-5 bg-white rounded"><a href="result.php?result=1"><img src="Images\results.png" alt="RESULT" width="100px" height="100px"></a>
              <br>FOR LATEST RESULT CLICK HERE</div>
            </div>
        </div></div>
      </center>
      <div class="cen">
        <form name="form1" action="login.php?q=0" method="POST">
          <h1>LOGIN HERE</h1>
          <p>Enter the UserName and Password Provided</p>
          <label for="floatingInputValue">UserName</label>
          <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
          </div>
            <input type="text" class="form-control" name="uname" id="floatingInputValue" placeholder="User Name" required>
            </div>
            <label for="floatingInputValue">Password</label><br>
            <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">🔒</span>
          </div>
            <input type="password" class="form-control" name="pin" id="floatingInputValue" placeholder="Password" required>
            </div>
            
            <center><input type="submit" value=" LOGIN " class="btn btn-success"></span></center>
          </form></div>

          <div class="footer" style="float: right;">
            <center>FYP CREATED BY SAFEER & FAWAD</center>
            </div>
    </body>
    </html>
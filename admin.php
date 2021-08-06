<!DOCTYPE html>
<html>
    <head><title>OVS Admin</title>
        <link rel="icon" href="Images/logo.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/css1.css">
        <script src="js/js1.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/province-city.js"></script>
        
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    </head>
    <body>
    
        <!-- PHP STARTS HERE -->
        <?php
        
        session_start();
   if ( !isset($_SESSION['username']))
   {
     header('Location: index.php');
   }
   
   $user=$_SESSION['username'];
   include_once 'dbConnection.php';
        include_once 'code.php';
        include_once 'php/addvoter.php';
   $result001 = mysqli_query($con,"SELECT * FROM `admin` WHERE `adminid`='$user'") or die('Error');
   while($row001 = mysqli_fetch_array($result001)) {
    $adminrole=$row001['role'];
   }
   if ($adminrole=="admin") {
     //echo "true";
   } else {
    header('Location: login.php?q=1');
   }
   ?>
   <script>
              function addvoter() {
                document.getElementById("main").innerHTML=`<?php echo addvoter();?>`;
              }
          </script>
        <!--HEADER MENU-->
        <div class="container-fluid">
            <div class="row" style="background-color: rgb(248, 249, 250);">
                <div class="col-2"><img src="Images/logo.png" alt="logo" style="width:50px;"></div>
                    <div class="col-5"> <center>WELCOME<br><h4><?php echo $user;?></h4></center></div>
                <div class="col-5"><nav class="navbar navbar-expand-sm bg-light navbar-light">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link" href="javascript:addvoter()">ADD VOTER</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="javascript:addcandidate()">ADD CANDIDATE</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="javascript:addnotifcation()">ADD NOTIFICATION</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="login.php?q=1">LOGOUT</a>
                      </li>
                    </ul>
                  </nav></div>
              </div><!--END OF ROW-->
          </div> <!--END OF CONTAINER FLUID-->
          <!---HEADER-->
          <div class="container-fluid">
          <div class="row" id="header">
            <div class="col-1" style="color: white;background-color:#00A651;"></div>
            <div class="col-6" style="color: white;background-color:#00A651;"><center><span class="display-6">ONLINE VOTING SYSTEM</span><br>
                
            </center></div>
            <div class="col-5" style="color: white;background-color:#00A651;">
            <h1 class="display-6">FREE &emsp; FAIR &emsp; IMPARTIAL</h1>
            </div>    
          </div></div><br>
          <!--END OF TITTLE-->
          <center><div class="container-fluid">
              <?php 
              if (isset($_COOKIE["adminnotification"])) {
                echo '<div class="alert alert-success" role="alert">'.$_COOKIE["adminnotification"].'</div>';
              }
              ?>
          <!-- START OF MAIN  -->
            <div id="main">
                <br><br>
            <center><h1 class="display-1" style="color: #EAECEE;user-select: none;">
                  ADMIN DASHBOARD
                </h1></center>
            </div>
        
        <!--FOOTER STATRTS HERE-->
        <div class="footer" style="float: right;">
        <div class="container-fluid">
          <div class="row" style="font-size: 10px;color: white;background-color:#00A651;">
            <div class="col-6" style="text-align: start;"><b><span style="">ONLINE VOTING SYSTEM</span></b></div>
            <div class="col-6" style="text-align: end;" ><?php echo date("l,M,d.Y");?><span id="time"></span></div>
            </div>
               </div>
    </body>
</html>
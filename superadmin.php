<!DOCTYPE html>
<html>
    <head><title>OVS Super Admin</title>
        <link rel="icon" href="Images/logo.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/css1.css">
        <script src="js/js1.js"></script>
        <script src="js/super.js"></script>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <?php
   session_start();
   if ( !isset($_SESSION['username']))
   {
     header('Location: index.php');
   }
  include_once 'dbConnection.php';
  include_once 'code.php';
  $user=$_SESSION['username'];
  ?>
  <script>
    function manageconsituiency(){
      document.getElementById("main").innerHTML=`<?php echo ManageConsitiency($con);?>`;
    }
  </script>
    </head>
    <body>
        <!-- PHP STARTS HERE -->
        <?php
       
   $result001 = mysqli_query($con,"SELECT * FROM `admin` WHERE `adminid`='$user'") or die('Error');
   while($row001 = mysqli_fetch_array($result001)) {
    $adminrole=$row001['role'];
   }
   if ($adminrole=="superadmin") {
     //echo "true";
   } else {
    header('Location: login.php?q=1');
   }
   ?>
   <script>
     function symbols() {
      document.getElementById("main").innerHTML=`<?php echo symbols($con);?>`;
     }
     </script>
        <!--HEADER MENU-->
        <div class="container-fluid">
            <div class="row" style="background-color: rgb(248, 249, 250);">
                <div class="col-2"><img src="Images/logo.png" alt="logo" style="width:50px;"></div>
                <div class="col-5"><h1>ONLINE VOTING SYSTEM</h1></div>
                    <div class="col-2"> <center>WELCOME<br><h4><?php echo $user;?></h4></center></div>
                    <script>
                    function removeadmin() {
                      document.getElementById("main").innerHTML=`<?php echo removeadmin($con);?>`;
                    }
                    </script>
                    <div class="col-3"><nav class="navbar navbar-expand-sm bg-light navbar-light">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link" href="javascript:party()">Party</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="javascript:election()">Election</a>
                      </li>
                      <script>
                      function genrateresult() {
                        document.getElementById("main").innerHTML=` <?php echo GenrateResult($con);?>`;
                      }
                      </script>
                      <li class="nav-item">
                        <a class="nav-link" href="javascript:manageadmin()">Admin's</a>
                      </li>
                      
                      <li class="nav-item">
                        <a class="nav-link" href="login.php?q=1">Logout</a>
                      </li>
                    </ul> 
                  </nav></div>
              </div><!--END OF ROW-->
          </div> <!--END OF CONTAINER FLUID--><br>
          <!---HEADER-->
          
          <script>
              function updateparty() {
                document.getElementById("main").innerHTML=`<?php echo updateparty($con);?>`;
              }
          </script>

          <!--END OF TITTLE-->
          <!-- START OF MAIN  -->
          <center><div class="container-fluid">
              <?php 
              if (isset($_COOKIE["superadminnotification"])) {
                echo '<div class="alert alert-success" role="alert">'.$_COOKIE["superadminnotification"].'</div>';
              }
              ?>
            <div id="main">
                <br><br>
                <h1 class="display-1" style="color: #EAECEE;user-select: none;">
                 SUPER ADMIN DASHBOARD
                </h1>
            </div>
            
            </div>  </center>     
          
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
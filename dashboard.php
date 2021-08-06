<!DOCTYPE html>
<html>
    <head><title>OVS USER DASHBOARD</title>
        <link rel="icon" href="Images/logo.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/css1.css">
        <script src="js/js1.js"></script>
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
   date_default_timezone_set('Asia/Karachi');
   $user=$_SESSION['username'];
   include_once 'dbConnection.php';
   include_once 'code.php';
   $startdate="none";
   $enddate="none";
   $result = mysqli_query($con,"SELECT * FROM `voter` WHERE `voterid`='$user'") or die('Error');
   while($row = mysqli_fetch_array($result)) {
       $voterid=$row["voterid"];
        $votername=$row["votername"];
        $voterpin=$row["voterpin"];
        $province=$row["province"];
        $city=$row["city"];
        $na=$row["NA"];
        $ec=$row["electoralcollage"];
        $pc=$row["provincial-constituency"];
        $pic=$row["pic"];
   }
   $result = mysqli_query($con,"SELECT * FROM `election` WHERE `status`='active'") or die('Error');
   while($row = mysqli_fetch_array($result)) {
       $election = $row['name'];
       $type = $row['type'];
       $location=$row['location'];
       $status=$row['status'];
       $startdate=$row['startdate'];
       $starttime=$row['starttime'];
       $enddate=$row['enddate'];
       $endtime=$row['endtime'];
      }
   $todaydate=date("Y-m-d");
   $currenttime=date("H:i:s");
   

  //  $result1 = mysqli_query($con,"SELECT * FROM `candidate` WHERE `election`='$election' && `constituency`='$na'") or die('Error');
  //  while($row1 = mysqli_fetch_array($result1)) {
  //      echo "MIB";
  //  }
  if (isset($election)) {
    $query3 = mysqli_query($con,"SELECT * FROM `votes` WHERE `voter id`='$user' && 'election'='$election'");
    if ($query3==true) {
        while($row3 = mysqli_fetch_array($query3)) {
            echo "<script>alert('YOU ALREADY RECORDED YOUR VOTE AT ".$row3["castat"]."');</script>";
            header( "refresh:1;url=dashboard.php" );
            }
    }
  }
   
   ?>
   <div class="container-fluid">
   <div class="row" style="background-color: rgb(248, 249, 250);">
       <div class="col-2"><img src="Images/logo.png" alt="logo" style="width:50px;"></div>
       <div class="col-5"><h1>ONLINE VOTING SYSTEM</h1></div>
           <div class="col-3"> <center>WELCOME<br><h4><?php echo $user;?></h4></center></div>
       <div class="col-2"><nav class="navbar navbar-expand-sm bg-light navbar-light">
           <ul class="navbar-nav">
           
             <li class="nav-item">
               <a class="nav-link" href="about.html">About OVS</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="login.php?q=1">Logout</a>
             </li>
           </ul>
         </nav></div>
     </div><!--END OF ROW-->
 </div>
   <div class="container-fluid">
          <div class="row" id="header">
            <div class="col-3" style="color: white;background-color:#00A651;"></div>
            <div class="col-6" style="color: white;background-color:#00A651;"><center>
                <h1 class="display-6">VOTER DASHBOARD</h1>
            </center></div>
            <div class="col-3" style="color: white;background-color:#00A651;">
            </div>    
          </div></div>
          <div class="container-fluid">
           <b> <div class="row">
                <div class="col-2" style="background-color: white;color:#00A651;">NOTIFICAION:&emsp;&nbsp;<img src="Images/new.gif" height="36px" width="36px"></div>
                <div class="col-10" style="color: white;background-color:#00A651;"><marquee><?php 
        $query3 = mysqli_query($con,"SELECT * FROM `notification` WHERE 1") or die('Error 1');
        while($row3 = mysqli_fetch_array($query3)) {
            $notification = $row3['notification'];
            echo $notification;
            }
        ?></marquee></div>
            </div></b>
        </div><br>
        <div class="container-fluid" style="width: 50%;">
            <center>
                <table class="table">
                <tr>
                  <td><img src="<?php echo $pic;?>"  width="100px" height="100px"></td>
                  <td>VOTER ID: 
                <br>VOTER NAME: 
                <br>CONSTITUENCY: 
                </td>
                <td>
                <b><?php echo $voterid;?></b>
                <br><b><?php echo $votername;?></b>
                <br><b><?php echo $na."/".$pc;?></b>
                </td>
                </tr>
                <?php
                
                ?>
                </table>
            </center>
        </div>
   <div id="main">
   <center><!--TABLE-->
   <?php 
          
          if ($startdate==$todaydate && $starttime<$currenttime) {
            echo $currenttime;
            electionstart($con,$election,$na,$pc);
          }
          if ($enddate==$todaydate && $endtime>$currenttime) {
          echo '<script>document.getElementById("main").innerHTML= `<center> <h1 class="display-1" style="color: #EAECEE;user-select: none;">
          OVS USER DASHBOARD 
          </h1></center>`;</script> ';
  }
  $query3 = mysqli_query($con,"SELECT * FROM `votes` WHERE `voter id`='$user' && `constituency`='$na'|| `constituency`='$pc'");
  if ($query3==true) {
      while($row3 = mysqli_fetch_array($query3)) {
        echo '<script>document.getElementById("main").innerHTML= `<center> <h1 class="display-1" style="color: #EAECEE;user-select: none;">
        OVS USER DASHBOARD
        </h1></center>`;</script> ';
          }
  }
   ?>
    <h1 class="display-1" style="color: #EAECEE;user-select: none;">
                        OVS USER DASHBOARD
                        </h1></center>
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
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
    </head>
    <body>
        <!-- PHP STARTS HERE -->
        <?php
        session_start();
        if ( !isset($_SESSION['username']))
        {
          header('Location: index.php');
        }

   include_once 'dbConnection.php';
    include_once 'code.php';
   $user=$_SESSION['username'];
   $p=$_GET['p'];
   $result0 = mysqli_query($con,"SELECT * FROM `party` WHERE `partyid`='$p'") or die('Error');
        while($row0 = mysqli_fetch_array($result0)) {
            $partyid=$row0['partyid'];
            $partyname=$row0['name'];
            $partyleader=$row0['leader'];
            $founder = $row0['founder'];
            $leaderpostion=$row0['leaderposition'];
            $slogan=$row0['slogan'];

        }
   ?>
   <script>
   function superadmin() {
            var url= "superadmin.php"; 
            window.location = url; 
        
   }
   </script>
    <!--HEADER MENU-->
    <div class="container-fluid">
            <div class="row" style="background-color: rgb(248, 249, 250);">
                <div class="col-2"><a href="sueradmin.php"><img src="Images/logo.png" alt="logo" style="width:50px;"></a></div>
                <div class="col-5"><h1>ONLINE VOTING SYSTEM</h1></div>
                    <div class="col-2"> <center>WELCOME<br><h4><?php echo $user;?></h4></center></div>
                <div class="col-3"><nav class="navbar navbar-expand-sm bg-light navbar-light">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link" href="superadmin.php">SUPER ADMIN PAGE</a>
                      </li>
                      
                      <li class="nav-item">
                        <a class="nav-link" href="login.php?q=1">Logout</a>
                      </li>
                    </ul>
                  </nav></div>
              </div><!--END OF ROW-->
          </div> <!--END OF CONTAINER FLUID-->
            <!--FORM -->
            <center>
            <div class="container-fluid">
            
    <div class="shadow p-3 mb-5 bg-white rounded" style="width: 50%">
    <h5>UPDATE  PARTY </h5>
    <form action="update.php?u=0" method="POST" enctype="multipart/form-data">
    <input type="text" value="<?php echo $partyid;?>" hidden name="partyid">
  
    <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">POLTICAL PARTY  NAME</span></div>
            <input type="text" class="form-control" value="<?php echo $partyname;?>" name="partyname" id="floatingInputValue" placeholder="PARTY NAME" required></div>

            <div class="input-group mb-3">
            <input type="text" class="form-control" name="slogan" id="floatingInputValue" placeholder="MAIN SLOGAN" value="<?php echo $slogan;?>" required><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">MAIN SLOGAN</span></div></div>
            
            <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">FOUNDER NAME</span></div>
            <input type="text" class="form-control" name="founder" id="floatingInputValue" placeholder="FOUNDER NAME" required value="<?php echo $founder;?>" readonly></div>
            
            <div class="input-group mb-3">
            <input type="text" class="form-control" name="leader" id="floatingInputValue" placeholder="CURRENT LEADER" required value="<?php echo $partyleader;?>"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">CURRENT LEADER</span></div></div>

            <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">LEADER POSITION</span></div>
            <input type="text" class="form-control" name="leaderposition" id="floatingInputValue" placeholder="LEADER POSITION (President, Chairman, Convener e.t.c)" required value="<?php echo $leaderpostion;?>"></div>

            <input type="reset" value="RESET" class="btn btn-warning">
            <input type="submit" value="UPDATE" class="btn btn-success">
            
           
    </form>
    <button onclick="window.location.href = 'superadmin.php'" class="btn btn-danger">CANCEL</button>
    </div>
    </div>
    </div></center>
            <!--END FORM-->
   <!-- FOOTER -->
           <div class="footer" style="float: right;">
        <div class="container-fluid">
          <div class="row" style="font-size: 10px;color: white;background-color:#00A651;">
            <div class="col-6" style="text-align: start;"><b><span style="">ONLINE VOTING SYSTEM</span></b></div>
            <div class="col-6" style="text-align: end;" ><?php echo date("l,M,d.Y");?><span id="time"></span></div>
            </div>
               </div>
    </body>
</html>
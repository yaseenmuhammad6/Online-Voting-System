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
  include_once 'dbConnection.php';
  include_once 'php/ResultFunction.php';
   $resultget=$_GET["result"];
   if (!isset($resultget)) {
      header("Location: result.php?result=0");
   }
   if ($resultget=="true") {
    $election=$_POST["election"];
   }

   
  ?>
</head>
<body>
<div class="container-fluid">
<div class="shadow p-3 mb-5 bg-white rounded">
<div class="row">
          <div class="col-sm-4">
         <a href="index.php"><img src="Images/logo.png" height="100px" width="100px"></a>
        </div>
          <div class="col-sm-8"><span style="font-size: 42px;"><b>ONLINE VOTING SYSTEM</span>
            <br> FYP
            <br> <?php echo date("l,M,d.Y");?></b> </div>
        </div></div>
</div>
<div class="container-fluid">
<div class="shadow p-3 mb-5 bg-white rounded">
<form action="result.php?result=true" method="post">
<select id="mySelect" name="election" onchange="myFunction()" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
  <option selected disabled>SELECT AN ELECTION</option>
 <?php
  $result0 = mysqli_query($con,"SELECT * FROM `election` WHERE `status`='unactive'") or die('Error');
                    while($row0 = mysqli_fetch_array($result0)) {
                        echo '<option value="'.$row0['name'].'">'.$row0['name'].'</option>';
                    }?>
</select>

<center><input type="submit" value="SEARCH" class="btn btn-primary"></center>
</form>
</div></div>
<div class="container-fluid">
<div class="shadow p-3 mb-5 bg-white rounded">
<?php
if (isset($election)) {
    $result0 = mysqli_query($con,"SELECT * FROM `election` WHERE `name`='$election'") or die('Error');
    while($row0 = mysqli_fetch_array($result0)) {
        $type=$row0["type"];
    }
    if ($type=="President") {
        President($con,$election);
    }
    else {
        OTHERELECTION($con,$election);
    }
}
?>
</div></div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
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
$user=$_SESSION['username'];
include_once 'dbConnection.php';
$vote=$_POST["vote"];
$constituency=$_POST["constituency"];
$election=$_POST["election"];
?>  
<title>RECORD VOTE FOR <?php echo $user;?></title>
<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
  </script>
</head>
<body onload="typeWriter()">
    <div class="container-fluid">
        <div class="shadow p-3 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-2" align="right"><img src="Images/logo.png" alt="logo" style="width:50px;"></div>
                <div class="col-10" ><h1>ONLINE VOTING SYSTEM</h1></div>
            </div>
        </div>
    </div>
    <div id="printableArea">
        <?php
        $result1 = mysqli_query($con,"SELECT * FROM `election` WHERE `name`='$election'") or die('Error');
        while($row1 = mysqli_fetch_array($result1)) {
            $votescast = $row1["votecast"];
        }
         $result1 = mysqli_query($con,"SELECT * FROM `candidate` WHERE `election`='$election' && `id`='$vote' && `constituency`='$constituency'") or die('Error');
         while($row1 = mysqli_fetch_array($result1)) {
             $havevotes = $row1["votes"];
         }
         $newvotecast=$votescast+1;
         $newvote=$havevotes+1;
            echo $newvote;
            $sql8a="UPDATE `candidate` SET `votes`='$newvote' WHERE `election`='$election' && `id`='$vote' && `constituency`='$constituency'";
            if ($con->query($sql8a) === TRUE) 
            {
              echo "VOTE VERIFIED <br>  VOTE ADDED TO CANDIDATE";
            }
            else 
            {   
            echo "Error: " . $sql8a . "<br>" . $con->error;
            
            }
            $sql8b="UPDATE `election` SET `votecast`='$newvote' WHERE `name`='$election'";
            if ($con->query($sql8b) === TRUE) 
            {
              echo "<br>UPDATING ELECTION RECORD";
            }
            else 
            {   
            echo "Error: " . $sql8b . "<br>" . $con->error;
            
            }
            $year=date("Y");
            $voteid="OVS$user$year$constituency";
            $sql1 = "INSERT INTO `votes`(`voteid`, `voterid`, `election`, `constituency`) VALUES
            ('$voteid','$user','$election','$constituency')";
        
            if ($con->query($sql1) === TRUE) { echo '<br>VOTE SAVED';} 
            else {   echo "Error: " . $sql1 . "<br>" . $con->error; }
        ?>
        
        
        <script>
        function proceed() {
                document.getElementById("printableArea").innerHTML=`<center><div class="container-fluid"><div class="shadow p-3 mb-5 bg-white rounded"><h1>
                <progress > WORKING ON RESULTS</progress><br>
                DONT CLOSE THIS WINDOW
                <div id="timer"></div>
                </h1></div></div></center>
                <?php header( "refresh:13;url=dashboard.php" );?>`;
                var timeleft = 10;
                var downloadTimer = setInterval(function(){
                timeleft--;
                document.getElementById("timer").textContent = 'PLEASE WAIT '+timeleft;
                if(timeleft <= 0)
                    clearInterval(downloadTimer);
                },1000);
                    }
        </script>
        
        <button class="btn btn-success" onclick="proceed()">PROCEED</button>
        </div>
</body>
</html>
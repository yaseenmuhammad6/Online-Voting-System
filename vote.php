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
<?php
session_start();
if ( !isset($_SESSION['username']))
{
header('Location: index.php');
}
$user=$_SESSION['username'];
include_once 'dbConnection.php';
$votefor=$_GET["votefor"];
$election=$_GET["election"];
$type=$_GET["type"];

?>  
<title><?php echo $type.$election?></title>
</head>
<body>
<script>
function gohome()
{
    window.location.href = "dashboard.php";
    }
</script>
<?php 
$query3 = mysqli_query($con,"SELECT * FROM `votes` WHERE `voterid`='$user' && `election`='$election'") or die('Error');
    while($row3 = mysqli_fetch_array($query3)) {
        echo "<script>alert('YOU ALREADY RECORDED YOUR VOTE. voteid =".$row3['voteid']." ');</script>";
        header( "refresh:1;url=dashboard.php" );
        exit;
        }


# check date and time of election 
?>
<div class="container-fluid">

<div class="shadow p-3 mb-5 bg-white rounded">
<center><h1>WELCOME <?php echo $user;?></h1>
<h6>DIGITAL BALLOT FOR <?php echo $type." ".$election;?> </h6>
<button class="btn btn-danger" onclick="gohome()">CANCEL</button></center>
</div></div>
<div class="container-fluid">
    <script>
        function dis(obj) {
            
            document.getElementById(obj).innerHTML=`<br>
    <center><input type="submit" class="btn btn-success" value="CAST VOTE"></center>`;      
        }
    </script>
    <form action="recordvote.php" method="POST">
    
    <input type="hidden" value="<?php echo $election;?>" name="election">
<?php
$independentsymbol=1;
    $result1 = mysqli_query($con,"SELECT * FROM `candidate` WHERE `election`='$election' && `constituency`='$votefor'") or die('Error');
    while($row1 = mysqli_fetch_array($result1)) {
        echo ' <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="row">';
        $party=$row1["party"];
        if ($party=="INDEPENDENT") {
            echo '<div class="col-1"><img src="Symbols/Independent/'.$independentsymbol.'.png" width="100" height="100">';
            $independentsymbol++;
        }
        else {
            $result11 = mysqli_query($con,"SELECT * FROM `symbols` WHERE `alloted to`='$party'") or die('Error');
            while($row11 = mysqli_fetch_array($result11)) {
                echo '<div class="col-1"><img src="'.$row11["location"].'" width="75" height="75">';  
            }
        }
        echo '</div>
        <div class="col-9">
       '.$row1["name"].'<br>'.$row1["party"].'
       </div>
       <div class="col-2"><br>
       <div class="form-check form-switch">
       <input type="hidden" value="'.$row1["constituency"].'" name="constituency">
       <input type="radio" value="'.$row1["id"].'" onclick="dis('.$row1["id"].')" name="vote" id="vote" style="transform: scale(3);" class="form-check-input" id="flexSwitchCheckDefault">
        </div>
        <div id="'.$row1["id"].'"></div>
       </div>
       </div></div>
        ';
        
    }
?>
<center>

<input type="reset" class="btn btn-warning" value="RESET">
</center>
</form>
<center>
</div>

</body>
</html>

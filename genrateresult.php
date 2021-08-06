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
        <script>
function gohome()
{
    window.location.href = "superadmin.php";
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<?php
    session_start();
    if ( !isset($_SESSION['username']))
    {
    header('Location: index.php');
    }
    $user=$_SESSION['username'];
    include_once 'dbConnection.php';
    include_once 'php/code1.php';
    $election=$_POST["election"];
    $result0 = mysqli_query($con,"SELECT * FROM `election` WHERE `name`='$election'") or die('Error');
        while($row0 = mysqli_fetch_array($result0)) {
           $type = $row0['type'];
            $location=$row0['location'];
            $status=$row0['status'];
            $startdate=$row0['startdate'];
            $starttime=$row0['starttime'];
            $enddate=$row0['enddate'];
            $endtime=$row0['endtime'];
        }
        $result01 = mysqli_query($con,"SELECT * FROM `data` WHERE 1") or die('Error');
        while($row01 = mysqli_fetch_array($result01)) {
            $ajk=$row01['AJK'];
            $gb=$row01['GB'];
            $na=$row01['NA'];
            $pb=$row01['PB'];
            $pk=$row01['PK'];
            $pp=$row01['PP'];
            $ps=$row01['PS'];
            $senate=$row01['senate'];
        }?>
<div class="container-fluid">
<div class="shadow p-3 mb-5 bg-white rounded">
<center><h1>WELCOME <?php echo $user;?></h1>
<h6>ELECTION RESULT GENRETOR <?php echo $type." ".$election;?> </h6>
ELECION STATRTED AT:<b><?php echo $startdate." ".$starttime;?></b>
ELECION ENDED AT:<b> <?php echo $enddate." ".$endtime;?></b><br>
<button class="btn btn-primary" onclick="gohome()">CLOSE</button></center>
<i><b><u>PLEASE DON"T RELOAD THIS PAGE WAIT 10 SEC OR CLOSE THE ABOVE BUTTON</u></b></i>
<?php
    header( "refresh:10;url=superadmin.php" );
?>
</div></div>
<?php
    if ($type=="National Assembly") {
        echo "NA CALLED";
        echo nationalassemblyresults($con,$na,$election);
        $sql4="UPDATE `election` SET `status`='unactive' WHERE `name`='$election'";
        if ($con->query($sql4) === TRUE) 
        { echo "ELECTION CLOSED";} else  {   echo "Error: " . $sql4 . "<br>" . $con->error;}
    }
    elseif ($type=="Provincial") {
            echo provinicialassemblyresults($con,$location,$election);
        
        
        $sql4="UPDATE `election` SET `status`='unactive' WHERE `name`='$election'";
        if ($con->query($sql4) === TRUE) 
        { echo "ELECTION CLOSED";} else  {   echo "Error: " . $sql4 . "<br>" . $con->error;}
    }
    elseif ($type=="Senate") {
        echo senateresults($con,$senate,$election);
        $sql4="UPDATE `election` SET `status`='unactive' WHERE `name`='$election'";
        if ($con->query($sql4) === TRUE) 
        { echo "ELECTION CLOSED";} else  {   echo "Error: " . $sql4 . "<br>" . $con->error;}
    }
    elseif ($type=="President") {
        echo Presidentresults($con,$election);
        $sql4="UPDATE `election` SET `status`='unactive' WHERE `name`='$election'";
        if ($con->query($sql4) === TRUE) 
        { echo "ELECTION CLOSED";} else  {   echo "Error: " . $sql4 . "<br>" . $con->error;}
    }
?>
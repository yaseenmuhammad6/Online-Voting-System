<link rel="icon" href="Images/logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
     session_start();
     if ( !isset($_SESSION['username']))
     {
       header('Location: index.php');
     }
     $user=$_SESSION['username'];
    include_once 'dbConnection.php';
     $u=$_GET["u"];

//update party data 
     if ($u==0) {
       $partyid=$_POST["partyid"];
       $partyname=$_POST["partyname"];
       $slogan=$_POST["partyname"];
       $founder=$_POST["partyname"];
       $leader=$_POST["leader"];
       $position=$_POST["leaderposition"];

      
      echo "<br>PARTY ID ".$partyid;
      echo "<br>PARTY Name ".$partyname;
      echo "<br>PARTY slogan ".$slogan;
      echo "<br>PARTY founder ".$founder;
      echo "<br>PARTY leader ".$leader;
      echo "<br>PARTY post ".$position;

      $sql="UPDATE `party` SET `name`='$partyname',`leader`='$leader',`leaderposition`='$position',`slogan`='$slogan' WHERE `partyid`='$partyid'";
      if ($con->query($sql) === TRUE) { echo "PARTY CREDENTIALS UPDATED";
        $notification = "$partyname CREDENTIALS UPDATED";
        setcookie("notification",$notification,time()+(120),"/");
      } 
      else {   echo "Error: " . $sql . "<br>" . $con->error; }

      echo "<script type='text/javascript'>alert('".$partyname."RECORD Update Sucessfully');</script>";
        header( "refresh:1;url=superadmin.php" );
     }
?>
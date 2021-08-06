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
    include_once 'code.php';
     $k=$_GET["k"];
     

//adding party
if ($k==0) {
    $pname=$_POST["partyname"];
    $slogan=$_POST["slogan"];
    $founder=$_POST["founder"];
    $leader=$_POST["leader"];
    $postion=$_POST["leaderpostion"];
    $partyid=$_POST["partyid"];
    //file upload
    $target_dir = "uploads/flag/OVS-PF-";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    echo "<br>TARGET DIR : ".$target_dir;
    echo "<br> TARGET FILE".$target_file;
    echo "<br> image file type".$imageFileType ;

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    $sql1 = "INSERT INTO `party`(`partyid`, `name`, `founder`, `leader`, `leaderposition`, `slogan`, `flag`,`symbol`) VALUES
    ('$partyid','$pname','$founder','$leader','$postion','$slogan','$target_file','0')";

    if ($con->query($sql1) === TRUE) { echo '<script>alert("'.$pname.'PARTY ADDED");</script>';} 
    else {   echo "Error: " . $sql1 . "<br>" . $con->error; }

    $notification = "$pname PARTY ADDED";
    setcookie("superadminnotification",$notification,time()+(120),"/");

    echo "<script type='text/javascript'>alert('".$pname." added successfully');</script>";
            header( "refresh:1;url=superadmin.php" );


}
//add new notification
if ($k==1) {
  $noti=$_POST["noti"];
    $sql4="UPDATE `notification` SET `notification`='$noti' WHERE 1";
    if ($con->query($sql4) === TRUE) 
    {
        echo "<script type='text/javascript'>alert('NEW NOTIFICATION ADDED SUCCESSFULLY');</script>";
        header( "refresh:1;url=admin.php" );
    } 
  else 
      {   
      echo "Error: " . $sql4 . "<br>" . $con->error;
      
      }
}
// add new voter
if ($k==2) {
    $voterid=$_POST['voterid'];
    $votername=$_POST['votername'];
    $voterpin=$_POST['pin'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    $ec=$_POST['ec'];
    $province=$_POST['province'];
    $city=$_POST['city'];
    $NA=$_POST['NA'];
    $pc=$_POST['pc'];
    //file upload
    $target_dir = "uploads/voterpic/OVS";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    echo "<br>TARGET DIR : ".$target_dir;
    echo "<br> TARGET FILE".$target_file;
    echo "<br> image file type".$imageFileType ;

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    //insert voter
    $sql1 = "INSERT INTO `voter`(`voterid`, `votername`,`contact` ,`email`,`voterpin`, `province`, `city`, `NA`, `provincial-constituency`,`electoralcollage`, `pic`) VALUES
    ('$voterid','$votername','$contact','$email','$voterpin','$province','$city','$NA','$pc','$ec','$target_file')";

    if ($con->query($sql1) === TRUE) { echo '<script>alert("VOTER  ADDED");</script>';} 
    else {   echo "Error: " . $sql1 . "<br>" . $con->error; }

    $notification = "NEW VOTER ADDED";
    setcookie("adminnotification",$notification,time()+(120),"/");

    //echo "<script type='text/javascript'>alert('VOTER added successfully');</script>";
            header( "refresh:1;url=admin.php" );
}
//add new election
if ($k==3) {
  
  $ename=$_POST["election"];
  $sdate=$_POST["startdate"];
  $stime=$_POST["starttime"];
  $edate=$_POST["enddate"];
  $etime=$_POST["endtime"];
  $type=$_POST["type"];
  $location=$_POST["location"];
  $yeardate=date("Y");
  $name = "$ename-$yeardate";
  $sql1 = "INSERT INTO `election`(`name`, `startdate`, `starttime`, `enddate`, `endtime`, `type`, `location`, `created by`, `status`, `candidates`, `votecast`) VALUES
  ('$name','$sdate','$stime','$edate','$etime','$type','$location','$user','active','0','0')";

  if ($con->query($sql1) === TRUE) { echo '<script>alert("NEW ELECTION ADDED");</script>';} 
  else {   echo "Error: " . $sql1 . "<br>" . $con->error; }


  //echo "<script type='text/javascript'>alert('VOTER added successfully');</script>";
          header( "refresh:1;url=superadmin.php" );
}
// update consitiency
if ($k==4) {

  $ajk=$_POST['AJK'];
  $gb=$_POST['GB'];
  $na=$_POST['NA'];
  $pb=$_POST['PB'];
  $pk=$_POST['PK'];
  $pp=$_POST['PP'];
  $ps=$_POST['PS'];
  $senate=$_POST['senate'];

    $sql4="UPDATE `data` SET `AJK`='$ajk',`GB`='$gb',`NA`='$na',`PB`='$pb',`PK`='$pk',`PP`='$pp',`PS`='$ps',`senate`='$senate' WHERE 1";
    if ($con->query($sql4) === TRUE) 
    {
        echo "<script type='text/javascript'>alert('UPDATED SUCCESSFULLY');</script>";
        header( "refresh:1;url=superadmin.php" );
    } 
      else 
          {   
          echo "Error: " . $sql4 . "<br>" . $con->error;
          
          }
}
//add new admin
if ($k==5) {
  $adminid=$_POST['adminid'];
  $adminname=$_POST['adminname'];
  $contact=$_POST['contact'];
  $password=$_POST['password'];
  $role=$_POST['role'];
  
  $sql1 = "INSERT INTO `admin`(`adminid`, `name`, `contact`, `password`, `role`) VALUES
    ('$adminid','$adminname','$contact','$password','$role')";

    if ($con->query($sql1) === TRUE) { echo '<script>alert("ADMIN  ADDED");</script>';} 
    else {   echo "Error: " . $sql1 . "<br>" . $con->error; }


    //echo "<script type='text/javascript'>alert('VOTER added successfully');</script>";
            header( "refresh:1;url=superadmin.php" );
}
//add new candidate
if ($k==6) {
      echo $election=$_POST['election'];
      echo $nic=$_POST['nic'];
      echo  $cname=$_POST['name'];
      echo  $fname=$_POST['fname'];
      echo  $contact=$_POST['contact'];
      echo  $edu=$_POST['qualification'];
      echo  $institute=$_POST['Institute'];
      echo  $consituiency=$_POST['consituiency'];
      echo  $party=$_POST['party'];

      $result = mysqli_query($con,"SELECT * FROM `election` WHERE `status`='active' && `type`='$institute'") or die('Error'); 
      while($row = mysqli_fetch_array($result)) {
            $electionname = $row['name'];
        }
        $sql1 = "INSERT INTO `candidate`(`id`, `name`, `fathername`, `qualification`, `contact`, `party`, `type`, `constituency`, `votes`, `election`) VALUES
        ('$nic','$cname','$fname','$edu','$contact','$party','$institute','$consituiency','0','$election')";
    
        if ($con->query($sql1) === TRUE) { echo '<script>alert("CANDIDATE ADDED");</script>';} 
        else {   echo "Error: " . $sql1 . "<br>" . $con->error; }
        
        $notification = "$cname CANDIDATE ADDED FOR $consituiency Election = $election";
        setcookie("adminnotification",$notification,time()+(120),"/");
        
        $resultelection = mysqli_query($con,"SELECT * FROM `election` WHERE `status`='active' && `type`='$institute'") or die('Error'); 
        while($row = mysqli_fetch_array($resultelection)) {
            $candidates = $row['candidates'];
        }
        echo $candidates."<br>";
        echo $candidatesupdate=$candidates+1;
        $sql4="UPDATE `election` SET `candidates`='$candidatesupdate' WHERE `status`='active' && `type`='$institute'";
        if ($con->query($sql4) === TRUE) 
        {
            echo "CANDIDATE UPDATED";
            header( "refresh:1;url=admin.php" );
        } 
          else 
              {   
              echo "Error: " . $sql4 . "<br>" . $con->error;
              }

        $notification = "$cname CANDIDATE ADDED FOR $consituiency Election = $election CANDIDATE = $candidatesupdate";
        setcookie("adminnotification",$notification,time()+(120),"/");

       header( "refresh:1;url=admin.php" );
}
// delete admin
if ($k==7) {
  $getadminid=$_POST["adminid"];
  $getadminpin=$_POST["pin"];
  $result = mysqli_query($con,"SELECT * FROM `admin` WHERE `adminid`='$user'") or die('Error');
  while($row = mysqli_fetch_array($result)) {
    $aid = $row['adminid'];
    $aname = $row['name'];
    $apin=$row['password'];
    $role=$row['role'];
    }
    if ($getadminpin==$apin) {
            $sql = "DELETE FROM `admin` WHERE `adminid`='$getadminid'";
            if ($con->query($sql) === TRUE) 
                {
                    echo "<script type='text/javascript'>alert('ADMIN Deleted Sucessfully');</script>";
                    header( "refresh:1;url=superadmin.php" );
                } 
            else 
                {   
                echo "Error: " . $sql . "<br>" . $con->error;
                
                }
          //echo "<script type='text/javascript'>alert('New User Added Sucessfully');</script>";
      
    }
    $con->close();
}
// ADD SYMBOL
if ($k==8) {

  $party=$_POST['party'];
  $symbol=$_POST['symbol'];
      $sql8a="UPDATE `symbols` SET `alloted to`='$party' WHERE `location`='$symbol'";
      if ($con->query($sql8a) === TRUE) 
      {
        
      }
      else 
          {   
          echo "Error: " . $sql8a . "<br>" . $con->error;
          
          }
    $sql8="UPDATE `party` SET `symbol`='$symbol' WHERE `name`='$party'";
    if ($con->query($sql8) === TRUE) 
    {
      $notification = "$symbol ALLOTED TO PARTY = $party";
        setcookie("superadminnotification",$notification,time()+(120),"/");

        echo "<script type='text/javascript'>alert('SYMBOL ALLOTEDSUCCESSFULLY');</script>";
        //header( "refresh:1;url=superadmin.php" );
    } 
      else 
          {   
          echo "Error: " . $sql8 . "<br>" . $con->error;
          
          }
        header( "refresh:1;url=superadmin.php" );
      
}
?>
    
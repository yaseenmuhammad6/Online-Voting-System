<?php
$q=$_GET["q"];
include_once 'dbConnection.php';
if ($q==0) {
    session_start();  // starts a session
// retrieve user name from form
$user  = $_POST["uname"];
$pin = $_POST["pin"];

$result = mysqli_query($con,"SELECT * FROM `admin` WHERE `adminid`='$user'") or die('Error');
while($row = mysqli_fetch_array($result)) {
    $aid = $row['adminid'];
    $aname = $row['name'];
    $apin=$row['password'];
    $role=$row['role'];
}

$result1 = mysqli_query($con,"SELECT * FROM `voter` WHERE `voterid`='$user'") or die('Error');
while($row1 = mysqli_fetch_array($result1)) {
    $vid = $row1['voterid'];
    $vname = $row1['votername'];
    $vpin=$row1['voterpin'];
}

//create session variable and assign username


if ($user==$vid && $pin==$vpin){
    //echo "VOTER";
    $_SESSION['username']= $vid;
    
    header("Location: dashboard.php");
}

elseif ($user==$aid && $pin==$apin) {
    $_SESSION['username']= $user;
    if ($role=="admin") {
    //echo "admin";
       header("Location: admin.php");
    }
    elseif ($role=="superadmin") {
    //echo "super admin";

        header("Location: superadmin.php");
    }
}
else {
    echo "<script type='text/javascript'>alert('WRONG USER NAME OR PASSWORD');</script>";
    header( "refresh:1;url=index.php" );
}
}
if ($q==1) {
    //This is code for logout
//start session
session_start();
//End session
session_destroy();
echo "You have been logged out successfully"; 
//redirect user to the login page

header('Location: index.php');
}
?>

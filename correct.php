<?php 
include_once 'dbConnection.php';
echo "WAIT 15 SECONDS";
# deleting whole table
$sql = "DELETE FROM `provincialassemblies` WHERE 1";
if ($con->query($sql) === TRUE) 
    { echo "TABLE DELETED";} else {   echo "Error: " . $sql . "<br>" . $con->error;}
    
# add new table
#kashmir
for ($i=1; $i <=33 ; $i++) { 
    $constituency="AJK-$i";
    echo $constituency;
    $resultquery="INSERT INTO `provincialassemblies`(`constituency`, `wonby`, `party`, `election`, `province`)  
    VALUES ('$constituency','none','none','none','Kashmir')";
        $con->query($resultquery);
 }
 #gb
 for ($i=1; $i <=33 ; $i++) { 
    $constituency="GB-$i";
    echo $constituency;
    $resultquery="INSERT INTO `provincialassemblies`(`constituency`, `wonby`, `party`, `election`, `province`)  
    VALUES ('$constituency','none','none','none','Gilgit Baltistan')";
        $con->query($resultquery);
 }
#kpk
for ($i=1; $i <=99 ; $i++) { 
    $constituency="PK-$i";
    echo $constituency;
    $resultquery="INSERT INTO `provincialassemblies`(`constituency`, `wonby`, `party`, `election`, `province`) 
     VALUES ('$constituency','none','none','none','Khyber Pakhtunkhwa')";
        $con->query($resultquery);
 }
#panjab
for ($i=1; $i <=297 ; $i++) { 
    $constituency="PP-$i";
    echo $constituency;
    $resultquery="INSERT INTO `provincialassemblies`(`constituency`, `wonby`, `party`, `election`, `province`)  
    VALUES ('$constituency','none','none','none','Panjab')";
        $con->query($resultquery);
 }
#sindh
for ($i=1; $i <=130 ; $i++) { 
    $constituency="PS-$i";
    echo $constituency;
    $resultquery="INSERT INTO `provincialassemblies`(`constituency`, `wonby`, `party`, `election`, `province`)  
    VALUES ('$constituency','none','none','none','Sindh')";
        $con->query($resultquery);
 }
#balochistan
for ($i=1; $i <=51 ; $i++) { 
    $constituency="PB-$i";
    echo $constituency;
    $resultquery="INSERT INTO `provincialassemblies`(`constituency`, `wonby`, `party`, `election`, `province`)  
    VALUES ('$constituency','none','none','none','Balochistan')";
        $con->query($resultquery);
 }
 $sql4="UPDATE `data` SET `AJK`='33',`GB`='24',`NA`='272',`PB`='51',`PK`='99',`PP`='272',`PS`='130',`senate`='100' WHERE 1";
 if ($con->query($sql4) === TRUE) 
 {
     echo "UPDATED SUCCESSFULLY";
 } 
   else 
       {   
       echo "Error: " . $sql4 . "<br>" . $con->error;
       
       }
    header( "refresh:5;url=index.php" );
?>
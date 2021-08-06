<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="Images/logo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD CANDIDATE</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</head>
<body>
    <?php
       session_start();
       if ( !isset($_SESSION['username']))
       {
         header('Location: index.php');
       }
       $user=$_SESSION['username'];
      include_once 'dbConnection.php';
      include_once 'code.php'; 

       $nic=$_POST['nic'];
       $cname=$_POST['name'];
       $fname=$_POST['fname'];
       $contact=$_POST['contact'];
       $edu=$_POST['qualification'];
       $institute=$_POST['Institute'];
       $provice=$_POST['province'];
       $result0 = mysqli_query($con,"SELECT * FROM `data` WHERE 1") or die('Error'); 
       while($row0 = mysqli_fetch_array($result0)) {
             $na = $row0['NA'];
             $senate = $row0['senate'];
             $gb = $row0['GB'];
             $ajk = $row0['AJK'];
             $pb = $row0['PB'];
             $pk = $row0['PK'];
             $pp = $row0['PP'];
             $ps = $row0['PS'];
         }
      $result = mysqli_query($con,"SELECT * FROM `election` WHERE `status`='active' && `type`='$institute'") or die('Error'); 
      while($row = mysqli_fetch_array($result)) {
            $name = $row['name'];
            $sdate = $row['startdate'];
            $edate = $row['enddate'];
            $stime = $row['starttime'];
            $etime = $row['endtime'];
            $type = $row['type'];
            $location = $row['location'];
        }
        if ($name==null) {
            echo "<script type='text/javascript'>alert('ELECTION DOSEN'T EXISIT FOR A PARTICULAR INSTITUTE');</script>";
            header( "refresh:1;url=admin.php" );
        }
        
        $tdate=date("Y-m-d");
       $ttime=date("h:i");
        
    ?>
    <div class="container-fluid">
            <div class="row" style="background-color: rgb(248, 249, 250);">
                <div class="col-2"><img src="Images/logo.png" alt="logo" style="width:50px;"></div>
                    <div class="col-4"> <center>WELCOME<br><h4><?php echo $user;?></h4></center></div>
                    <div class="col-4"> <center>ADD CANDIDATE FOR ELECTION<br><h4><?php echo $name;?></h4></center></div>
                <div class="col-2"><nav class="navbar navbar-expand-sm bg-light navbar-light">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link" href="admin.php">ADMIN PAGE</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="login.php?q=1">LOGOUT</a>
                      </li>
                    </ul>
                  </nav></div>
              </div><!--END OF ROW-->
              <div class="container-fluid">
              <div class="shadow p-3 mb-5 bg-white rounded">
                <form action="operation.php?k=6" method="post">

                <div class="form-group">
                    <label for="exampleFormControlInput6">ELECTION</label>
                    <select name="election" class="form-select" required="true">
                    <option disabled>SELECT AN ELECTION</option>
                    <?php
                    $result0 = mysqli_query($con,"SELECT * FROM `election` WHERE 1") or die('Error');
                    while($row0 = mysqli_fetch_array($result0)) {
                        echo '<option  selected value="'.$row0['name'].'">'.$row0['name'].'</option>';
                    }
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">NAME</label>
                    <input type="text" name="name"  required class="form-control" id="exampleFormControlInput1" value="<?php echo $cname;?>" readonly>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput2">FATHER NAME</label>
                    <input type="text" name="fname" required class="form-control" id="exampleFormControlInput2"  value="<?php echo $fname;?>" readonly>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput3">NIC</label>
                    <input type="text" name="nic" required class="form-control" id="exampleFormControlInput3"  value="<?php echo $nic;?>" readonly>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput4">CONTACT NUMBER</label>
                    <input type="text" name="contact" required class="form-control" id="exampleFormControlInput4"  value="<?php echo $contact;?>" readonly>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput5">QUALIFICATION</label>
                    <input type="text" name="qualification" required class="form-control" id="exampleFormControlInput5"  value="<?php echo $edu;?>" readonly>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput6">CANDIDATE FOR</label>
                    <input type="text" name="Institute"  required class="form-control" id="exampleFormControlInput6"  value="<?php echo $institute;?>" readonly>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput6">Consituiency</label>
                    <select name="consituiency" class="form-select" required="true">
                    <option selected disabled>Select a Consituiency</option>
                    <?php
                    if ($institute=="President") {
                        echo '<option value="President">President</option>';
                    }
                    else {
                        if ($institute=="National Assembly") {
                            for ($i=1; $i <=$na ; $i++) { 
                                echo '<option value="NA'.$i.'">NA'.$i.'</option>';
                            }
                        }
                        elseif ($institute=="Provincial") {
                            if ($location="Balochistan") {
                                for ($i=1; $i <=$pb ; $i++) { 
                                    echo '<option value="PB'.$i.'">PB'.$i.'</option>';
                                }
                            }
                            if ($location="Gilgit Baltistan") {
                                for ($i=1; $i <=$gb ; $i++) { 
                                    echo '<option value="GB'.$i.'">GB'.$i.'</option>';
                                }
                            }
                            if ($location="Kashmir") {
                                for ($i=1; $i <=$ajk ; $i++) { 
                                    echo '<option value="AJK'.$i.'">AJK'.$i.'</option>';
                                }
                            }
                            if ($location="Khyber Pakhtunkhwa") {
                                for ($i=1; $i <=$pk ; $i++) { 
                                    echo '<option value="PKL'.$i.'">PB'.$i.'</option>';
                                }
                            }
                            if ($location="Panjab") {
                                for ($i=1; $i <=$pp ; $i++) { 
                                    echo '<option value="PP'.$i.'">PP'.$i.'</option>';
                                }
                            }
                            if ($location="Sindh") {
                                for ($i=1; $i <=$ps ; $i++) { 
                                    echo '<option value="PS'.$i.'">PS'.$i.'</option>';
                                }
                            }
                            
                        }// end of elseif
                        
                    }
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput6">PARTY</label>
                    <select name="party" class="form-select" required="true">
                    <option selected disabled>SELECT A PARTY</option>
                    <option value="INDEPENDENT">INDEPENDENT</option>
                    <?php
                    $result0 = mysqli_query($con,"SELECT * FROM `party` WHERE 1") or die('Error');
                    while($row0 = mysqli_fetch_array($result0)) {
                        echo '<option value="'.$row0['name'].'">'.$row0['name'].'</option>';
                    }
                    ?>
                    </select>
                </div><br>
               <div align="center"> <input type="reset" class="btn btn-warning" value="RESET">
                <input type="submit" class="btn btn-success" value="ADD NEW CANDIDATE">
                </div>
                </form>
                </div>
              </div>
              </div>
</body>
</html>
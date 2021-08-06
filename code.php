
<link rel="icon" href="Images/logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
    // update party function
    function updateparty($con)
    {
        echo '
        <div class="row">
        <div class="col"><div class="shadow p-3 mb-5 bg-white rounded"><a href="javascript:addparty()"><img src="Images/addparty.png" class="baw"></a><br>ADD PARTY</div></div>
        <div class="col"><div class="shadow p-3 mb-5 bg-white rounded"><a href="javascript:updateparty()"><img src="Images/updateparty.png" class="clrimg"></a><br>UPDATE PARTY</div></div>
        </div>
        <center><h5>UPDATE PARTY CREDITIALS</h5></center>
        <div class="container-fluid" style="text-align: center;"><div class="row">';
        $result0 = mysqli_query($con,"SELECT * FROM `party` WHERE 1") or die('Error');
        while($row0 = mysqli_fetch_array($result0)) {
        echo '<div class="col-1"><div class="shadow p-3 mb-5 bg-white rounded">
        <a href="updateparty.php?p='.$row0['partyid'].'"><img src="'.$row0['flag'].'" class="rounded-circle" width="50px" height="50px"></a><br>
        '.$row0['partyid'].'
        </div></div>'
         ;
    }
    echo '</div>';
    }
    //consituiency function
    function consituincy()
    {
        $con= new mysqli('localhost','root','','ovs')or die("Could not connect to mysql".mysqli_error($con));
        $result0001 = mysqli_query($con,"SELECT * FROM `data` WHERE 1") or die('Error');
        while($row0001 = mysqli_fetch_array($result0001)) {
        $NA=$row0001['NA'];
             }
        echo '<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">PROVINCE</span></div>
        <select name="province" class="form-select" required>
        <option disabled selected >SELECT A PROVINCE</option>';
        for ($i=0; $i <$NA ; $i++) { 
            echo '<option value="NA'.$i.'">NA'.$i.'</option>';
        }
        echo '
        </select>
        </div>';
    }
    //manage consituincy
    function ManageConsitiency($con)
    {
        $result0 = mysqli_query($con,"SELECT * FROM `data` WHERE 1") or die('Error');
        while($row0 = mysqli_fetch_array($result0)) {
            $ajk=$row0['AJK'];
            $gb=$row0['GB'];
            $na=$row0['NA'];
            $pb=$row0['PB'];
            $pk=$row0['PK'];
            $pp=$row0['PP'];
            $ps=$row0['PS'];
            $senate=$row0['senate'];
        }
       echo '
       
       <div class="shadow p-3 mb-5 bg-white rounded" style="width: 50%">
    <h5>UPDATE CONSITUIENCY COUNT</h5>
    <form action="operation.php?k=4" method="POST" enctype="multipart/form-data">
            
            <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">NATIONAL ASSEMBLY</span></div>
            <input type="text" value="'.$na.'" class="form-control" name="NA" id="floatingInputValue" placeholder="NATIONAL ASSEMBLY" required></div>

            <div class="input-group mb-3">
            <input type="text" value="'.$senate.'" class="form-control" name="senate" id="floatingInputValue" placeholder="SENATE" required><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">SENATE</span></div></div>
            
            <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">BALOCHISTAN</span></div>
            <input type="text" value="'.$pb.'" class="form-control" name="PB" id="floatingInputValue" placeholder="BALOCHISTAN" required></div>

            <div class="input-group mb-3">
            <input type="text" value="'.$pk.'" class="form-control" name="PK" id="floatingInputValue" placeholder="KPK" required><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">KPK</span></div></div>
            
            <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">PANJAB</span></div>
            <input type="text" value="'.$pp.'" class="form-control" name="PP" id="floatingInputValue" placeholder="PANJAB" required></div>

            <div class="input-group mb-3">
            <input type="text" value="'.$ps.'" class="form-control" name="PS" id="floatingInputValue" placeholder="SINDH" required><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">SINDH</span></div></div>
            
            <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">AZAD JAMMU KASHMIR</span></div>
            <input type="text" value="'.$ajk.'" class="form-control" name="AJK" id="floatingInputValue" placeholder="AZAD JAMMU KASHMIR" required></div>

            <div class="input-group mb-3">
            <input type="text" value="'.$gb.'" class="form-control" name="GB" id="floatingInputValue" placeholder="GILGIT BALTISTAN" required><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">GILGIT BALTISTAN</span></div></div>
            
            <input type="reset" value="RESET" class="btn btn-warning">
            <input type="submit" value="UPDATE" class="btn btn-success">
            <button onclick="manageadmin()" class="btn btn-danger">CANCEL</button>
       </form>';
    }

    function consituincycheck($institute)
    {
        if ($institute=="National Assembly") {
            for ($i=1; $i <=$na ; $i++) { 
                echo '<option value="NA'.$i.'">NA'.$i.'</option>';
            }
        }
    }

    function removeadmin($con){
        echo '<div class="shadow p-3 mb-5 bg-white rounded" style="width: 50%">
        <h5>REMOVE ADMIN</h5>
        <form action="operation.php?k=7" method="POST">
        <div class="form-group">
        <label for="exampleFormControlInput6">PARTY</label>
        <select name="adminid" class="form-select" required="true">
        <option selected disabled>SELECT AN ADMIN TO REMOVE</option>
        ';
        $result0 = mysqli_query($con,"SELECT * FROM `admin` WHERE 1") or die('Error');
        while($row0 = mysqli_fetch_array($result0)) {
            echo '<option value="'.$row0['adminid'].'">'.$row0['name'].'('.$row0['role'].')</option>';
        }
        echo '</select>
        </div>
        <div class="form-group">
        <label for="exampleFormControlInput6">INPUT PIN TO CONFIRM</label>
        <input name="pin" class="form-control" type="password" placeholder="INPUT PIN TO CONFIRM">
        </div>
        <br>
       <div align="center"> <input type="reset" class="btn btn-warning" value="RESET">
        <input type="submit" class="btn btn-success" value="ADD NEW CANDIDATE">
        </div>
        </form>';
    }

    function symbols($con){
        echo '<div class="shadow p-3 mb-5 bg-white rounded" style="width: 50%">
        <h5>ALLOT PARTY SYMBOLS</h5>
        <form action="operation.php?k=8" method="POST">
        <div class="form-group">
        <label for="exampleFormControlInput6">PARTY</label>
        <select name="party" class="form-select" required="true">
        <option selected disabled>SELECT A PARTY</option>
        <option value="INDEPENDENT">INDEPENDENT</option>
        ';
        $result0 = mysqli_query($con,"SELECT * FROM `party` WHERE 1") or die('Error');
        while($row0 = mysqli_fetch_array($result0)) {
            echo '<option value="'.$row0['name'].'">'.$row0['name'].'</option>';
        }
        echo '
        </select>
        <label for="exampleFormControlInput6">SYMBOLS</label>
        <select name="symbol" class="form-select" required="true">
        <option selected disabled>SELECT A SYMBOL</option>
        
        ';
        $result001 = mysqli_query($con,"SELECT * FROM `symbols` WHERE `alloted to`='none'") or die('Error');
        while($row001 = mysqli_fetch_array($result001)) {
            echo '<option value="'.$row001['location'].'">'.$row001['symbolname'].'</option>';
        }
        echo '
    </div><br><br>
   <div align="center"> <br><br><input type="reset" class="btn btn-warning" value="RESET">
    <input type="submit" class="btn btn-success" value="ALLOT SYMBOL">
    </div>
    </form>';
    }

    function electionstart($con,$election,$na,$pc){
        echo '<div id="main">
   <center><!--TABLE-->
   <div id="electionmain">
                <table class="table table-bordered" style="width: 50%">
                <thead>
                <tr>
                <th>S.No</th>
                <th>ELECTION NAME</th>
                <th>ELECTION FOR</th>
                <th>VOTE</th>
                </tr>
                </thead>
                <tbody>
            ';
                $cd=1;
                $resultcd = mysqli_query($con,"SELECT * FROM `election` WHERE `status`='active'") or die('Error');
                while($rowcd = mysqli_fetch_array($resultcd)) {
        
                    echo '
                    <tr>
                    <td>'.$cd.'</td>
                    <td>'.$rowcd['name'].'</td>
                    <td>'.$rowcd['type'].'</td>';
                    if ($rowcd['type']=="National Assembly") {
                      echo'
                    <td id="entervote"><a href="vote.php?votefor='.$na.'&election='.$election.'&type='.$rowcd['type'].'"><button class="btn btn-success">VOTE</button></a></td></tr>
                    ';
                    }
                    elseif ($rowcd['type']=="President") {
                      echo'
                      <td id="entervote"><a href="vote.php?votefor=President&election='.$election.'&type='.$rowcd['type'].'"><button class="btn btn-success">VOTE</button></a></td></tr>
                      ';
                    }
                    elseif ($rowcd['type']=="Senate") {
                      echo'
                      <td id="entervote"><a href="vote.php?votefor=&election='.$election.'&type='.$rowcd['type'].'"><button class="btn btn-success">VOTE</button></a></td></tr>
                      ';
                    }
                    elseif ($rowcd['type']=="Provincial") {
                      echo'
                    <td id="entervote"><a href="vote.php?votefor='.$pc.'&election='.$election.'&type='.$rowcd['type'].'"><button class="btn btn-success">VOTE</button></a></td></tr>
                    ';
                    }
                    
                    $cd++;
             }
        echo '
                        </tbody>
                        </table></div>
                
                    </div>
                    ';
            }

    function GenrateResult($con)
    {
        echo '<div class="shadow p-3 mb-5 bg-white rounded" style="width: 50%">
        <h5>GENRATE ELECTION RESULT</h5>
        <form action="genrateresult.php" method="POST">
        <div class="form-group">
        <label for="exampleFormControlInput6">PARTY</label>
        <select name="election" class="form-select" required="true">
        <option selected disabled>SELECT AN ELECTION FROM THE LIST</option>
        
        ';
        $result0 = mysqli_query($con,"SELECT * FROM `election` WHERE `status`='active'") or die('Error');
        while($row0 = mysqli_fetch_array($result0)) {
            echo '<option value="'.$row0['name'].'">'.$row0['name'].'</option>';
        }
        echo '
        </select>
        <input type="reset" class="btn btn-warning" value="RESET">
        <input type="submit" class="btn btn-success" value="GENRATE RESULT">
    </div>
    </form>';
    }
?>
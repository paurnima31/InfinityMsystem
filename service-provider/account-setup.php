<?php
    //  ----------------- Include Connection file --------------------
    include ("../conn.php");

    //  ----------------- Session start --------------------
    session_start();
    $userId = $_SESSION['sess_id'];
    $sType = $_SESSION['sess_stype'];

    //------------------------- if not authenticated redirect to login page --------------------
    if(!isset($_SESSION['sess_id'])){
        echo "<script>window.location.href = '../login.php';</script>";
    }

    // -------------------- specific user can access only his profile --------------------
    if($sType != 'sp'){
        echo "<script>window.location.href = '../user/';</script>";
    }
    
    // -------------------- Fetch user Id from dtabase --------------------
    mysqli_select_db($conn, 'infinity') or die(mysqli_error($conn));
    $unFIlteredSPData = mysqli_query($conn, "SELECT * FROM sproviders WHERE id= '$userId'");
    $spData = mysqli_fetch_array($unFIlteredSPData);
    $btnText = "Update";
    $headingText = "Update Your Profile";
    $newLoginRedirect = "I will do it later !";
    
    $servicesArray = array("Advocate","Mechanic","Electrician","Doctor","Fitness trainer","Makeup artist","Pet sitting","Ac Repairing","Carpenter","Plumber","Photographer","Videographer","Dentist","Gardener","Tutor","Accountant","IT Professional","Home Painter","Pest Control","Home Cleaner");

    if(!$spData){
        $spData['sname'] = "";
        $spData['smail'] = "";
        $spData['smob'] = "";
        $spData['serv'] = "";
        $spData['slocation'] = "";
        $spData['stime'] = "";
        $spData['etime'] = "";
        $spData['scharges'] = "";
        $spData['sdesc'] = "";
        $btnText = "Create Profile";
        $headingText = "Create Profile";
        $newLoginRedirect = "";
    }

    // ------------------ Sending Data to server as per condition --------------------
    if(isset($_POST['add_prof'])){
        $sname = ucfirst($_POST['sname']);
        $smail = $_POST['smail'];
        $mobno = $_POST['mobno'];
        $serv = $_POST['serv'];
        $loc = ucfirst($_POST['loc']);
        $ftime = $_POST['ftime'];
        $ttime = $_POST['ttime'];
        $rate = $_POST['rate'];
        $desc = $_POST['sdesc'];
        if(empty($sname) || empty($smail) || empty($mobno) || empty($serv) || empty($loc) || empty($ftime) || empty($ttime) || empty($rate)|| empty($desc)){
            echo "<script>alert('Please fill all the fields')</script>";
        }
        else{
            if($spData['sname'] == ""){
                $insertSP = mysqli_query($conn, "INSERT INTO sproviders (id, sname, smail, smob, serv, slocation, stime, etime, scharges, sdesc) VALUES ('$userId', '$sname', '$smail', '$mobno', '$serv', '$loc', '$ftime', '$ttime', '$rate', '$desc')");
                if($insertSP){
                    echo "<script>window.location.href='profile.php'</script>";
                }
                else{
                    echo "<script>alert('Something Went Wrong')</script>";
                }
            }else{
                $updateSP = mysqli_query($conn, "UPDATE sproviders SET sname='$sname', smail='$smail', smob='$mobno', serv='$serv', slocation='$loc', stime='$ftime', etime='$ttime', scharges='$rate' , sdesc='$desc' WHERE id='$id2[id]'");
                if($updateSP){
                    echo "<script>window.location.href='profile.php'</script>";
                }
                else{
                    echo "<script>alert('Something Went Wrong')</script>";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <link rel="stylesheet" href="../Assets/Styles/style.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="../Assets/Favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Assets/Favicons/favicon-16x16.png">
    <meta name="theme-color" content="#ffffff">
    <title><?php echo"$headingText" ?></title>
</head>

<body>
<nav class="glass">
        <a href="#home"><img src="../Assets/Images/infinityLoop2.gif" class="navImg" alt=""></a>
            <ul>
                <li><a href='profile.php'>Profile</a></li>
                <li><a href='../logout.php'>Logout</a></li>
        </ul>
    </nav>
    <section class="lsSection"id="mainSectionSmall">
        <div class="lsModal boxShadow1">
            <div class="lsModalSec1">
                <form action="" method="POST" class="lsModelForm">
                    <h2><?php echo"$headingText" ?></h2>
                        <input class="inputBx boxShadow1Hover" placeholder="Full Name" type="text" name="sname" value="<?php echo"$spData[sname]" ?>">
                        <input class="inputBx boxShadow1Hover" placeholder="Email Address" type="email" name="smail" value="<?php echo"$spData[smail]" ?>">
                        <input class="inputBx boxShadow1Hover" placeholder="Mobile Number" type="tel" name="mobno" value="<?php echo"$spData[smob]" ?>">
                        <input class="inputBx boxShadow1Hover" placeholder="Description" type="text" name="sdesc" value="<?php echo"$spData[sdesc]" ?>">
                        <select class="inputBx boxShadow1Hover" name="serv">
                            <?php
                                foreach($servicesArray as $service){
                                    if($spData['serv'] == $service){
                                        echo "<option value='$service' selected>$service</option>";
                                    }else{
                                        echo "<option value='$service'>$service</option>";
                                    }
                                }
                            ?>
                        </select>
                        <input class="inputBx boxShadow1Hover" placeholder="Location" type="text" name="loc" value="<?php echo"$spData[slocation]" ?>">
                        <input class="inputBx inputBxHalf boxShadow1Hover" type="time" name="ftime" value="<?php echo"$spData[stime]" ?>">
                        <input class="inputBx inputBxHalf boxShadow1Hover" type="time" name="ttime" value="<?php echo"$spData[etime]" ?>">
                        <input class="inputBx boxShadow1Hover" placeholder="Charges per Hour" type="number" name="rate" value="<?php echo"$spData[scharges]" ?>">
                        <div class="lsModelFormBottom">
                            <a href="./profile.php"><?php echo"$newLoginRedirect" ?></a>
                            <button class="btn boxShadow1" type="submit" name="add_prof"><?php echo"$btnText" ?></button>
                        </div>
                </form>
            </div>
            <div class="lsModalSec2">
                <img src="../Assets/Images/updateAccount.gif" alt="" />
            </div>
        </div>
    </section>
    <script src="../Assets/Scripts/script.js"></script>
</body>

</html>
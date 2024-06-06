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
    if($sType != 'user'){
        echo "<script>window.location.href = '../service-provider/profile.php';</script>";
    }
    
    // -------------------- Fetch user Id from dtabase --------------------
    mysqli_select_db($conn, 'infinity') or die(mysqli_error($conn));
    $unFIlteredSPData = mysqli_query($conn, "SELECT * FROM users WHERE id= '$userId'");
    $spData = mysqli_fetch_array($unFIlteredSPData);
    $btnText = "Update";
    $headingText = "Update Your Profile";
    $newLoginRedirect = "I will do it later !";
    
    $servicesArray = array("Advocate","Mechanic","Electrician","Doctor","Fitness trainer","Makeup artist","Pet sitting");

    if(!$spData){
        $spData['uname'] = "";
        $spData['umail'] = "";
        $spData['umob'] = "";
        $spData['location'] = "";
        $btnText = "Create Profile";
        $headingText = "Create Profile";
        $newLoginRedirect = "";
    }

    // ------------------ Sending Data to server as per condition --------------------
    if(isset($_POST['add_prof'])){
        $uname = ucfirst($_POST['uname']);
        $uemail = $_POST['umail'];
        $umobno = $_POST['umob'];
        $location = ucfirst($_POST['location']);
        if(empty($uname) || empty($uemail) || empty($umobno) || empty($location)){
            echo "<script>alert('Please fill all the fields')</script>";
        }
        else{
            if($spData['uname'] == ""){
                $sql = "INSERT INTO users (id, uname, umail, umob, location) VALUES ('$userId', '$uname', '$uemail', '$umobno', '$location')";
                if(mysqli_query($conn, $sql)){
                    echo "<script>window.location.href='profile.php'</script>";
                }
                else{
                    echo "<script>alert('Something Went Wrong')</script>";
                }
            }
            else{
                $sql = "UPDATE users SET uname='$uname', umail='$uemail', umob='$umobno', location='$location' WHERE id='$userId'";
                if(mysqli_query($conn, $sql)){
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
            <li><a href='./index.php'>Dashboard</a></li>
            <li><a href='../logout.php'>Logout</a></li>
        </ul>
    </nav>
    <section class="lsSection"id="mainSectionSmall">
        <div class="lsModal boxShadow1">
            <div class="lsModalSec1">
            <div class="lsModalLogoDiv">
                    <img src="../Assets/Images/infinityLoop2.gif" class="lsModalLogo" alt="" />
                    <p>Infinity Services</p>
                </div>
                <form action="" method="POST" class="lsModelForm">
                    <h2><?php echo"$headingText" ?></h2>
                        <input class="inputBx boxShadow1Hover" placeholder="Full Name" type="text" name="uname" value="<?php echo"$spData[uname]" ?>">
                        <input class="inputBx boxShadow1Hover" placeholder="Email Address" type="email" name="umail" value="<?php echo"$spData[umail]" ?>">
                        <input class="inputBx boxShadow1Hover" placeholder="Mobile Number" type="tel" name="umob" value="<?php echo"$spData[umob]" ?>">
                        <input class="inputBx boxShadow1Hover" placeholder="Location" type="text" name="location" value="<?php echo"$spData[location]" ?>">
                        <div class="lsModelFormBottom">
                            <a href="./profile.php"><?php echo"$newLoginRedirect" ?></a>
                            <button class="btn boxShadow1" type="submit" name="add_prof"><?php echo"$btnText" ?></button>
                        </div>
                </form>
                <div class="lsModalTermsDiv"></div>
            </div>
            <div class="lsModalSec2">
                <img src="../Assets/Images/updateAccount.gif" alt="" />
            </div>
        </div>
    </section>
    <script src="../Assets/Scripts/script.js"></script>
</body>

</html>
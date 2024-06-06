<?php
     //  ----------------- Include Connection file --------------------
     include ("../conn.php");

     //  ----------------- Session start --------------------
     session_start();
     $userId = $_SESSION['sess_id'];
     $sType = $_SESSION['sess_stype'];

     $sp_id = "";
     $serv = "";
     $sname = "";
     
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
     $unFIlteredSPData = mysqli_query($conn, "SELECT * FROM sproviders  ");
     $spDataRows = mysqli_num_rows($unFIlteredSPData);


     
     // -------------------- Fetch user from dtabase --------------------
     $checkUnfilterredArr = mysqli_query($conn, "SELECT * FROM users WHERE id= '$userId'");
     $userData = mysqli_fetch_array($checkUnfilterredArr);
     
 
     // if $spData is empty the make it as an empty array
     if(!$userData){
        echo "<script>window.location.href = './account-setup.php';</script>";
     }
    //  ------------- Get Book Id from book_Id_Get click -------------------------
    if(isset($_POST['book_Id_Get'])){
        $sp_id = $_POST['sp_id'];
        $serv = $_POST['serv'];
        $sname = $_POST['sname'];

        $_SESSION['sess_sp_id'] = $sp_id ;
        $_SESSION['sess_serv'] = $serv;
        $_SESSION['sname'] = $sname;
        
    }
    
    //  ----------------- Book a service  on button click --------------------------
    if(isset($_POST['book_a_service'])){
        $sess_sp_id = $_SESSION['sess_sp_id'];
        $sess_serv = $_SESSION['sess_serv'];
        $sname = $_SESSION['sname'];
        $rtime = $_POST['rtime'];
        $rdate = $_POST['rdate'];
        if(empty($rtime) || empty($rdate)){
            echo "<script>alert('Please fill all the fields')</script>";
        }else{
                $sql = "INSERT INTO services ( usr_id, sp_id, sname,serv,uname,location,serv_status, rtime, rdate) VALUES ( '$userId', '$sess_sp_id','$sname', '$sess_serv', '$userData[uname]','$userData[location]','Requested', '$rtime', '$rdate')";
            if(mysqli_query($conn, $sql)){
                echo "<script>alert('Service Booked')</script>";
                echo "<script>window.location.href = './bookings.php';</script>";
            }
            else{
                echo "<script>alert('Something Went Wrong')</script>";
            }
        }
        unset($_SESSION['sess_sp_id']);
        unset($_SESSION['sess_serv']);
        unset($_SESSION['sname']);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Assets/Styles/style.css?v=<?php echo time(); ?>">
    <meta name="theme-color" content="#ffffff" />
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <link rel="icon" type="image/png" sizes="32x32" href="../Assets/Favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Assets/Favicons/favicon-16x16.png">
    <title>Infinity Services</title>
</head>

<body>
    <nav class="glass">
        <a href="#home"><img src="../Assets/Images/infinityLoop2.gif" class="navImg" alt=""></a>
            <ul>
            <li><a href='./profile.php'>Profile</a></li>
            <li><a href='./bookings.php'>Bookings</a></li>
            <li><a href='../logout.php'>Logout</a></li>
        </ul>
    </nav>
    <section class="mainSection">
        <div class="userDashBoardCardMainDiv">
        <?php
            if($spDataRows!=0){
                while($allServices = mysqli_fetch_assoc($unFIlteredSPData)){            
        ?>
        
            <div class="userDashBoardCard boxShadow1Hover">
                <div class="userDashBoardCardOverlay">
                    <div class="userDashBoardCardOverlaySub1">
                        <form class="userDashBoardCardOverlaySub1ButtonDiv" method="POST" action="">
                            <input type="hidden" name="sp_id" value="<?php echo"$allServices[id]"?>">
                            <input type="hidden" name="serv" value="<?php echo"$allServices[serv]"?>">
                            <input type="hidden" name="sname" value="<?php echo"$allServices[sname]"?>">
                            <button type="submit"  name="book_Id_Get" class="btn bookMySerId">Book my Service</button>
                            <p class="userDashboardCardStarMainP">5 <img src="../Assets/Images/star.png" class="userDashboardCardStar" alt=""></p>
                        </form>
                        <p class="userDashboardDescription"><?php echo"$allServices[sdesc]"?></p>
                    </div>
                    <div class="userDashBoardCardOverlaySub2">
                        <h2><?php echo"$allServices[sname]"?></h2>
                        <div class="userDashboardCardOverlayBottomDiv">
                            <p><?php echo"$allServices[serv]"?></p>
                            <p>₹<?php echo"$allServices[scharges]"?> Hour</p>
                        </div>
                    </div>
                </div>
                <img src="../Assets/Images/Services/<?php echo"$allServices[serv]"?>.gif" class="userDashBoardCardBgImg" alt="" />
            </div>
        <?php
                }
            }
        ?>
        </div>
        <?php if ($sp_id) { ?>
            <div class="userDashboardBookingTimeDiv glass">
                <form action="" method="POST" style="width:250px;margin:100px;">
                    <p>Booking Date</p>
                    <input class="inputBx boxShadow1Hover" type="date" name="rdate">
                    <p>Booking Time</p>
                    <input class="inputBx boxShadow1Hover" type="time" name="rtime">
                    <button type="submit" class="btn" name="book_a_service">Submit</button>
                </form>
            </div>
        <?php } ?>
    </section>

    <script src="../Assets/Scripts/script.js"></script>
</body>

</html>
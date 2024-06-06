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
        echo "<script>window.location.href = '../service-provider/profile.php';</script>";
    }

     // -------------------- Fetch user Id from dtabase --------------------
     mysqli_select_db($conn, 'infinity') or die(mysqli_error($conn));
     $unFIlteredSPData = mysqli_query($conn, "SELECT * FROM services WHERE sp_id = '$userId' ");
     $spDataRows = mysqli_num_rows($unFIlteredSPData);

     $checkDataUnfiltered = mysqli_query($conn, "SELECT * FROM sproviders WHERE id= '$userId'");
     $checkData = mysqli_fetch_array($checkDataUnfiltered);

     if(!$checkData){
        echo "<script>window.location.href = './account-setup.php';</script>";
     }

    //  ----------------------- Updating Status -----------------------
    if(isset($_POST['update_status'])){
        $serv_status = $_POST['serv_status'];
        $serv_id = $_POST['serv_id'];
        if($serv_status == ""){
            echo "<script>alert('Please select the status')</script>";
        }
        else{
            $update_status = mysqli_query($conn, "UPDATE services SET serv_status = '$serv_status' WHERE serv_id = '$serv_id' ");
            if($update_status){
                echo "<script>alert('Status updated successfully')</script>";
                // refresh page
                echo "<script>window.location.href = './bookings.php';</script>";
            }
            else{
                echo "<script>alert('Status not updated')</script>";
            }
        }
        
    }

    // ------------------------- Request new Time and Date -----------------------
    if(isset($_POST['change_booking_date_time'])){
        $serv_id = $_POST['serv_id'];
        $rdate = $_POST['rdate'];
        $rtime = $_POST['rtime'];
        $serv_status = "ChangedTime";
        if($rdate == "" || $rtime == ""){
            echo "<script>alert('Please select the date and time')</script>";
        }
        else{
            $update_status = mysqli_query($conn, "UPDATE services SET serv_status = '$serv_status', rdate = '$rdate', rtime = '$rtime' WHERE serv_id = '$serv_id' ");
            if($update_status){
                echo "<script>alert('Status updated successfully')</script>";
                echo "<script>window.location.href = './bookings.php';</script>";
            }
            else{
                echo "<script>alert('Status not updated')</script>";
            }
        }
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
            <li><a href='../logout.php'>Logout</a></li>
        </ul>
    </nav>
    <section class="mainSection">
        <h2 class="">Bookings</h2>
        <div class="userBookingsMainDiv">
            <?php
            if($spDataRows!=0){
                while($allServices = mysqli_fetch_assoc($unFIlteredSPData)){            
            ?>
            <div class="userBookingCard boxShadow1Hover <?php echo"$allServices[serv_status]"?>">    
                <?php if ("$allServices[ratings]" > 0) { ?>
                    <p class="userBookingRating">You got <?php echo"$allServices[ratings]"?> <img src="../Assets/Images/star.png" class="userBookingRatingImg" alt=""> Rating</p>
                <?php } ?>
                <div class="userBookingCardDiv1">
                    <p class="status <?php echo"$allServices[serv_status]"?>"><?php echo"$allServices[serv_status]"?></p>
                    <h2><?php echo"$allServices[uname]"?></h2>
                    <p><?php echo"$allServices[location]"?></p>
                </div>    
                <div class="userBookingCardDiv2">
                    <p><?php echo"$allServices[rdate]"?></p>
                    <p><?php echo"$allServices[rtime]"?></p>
                </div>  
                
                <!-- --------------------------------- Status Change --------------------------------------- -->
                <?php if ("$allServices[serv_status]" == "Requested") { ?>
                    <form class="userBookingCardDiv3" method="POST">
                        <p>Update Status</p>
                        <input type="hidden" name="serv_id" value="<?php echo"$allServices[serv_id]"?>">
                        <select name="serv_status" class="inputBx inputBxHalf">
                            <option value="">Select</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                        <button type="submit" name="update_status" class="btn">Update</button>
                    </form>   
                <?php } ?>

                 <!-- --------------------------------- Date Time Change --------------------------------------- -->
                 <?php if ("$allServices[serv_status]" == "Rejected") { ?>
                    <form class="userBookingCardDiv3" method="POST">
                        <p>Change Booking Date</p>
                        <input class="inputBx boxShadow1Hover" type="date" name="rdate"value="<?php echo"$allServices[rdate]"?>">
                        <p>Change Booking Time</p>
                        <input class="inputBx boxShadow1Hover" type="time" name="rtime"value="<?php echo"$allServices[rtime]"?>">
                        <input type="hidden" name="serv_id" value="<?php echo"$allServices[serv_id]"?>">
                        <button type="submit" class="btn" name="change_booking_date_time">Submit</button>
                    </form>   
                <?php } ?>
                
                <!-- --------------------------------- Status Change --------------------------------------- -->
                <?php if ("$allServices[serv_status]" == "Finished"||"$allServices[serv_status]" == "UnPaid") { ?>
                    <form class="userBookingCardDiv3" method="POST">
                        <p>Update Status</p>
                        <input type="hidden" name="serv_id" value="<?php echo"$allServices[serv_id]"?>">
                        <select name="serv_status" class="inputBx inputBxHalf">
                            <option value="">Select</option>
                            <option value="Paid" selected=<?php echo"$allServices[serv_status]"?>>Paid</option>
                            <option value="UnPaid" selected=<?php echo"$allServices[serv_status]"?>>Not Paid</option>
                        </select>
                        <button type="submit" name="update_status" class="btn">Update</button>
                    </form>   
                <?php } ?>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </section>

    <script src="../Assets/Scripts/script.js"></script>
</body>

</html>
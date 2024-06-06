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
     $unFIlteredSPData = mysqli_query($conn, "SELECT * FROM services WHERE usr_id = '$userId' ");
     $spDataRows = mysqli_num_rows($unFIlteredSPData);

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

    if(isset($_POST['update_rating'])){
        $ratings = $_POST['ratings'];
        $serv_id = $_POST['serv_id'];
        if($ratings == ""){
            echo "<script>alert('Please select the rating')</script>";
        }
        else{
            $update_rating = mysqli_query($conn, "UPDATE services SET ratings = '$ratings' WHERE serv_id = '$serv_id' ");
            if($update_rating){
                echo "<script>alert('Rating updated successfully')</script>";
                echo "<script>window.location.href = './bookings.php';</script>";
            }
            else{
                echo "<script>alert('Rating not updated')</script>";
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
            <li><a href='./'>Dashboard</a></li>
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
                <div class="userBookingCardDiv1">
                    <p class="status <?php echo"$allServices[serv_status]"?>"><?php echo"$allServices[serv_status]"?></p>
                    <h2><?php echo"$allServices[sname]"?></h2>
                    <p><?php echo"$allServices[serv]"?></p>
                </div>    
                <div class="userBookingCardDiv2">
                    <p><?php echo"$allServices[rdate]"?></p>
                    <p><?php echo"$allServices[rtime]"?></p>
                </div>  
                
                <!-- --------------------------------- Status Change --------------------------------------- -->
                <?php if ("$allServices[serv_status]" == "Accepted") { ?>
                    <form class="userBookingCardDiv3" method="POST">
                        <p>Update Status</p>
                        <input type="hidden" name="serv_id" value="<?php echo"$allServices[serv_id]"?>">
                        <select name="serv_status" class="inputBx inputBxHalf">
                            <option value="">Select</option>
                            <option value="Finished">Finished</option>
                        </select>
                        <button type="submit" name="update_status" class="btn">Update</button>
                    </form>   
                <?php } ?>
                
                <!-- --------------------------------- Status Change --------------------------------------- -->
                <?php if ("$allServices[serv_status]" == "ChangedTime") { ?>
                    <form class="userBookingCardDiv3" method="POST">
                        <p>Accept new time</p>
                        <input type="hidden" name="serv_id" value="<?php echo"$allServices[serv_id]"?>">
                        <select name="serv_status" class="inputBx inputBxHalf">
                            <option value="">Select</option>
                            <option value="Accepted">Accept</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                        <button type="submit" name="update_status" class="btn">Update</button>
                    </form>   
                <?php } ?>
                
                <!-- --------------------------------- Ratings Change --------------------------------------- -->
                <?php if ("$allServices[ratings]" == 0 && ("$allServices[serv_status]" == "Paid" ||"$allServices[serv_status]" == "Finished"||"$allServices[serv_status]" == "UnPaid")) { ?>
                    <form class="userBookingCardDiv3" method="POST">
                        <p>Rate your experience</p>
                        <input type="hidden" name="serv_id" value="<?php echo"$allServices[serv_id]"?>">
                        <select name="ratings" class="inputBx inputBxHalf">
                            <option value="">Select</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Star</option>
                            <option value="3">3 Star</option>
                            <option value="4">4 Star</option>
                            <option value="5">5 Star</option>
                        </select>
                        <button type="submit" name="update_rating" class="btn">Rate</button>
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
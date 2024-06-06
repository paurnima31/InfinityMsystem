<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <link rel="stylesheet" href="./Assets/Styles/style.css?v=<?php echo time(); ?>">
    <meta name="theme-color" content="#ffffff" />
    <link rel="icon" type="image/png" sizes="32x32" href="./Assets/Favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./Assets/Favicons/favicon-16x16.png">
    <title>Infinity Services Login</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./Assets/Favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./Assets/Favicons/favicon-16x16.png">
<title>Login @ Infinity</title>
</head>

<body>
    <section class="lsSection">
        <div class="lsModal boxShadow1">
            <div class="lsModalSec1">
                <div class="lsModalLogoDiv">
                    <img src="./Assets/Images/infinityLoop2.gif" class="lsModalLogo" alt="" />
                    <p>Infinity Services</p>
                </div>
                <div class="lsModelForm">
                    <h2>Login</h2>
                    <form action="" method="POST">
                        <input type="text" class="inputBx boxShadow1Hover" placeholder="Enter Username" name="user" />
                        <input type="password" class="inputBx boxShadow1Hover" placeholder="Enter Password" name="password" />
                        <div class="lsModelFormBottom">
                            <a href="register.php">Join with us</a>
                            <button class="btn boxShadow1" type="submit" name="login" value="login">Login</button>
                        </div>
                    </form>
                </div>
                <div class="lsModalTermsDiv">
                    <a>Terms</a>
                    <a>Privacy-Policy</a>
                </div>
            </div>
            <div class="lsModalSec2 lsModalSec2YelloBg">
                <img src="./Assets/Images/lsImg4.gif" alt="" />
            </div>
        </div>
    </section>
    <script src="./Assets/Scripts/script.js"></script>
</body>
<?php
if (isset($_POST['login'])) {
    if (!empty($_POST['user']) && !empty($_POST['password'])) {
        $usr = strtolower($_POST['user']);
        $pswd = $_POST['password'];
        include('conn.php');
        mysqli_select_db($conn, 'infinity') or die(mysqli_error($conn));
        $query = mysqli_query($conn, "SELECT * FROM login WHERE `user_id`='{$usr}'");
        $numrows = mysqli_num_rows($query);
        if ($numrows != 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $db_user = $row['user_id'];
                $db_pswd = $row['password'];
                $db_stype = $row['stype'];
                $id = $row['id'];
            }
            if ($db_pswd == $pswd && $db_user == $usr) {
                session_start();
                
                // ---------------- Starting session for Id and Role ----------------
                $_SESSION['sess_id'] = $id;
                $_SESSION['sess_stype'] = $db_stype;
                
               switch($db_stype){
                   case'user':header("location:user/");
                   break;
                   case'admin':header("location:admin/");
                   break;
                   case'sp':header("location:service-provider/bookings.php");
                   break;
               }
            } else {
                echo '<script>';
                echo 'alert("Invalid Creditentials")';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'alert("Please Signup First")';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo ' alert("All fields are required")';
        echo '</script>';
    }
}
?>
</html>

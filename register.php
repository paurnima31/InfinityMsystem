<?php
    include('conn.php');
    if (isset($_POST['register'])) {
      if (!empty($_POST['user']) && !empty($_POST['password']) && !empty($_POST['stype'])) {
        $user = strtolower($_POST['user']);
        $pass = $_POST['password'];
        $stype = strtolower($_POST['stype']);
        mysqli_select_db($conn, 'infinity') or die(mysqli_error($conn));
        $query = mysqli_query($conn, "SELECT * FROM login WHERE user_id='$user'");
        $numrows = mysqli_num_rows($query);
        if ($numrows == 0) {
          $query = mysqli_query($conn, "INSERT INTO login(id,user_id,password,stype) VALUES ('','$user','$pass','$stype')");
          if ($query) {
            echo '<script>';
            echo 'alert("User Registered Successfully")';
            echo '</script>';
            echo "<script>window.location.href='login.php'</script>";
          } else {
            echo '<script>';
            echo 'alert("Registration Failed")';
            echo '</script>';
          }
        } else {
          echo '<script>';
          echo 'alert("Username already Taken")';
          echo '</script>';
        }
      } else {
        echo '<script>';
        echo ' alert("All fields are required")';
        echo '</script>';
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
  <link rel="stylesheet" href="./Assets/Styles/style.css?v=<?php echo time(); ?>">
  <meta name="theme-color" content="#ffffff" />
  <link rel="icon" type="image/png" sizes="32x32" href="./Assets/Favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./Assets/Favicons/favicon-16x16.png">
  <title>Register @ Infinity</title>
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
          <h2>Register</h2>
          <form action="" method="POST" name="reg_form">
            <input type="text" class="inputBx boxShadow1Hover" placeholder="Enter Username" name="user" />
            <input type="password" class="inputBx boxShadow1Hover" placeholder="Enter Password" name="password" />
            <select class="inputBx boxShadow1Hover" name="stype">
              <option value="user"selected>User</option>
              <option value="sp">Service Provider</option>
            </select>
            <div class="lsModelFormBottom">
              <a href="login.php">Already a Member ?</a>
              <button class="btn boxShadow1" type="submit" name="register" value="register">Register</button>
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

</html>
<?php
     //  ----------------- Include Connection file --------------------
     include ("../conn.php");

     //  ----------------- Session start --------------------
     session_start();
     $sType = $_SESSION['sess_stype'];
     
     //------------------------- if not authenticated redirect to login page --------------------
    if(!isset($_SESSION['sess_id'])){
        echo "<script>window.location.href = '../login.php';</script>";
    } 
    
    // -------------------- specific user can access only his profile --------------------
    if($sType != 'admin'){
        echo "<script>window.location.href = '../login.php';</script>";
    }

     // -------------------- Fetch user Id from dtabase --------------------
     mysqli_select_db($conn, 'infinity') or die(mysqli_error($conn));
     $totalOrdersUnfiltered = mysqli_query($conn, "SELECT * FROM services");
     $totalOrders = mysqli_num_rows($totalOrdersUnfiltered);

     $finishedOrdersUnfiltered = mysqli_query($conn, "SELECT * FROM services WHERE serv_status = 'Paid'");
     $finishedOrders = mysqli_num_rows($finishedOrdersUnfiltered);

     $unpaidOrdersUnfiltered = mysqli_query($conn, "SELECT * FROM services WHERE serv_status = 'UnPaid'");
     $unpaidOrders = mysqli_num_rows($unpaidOrdersUnfiltered);

     $totalUsersUnfiltered = mysqli_query($conn, "SELECT * FROM users");
     $totalUsers = mysqli_num_rows($totalUsersUnfiltered);

     $totalsprovidersUnfiltered = mysqli_query($conn, "SELECT * FROM sproviders");
     $totalsproviders = mysqli_num_rows($totalsprovidersUnfiltered);

    //  --------------------- Download CSV file --------------------
    if(isset($_POST['download_report'])){
        $list = array(
            ['Total Orders', 'Finished Orders', 'Paid Orders','Unpaid Orders', 'Total Users', 'Total Providers'],
            [$totalOrders, $finishedOrders, $finishedOrders, $unpaidOrders, $totalUsers, $totalsproviders]
        );
        $fp = fopen('../Reports/Total Reports.csv', 'w');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        // --------------------------- Download file -------------------------
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename('../Reports/Total Reports.csv').'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../Reports/Total Reports.csv'));
        readfile('../Reports/Total Reports.csv');
        exit;
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
    <title>Admin</title>
</head>
<body>
    <nav class="glass">
        <a href="#home"><img src="../Assets/Images/infinityLoop2.gif" class="navImg" alt=""></a>
        <ul>
            <li><a href='./orders.php'>Orders</a></li>
            <li><a href='./service-providers.php'>Service Providers</a></li>
            <li><a href='./users.php'>Users</a></li>
            <li><a href='../logout.php'>Logout</a></li>
        </ul>
    </nav>
    <section class="mainSection adminDashboardMainDiv">
        <form method="POST">
            <button class="btn" name="download_report">Download Report</button>
        </form>
        <div class="adminDashboardMainCardDiv">
            <a href="./orders.php" class="adminDashboardCard Finished boxShadow1Hover">
                <h3>Total Orders</h3>
                <h1><?php echo"$totalOrders"?></h1>
            </a>
            <a href="./orders.php" class="adminDashboardCard Accepted boxShadow1Hover">
                <h3>Finished Orders</h3>
                <h1><?php echo"$finishedOrders"?></h1>
            </a>
            <a href="./orders.php" class="adminDashboardCard Paid boxShadow1Hover">
                <h3>Paid Orders</h3>
                <h1><?php echo"$finishedOrders"?></h1>
            </a>
            <a href="./orders.php" class="adminDashboardCard UnPaid boxShadow1Hover">
                <h3>UnPaid Orders</h3>
                <h1><?php echo"$unpaidOrders"?></h1>
            </a>
            <a href="./users.php" class="adminDashboardCard Rejected boxShadow1Hover">
                <h3>Total Users</h3>
                <h1><?php echo"$totalUsers"?></h1>
            </a>
            <a href="./service-providers.php" class="adminDashboardCard Finished boxShadow1Hover">
                <h3>Total Service Providers</h3>
                <h1><?php echo"$totalsproviders"?></h1>
            </a>
        </div>
    </section>
    <script src="../Assets/Scripts/script.js"></script>
</body>
</html>
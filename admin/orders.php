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
     $unFIlteredSPData = mysqli_query($conn, "SELECT * FROM services");
     $spDataRows = mysqli_num_rows($unFIlteredSPData);

    if(isset($_POST['download_report'])){
        if($spDataRows > 0){
            $list = array(
                ['Date', 'User Name', 'Service', 'Service Provider', 'Location', 'Ratings', 'Status'],
            );
            $fp = fopen('../Reports/Service Provider Reports.csv', 'w');
            foreach ($list as $fields) {
                fputcsv($fp, $fields);
            }
            while($row = mysqli_fetch_assoc($unFIlteredSPData)){
                $list = array(
                    [$row['rdate'], $row['uname'], $row['serv'], $row['sname'], $row['location'], $row['ratings'], $row['serv_status']],
                );
                foreach ($list as $fields) {
                    fputcsv($fp, $fields);
                }
            }
            fclose($fp);
            // --------------------------- Download file -------------------------
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename('../Reports/Service Provider Reports.csv').'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('../Reports/Service Provider Reports.csv'));
            readfile('../Reports/Service Provider Reports.csv');
            exit;
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
    <title>Admin</title>
</head>
<body>
    <nav class="glass">
        <a href="#home"><img src="../Assets/Images/infinityLoop2.gif" class="navImg" alt=""></a>
        <ul>
            <li><a href='./'>Dashboard</a></li>
            <li><a href='./service-providers.php'>Service Providers</a></li>
            <li><a href='./users.php'>Users</a></li>
            <li><a href='../logout.php'>Logout</a></li>
        </ul>
    </nav>
    <section class="mainSection adminDashboardMainDiv">
        <form method="POST">
            <button class="btn" name="download_report">Download Report</button>
        </form>
        <div class="adminTableMainDiv">
            <h2 class="adminTableHeading">Orders</h2>
            <table class="adminTable boxShadow1Hover">
                <thead class="boxShadow1Hover Paid">
                    <tr>
                        <th>Date</th>
                        <th>User Name</th>
                        <th>Service</th>
                        <th>Service Provider</th>
                        <th>Location</th>
                        <th>Ratings</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($spDataRows!=0){
                        while($allServices = mysqli_fetch_assoc($unFIlteredSPData)){            
                    ?>
                        <tr>
                            <td><?php echo"$allServices[rdate]" ?></td>
                            <td><?php echo"$allServices[uname]" ?></td>
                            <td><?php echo"$allServices[serv]" ?></td>
                            <td><?php echo"$allServices[sname]" ?></td>
                            <td><?php echo"$allServices[location]" ?></td>
                            <td><?php echo"$allServices[ratings]" ?> star</td>
                            <td class="tableStatus"><span class="<?php echo"$allServices[serv_status]" ?>"><?php echo"$allServices[serv_status]" ?></span></td>
                        </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="../Assets/Scripts/script.js"></script>
</body>
</html>
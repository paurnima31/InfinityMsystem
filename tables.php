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
    <link rel="icon" type="image/png" sizes="32x32" href="../Assets/Favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Assets/Favicons/favicon-16x16.png">
    <meta name="theme-color" content="#ffffff">
    <title>Tables</title>
</head>

<body>
<section class="mainSection adminDashboardMainDiv">

        <div class="adminTableMainDiv">
            <h2 class="adminTableHeading">Login</h2>
            <table class="adminTable boxShadow1Hover">
                <thead class="boxShadow1Hover Paid">
                    <tr>
                        <th>Field Name</th>
                        <th>Data Type</th>
                        <th>Constrains</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>Int</td>
                        <td></td>
                        <td>Id of table</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td>Varchar</td>
                        <td>Primary Key</td>
                        <td>Unique id for username</td>
                    </tr>
                    <tr>
                        <td>password</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Password of the username</td>
                    </tr>
                    <tr>
                        <td>stype</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Role of user</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="adminTableMainDiv">
            <h2 class="adminTableHeading">Services</h2>
            <table class="adminTable boxShadow1Hover">
                <thead class="boxShadow1Hover Paid">
                    <tr>
                        <th>Field Name</th>
                        <th>Data Type</th>
                        <th>Constrains</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>serv_id</td>
                        <td>Int</td>
                        <td>Primary Key</td>
                        <td>Id of Service</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td>Int</td>
                        <td></td>
                        <td>User Id</td>
                    </tr>
                    <tr>
                        <td>sp_id</td>
                        <td>Int</td>
                        <td></td>
                        <td>Service Provider Id</td>
                    </tr>
                    <tr>
                        <td>sname</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Service provider name</td>
                    </tr>
                    <tr>
                        <td>uname</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>User name</td>
                    </tr>
                    <tr>
                        <td>location</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Location of user</td>
                    </tr>
                    <tr>
                        <td>serv_status</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Status of word done</td>
                    </tr>
                    <tr>
                        <td>ratings</td>
                        <td>Int</td>
                        <td></td>
                        <td>Ratings of the service done</td>
                    </tr>
                    <tr>
                        <td>rdate</td>
                        <td>Int</td>
                        <td></td>
                        <td>Booked Date by user</td>
                    </tr>
                    <tr>
                        <td>rtime</td>
                        <td>Int</td>
                        <td></td>
                        <td>Booked Time by user</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="adminTableMainDiv">
            <h2 class="adminTableHeading">Service Provider</h2>
            <table class="adminTable boxShadow1Hover">
                <thead class="boxShadow1Hover Paid">
                    <tr>
                        <th>Field Name</th>
                        <th>Data Type</th>
                        <th>Constrains</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>Int</td>
                        <td>Primary Key</td>
                        <td>Id of service provider</td>
                    </tr>
                    <tr>
                        <td>sname</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Name of service provider</td>
                    </tr>
                    <tr>
                        <td>smail</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Email of service provider</td>
                    </tr>
                    <tr>
                        <td>smob</td>
                        <td>Int</td>
                        <td></td>
                        <td>Mobile number of service provider</td>
                    </tr>
                    <tr>
                        <td>serv</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Service of service provider</td>
                    </tr>
                    <tr>
                        <td>slocation</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Location of service provider</td>
                    </tr>
                    <tr>
                        <td>stime</td>
                        <td>Time</td>
                        <td></td>
                        <td>Starting working of service provider</td>
                    </tr>
                    <tr>
                        <td>etime</td>
                        <td>Time</td>
                        <td></td>
                        <td>Ending working of service provider</td>
                    </tr>
                    <tr>
                        <td>scharges</td>
                        <td>Int</td>
                        <td></td>
                        <td>Charges of service provider</td>
                    </tr>
                    <tr>
                        <td>sdesc</td>
                        <td>Text</td>
                        <td></td>
                        <td>Description of service provider</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="adminTableMainDiv">
            <h2 class="adminTableHeading">Users</h2>
            <table class="adminTable boxShadow1Hover">
                <thead class="boxShadow1Hover Paid">
                    <tr>
                        <th>Field Name</th>
                        <th>Data Type</th>
                        <th>Constrains</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>Int</td>
                        <td></td>
                        <td>Id of user</td>
                    </tr>
                    <tr>
                        <td>uname</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Name of user</td>
                    </tr>
                    <tr>
                        <td>umail</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Email of user</td>
                    </tr>
                    <tr>
                        <td>umob</td>
                        <td>Bigint</td>
                        <td></td>
                        <td>Mobile number of user</td>
                    </tr>
                    <tr>
                        <td>location</td>
                        <td>Varchar</td>
                        <td></td>
                        <td>Location of user</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </section>
    <script src="../Assets/Scripts/script.js"></script>
</body>

</html>
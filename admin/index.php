<?php
session_start();
require_once "includes/db_connect.php";
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtreme Fitness|Admin</title>
    <link rel="stylesheet" href="css/mystyle.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php
        $activemenu = "home";
        include('includes/menu.php');

        $fNameQuery = "SELECT user_details.firstname FROM user_details WHERE email='" . $_SESSION['username'] . "'";
        $nameResult = $conn->query($fNameQuery);
        $fName = $nameResult->fetch(PDO::FETCH_ASSOC);

        $monthlyQuery = "SELECT * FROM membership WHERE type='monthly'";
        $monthlyResult = $conn->query($monthlyQuery);
        $monthly = 0;
        while ($monthlyResult->fetch()) {
            $monthly++;
        }

        $yearlyQuery = "SELECT * FROM membership WHERE type='yearly'";
        $yearlyResult = $conn->query($yearlyQuery);
        $yearly = 0;
        while ($yearlyResult->fetch()) {
            $yearly++;
        }

        $percentageMonthly = ($monthly / ($monthly + $yearly)) * 100;
        $percentageYearly = ($yearly / ($monthly + $yearly)) * 100;
        ?>
        <main>
            <h1>Xtreme Fitness Dashboard</h1>
            <div class="date">
                <?php
                echo date("l") . " " . date("d/m/y");
                ?>
            </div>

            <div class="insights">
                <!---monthly users----->
                <div class="sales">
                    <span class="material-icons-sharp">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Monthly users</h3>
                            <h1><?php echo $monthly; ?></h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p><?php echo round($percentageMonthly, 1) . " %"; ?></p>
                            </div>
                        </div>

                    </div>

                    <small class="text-muted">Last 24h</small>
                </div>
                <!--- end monthly users----->


                <!---yearly users----->
                <div class="expenses">
                    <span class="material-icons-sharp">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Yearly users</h3>
                            <h1><?php echo $yearly; ?></h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p><?php echo round($percentageYearly, 1) . " %"; ?></p>
                            </div>
                        </div>

                    </div>

                    <small class="text-muted">Last 24h</small>
                </div>
                <!--- end yearly users----->

                <!---total users----->
                <div class="income">
                    <span class="material-icons-sharp">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total users</h3>
                            <h1><?php echo $yearly + $monthly; ?></h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>100%</p>
                            </div>
                        </div>

                    </div>

                    <small class="text-muted">Last 24h</small>
                </div>
                <!--- end total users----->

            </div>
            <!----end of insights---------->

            <div class="recent-orders">
                <h2>Payments</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $paymentQuery = "SELECT membership.type,membership.membership_end,user_details.firstname,user_details.lastname
                                            FROM membership,user_details
                                            WHERE membership.email=user_details.email
                                            ORDER BY membership.membership_end";
                            $paymentResult = $conn->query($paymentQuery);
                            while ($value = $paymentResult->fetch()) { 
                                $date=$value['membership_end'];
                                if((($date>=date("Y-m-d")) && ($date<=date('Y-m-d', strtotime('+7 day', strtotime($date))))) || ($date<date("Y-m-d")))
                                {?>
                                    <tr>
                                        <td><?php echo $value['firstname']." ".$value['lastname'];?></td>
                                        <td><?php echo $value['membership_end'];?></td>
                                        <td><?php if($value['type']=="monthly")
                                            {
                                                echo "Rs 1149.00";
                                            }
                                            else
                                            {
                                                echo "Rs 1049.00";
                                            }
                                        ?></td>
                                        <?php if ($date<date("Y-m-d")){
                                            echo '<td class="danger">Due</td>';
                                        }
                                        else{
                                            echo '<td class="warning">Pending</td>';
                                        }
                                            ?>
                                            <td class="primary">Details</td>
                                    </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
                <a href="#">Show All</a>
            </div>

        </main>


        <div class="right">
            <div class="top">

                <div class="profile">
                    <div class="info">
                        <p><b><?php echo $fName['firstname']; ?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <span class="material-icons-sharp">account_circle</span>
                    </div>
                </div>
            </div>

            <!------------end of top---->
            <div class="recent-updates">
                <h2>Recent Comments</h2>
                <div class="updates">
                    <?php
                    $recentQuery = "SELECT review.review_id,review.date_posted,review.rating,review.comment,user_details.firstname,user_details.lastname
                                    FROM review,user_details
                                    WHERE review.member_mail=user_details.email
                                    ORDER BY date_posted DESC
                                    LIMIT 3";
                    $recentResult = $conn->query($recentQuery);
                    while ($value = $recentResult->fetch()) { ?>
                
                    <div class="update">
                        <div class="profile-photo">
                            <span class="material-icons-sharp">account_circle</span>
                        </div>
                        <div class="message">
                            <p><b><?php echo $value['firstname']." ".$value['lastname'];?></b> <?php echo $value['comment'];?></p>
                            <small class="text-muted"><?php echo $value['date_posted']; ?></small>
                        </div>
                    </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
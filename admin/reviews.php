<?php
session_start();
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
    <style>
        aside{
            width: 280px;
            display: inline-block;
            margin-left: 30px;
        }
        .title{
            display: inline-block;
            position: relative;
            left:20px;
            bottom: 100px;
        }
        .date{
            background:var(--color-light);
            border-radius: var(--border-radius-1);
            padding: 0.5rem 1.6rem;
            position: relative;
            right:90px;
            bottom: 50px;
        }
    </style>
</head>

<body>
        <?php
        $activemenu="reviews";
        include('includes/menu.php');
        ?>
        <h1 class="title">Reviews</h1>
        <div class="date" style="display:inline-block;">
                <?php 
                    echo date("l")." ".date("d/m/y");
                ?>
        </div>
        <table class="reviews">
            
        </table>
</body>
</html>
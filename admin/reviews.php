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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        .reviews{
            display: inline-block;
            position: relative;
            right:250px;
        }
        .reviews table{
            border: 1px solid #dcdcdc;
            border-radius: 2rem;
            background-color: #f6f6f9;
            margin-right: 20px;
            box-shadow: 0 2rem 3rem rgba(132,139,200,0.18);
            border-spacing: 0;
            font-size: 18px;
            padding: 1.8rem;
            margin: auto;
            text-align: center;
        }
        .reviews table th{
            padding-bottom: 10px;
            font-size: 16px;
        }
        .reviews table th,td{
            padding: 0 70px;
        }
        .reviews table tbody td{
            font-size: 14px;
            padding: 20px 0;
            color:#363949;
            border-bottom: 1px solid #363949;
        }
        .reviews tbody tr:last-child td{
            border:none;
        }
        .reviews .review_cell{
            width: 200px;
        }
        .reviews .action_btn{
            cursor: pointer;
            margin-right: 5px;
            width: 90px;
            height: 25px;
            font-size: 16px;
            color:#363949;
            font-family: poppins,sans-serif;
            border: 1px solid #363949;
            border-radius: 12px;
        }
        .reviews .flagBtn:hover{
            border: 1px solid #32cd32;
            background-color: #32CD32;
            color: white;
        }
        .reviews .banBtn:hover{
            border:1px solid red;
            background-color: red;
            color: white;
        }
    </style>
    <script>
        function flag(id)
        {
            $.ajax({
                url:"reviewsAjax.php",
                method:"POST",
                data:{action:"unflag",review_id:id},
                error:function(xhr)
                {
                    alert(xhr.statusText);
                },
                success:function()
                {
                    var row=$('#flagBtn'+id).parent().parent();
                    row.fadeOut(300,function(){
                        row.remove();
                        var count=$("#revCount").text();
                        count--;
                        if(count==0)
                        {
                            $("#revCount").remove();
                        }
                        else
                        {
                            $("#revCount").text(count);
                        }
                    });
                }
            });
        }
        function ban(id)
        {
            $.ajax({
                url:"reviewsAjax.php",
                method:"POST",
                data:{action:"ban",review_id:id},
                error:function(xhr)
                {
                    alert(xhr.statusText);
                },
                success:function()
                {
                    var row=$('#flagBtn'+id).parent().parent();
                    row.fadeOut(300,function(){
                        row.remove();
                        var count=$("#revCount").text();
                        count--;
                        if(count==0)
                        {
                            $("#revCount").remove();
                        }
                        else
                        {
                            $("#revCount").text(count);
                        }
                        
                    });
                }
            });
        }
    </script>
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
       <div class="reviews">
        <h2>Flagged reviews:</h2>
        <table>
            <thead>
                <tr>
                <th>Review</th>
                <th>Posted By</th>
                <th>Posted On</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql="SELECT r.*,u.firstname,u.lastname FROM review r,user_details u WHERE r.member_mail=u.email AND flag='1'";
                    $Result=$conn->query($sql);
                    while($row=$Result->fetch())
                    {
                        ?>
                        <tr>
                        <td class="review_cell"><?php echo $row['comment']; ?></td>
                        <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                        <td><?php echo $row['date_posted']; ?></td>
                        <td>
                        <button type="button" class="action_btn flagBtn" <?php echo "id=flagBtn".$row['review_id']; ?> onclick="flag(<?php echo $row['review_id']; ?>)"><i class="bi bi-flag-fill"></i> Unflag</button><br>
                        </td>
                        <td>
                            <button type="button" class="action_btn banBtn" <?php echo "id=banBtn".$row['review_id']; ?> onclick="ban(<?php echo $row['review_id']; ?>)"><i class="bi bi-slash-circle-fill"></i> Ban</button>
                        </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
       </div>
</body>
</html>
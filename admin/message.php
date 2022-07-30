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
            right:115px;
            bottom: 50px;
        }
        .reviews{
            display: inline-block;
            position: relative;
            left: 320px;
            bottom: 80%;
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
            padding: 0 50px;
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
        .reviews .readBtn{
            width: 120px;
        }
        .reviews .readBtn:hover{
            border: 1px solid #87ceeb;
            background-color: #87ceeb;
            color: white;
        }
        .reviews .replyBtn:hover{
            border:1px solid #32CD32;
            background-color: #32CD32;
            color: white;
        }
    </style>
    <script>
        function read(id)
        {
            var email=$('#row'+id+" td:nth-child(3)").text();
            var date=$('#row'+id+" td:nth-child(4)").text();
            $.ajax({
                url:"msgAjax.php",
                method:"POST",
                data:{mail:email,date_posted:date},
                error:function(xhr)
                {
                    alert(xhr.statusText);
                },
                success:function()
                {
                    $("#row"+id).fadeOut(300,function(){
                        $("#row"+id).remove();
                        var count=$("#msgCount").text();
                        count--;
                        if(count==0)
                        {
                            $("#msgCount").remove();
                        }
                        else
                        {
                            $("#msgCount").text(count);
                        }
                    });
                }
            });

        }
    </script>
</head>

<body>
        <?php
        $activemenu="message";
        include('includes/menu.php');
        ?>
         <h1 class="title">Messages</h1>
        <div class="date" style="display:inline-block;">
                <?php 
                    echo date("l")." ".date("d/m/y");
                ?>
        </div>
        <div class="reviews">
        <h2>Unread Messages:</h2>
        <table>
            <thead>
                <tr>
                <th>Message</th>
                <th>Sent By</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Posted On</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql="SELECT * FROM contact_us WHERE msg_read='0'";
                    $Result=$conn->query($sql);
                    $count=1;
                    while($row=$Result->fetch())
                    {
                        ?>
                        <tr <?php echo "id=row".$count; ?>>
                        <td class="review_cell"><?php echo $row['message']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['tel_no']; ?></td>
                        <td><?php echo $row['date_posted']; ?></td>
                        <td>
                        <button type="button" class="action_btn readBtn" <?php echo "id=readBtn".$count; ?> onclick="read(<?php echo $count; ?>)"><i class="bi bi-flag-fill"></i> Mark as read</button><br>
                        </td>
                        <td>
                            <button type="button" class="action_btn replyBtn" <?php echo "id=replyBtn".$count; ?>><i class="bi bi-slash-circle-fill"></i> <a href="https://mail.google.com/mail/u/0/#inbox?compose=new" target="_blank">Reply</a></button>
                        </td>
                        </tr>
                        <?php
                        $count++;
                    }
                ?>
            </tbody>
        </table>
       </div>
</body>
</html>
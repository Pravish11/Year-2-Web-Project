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
            right:145px;
            bottom: 50px;
        }
        .search{
        display: inline-block;
        position: relative;
        left: 70px;
        text-align: center;
        top:200px;
       }
       .search input{
        border:2px solid var(--color-info-dark);
        border-radius: 15px;
        height: 30px;
        width: 250px;
        padding: 10px;
        display: block;
        margin:auto;
       }
       .search button{
        position: relative;
        left: 140px;
        bottom: 26px;
        cursor: pointer;
       }
       .search #searchIcon {
        font-size: 23px;
        background: var(--color-background);
       }
       .start_btn{
            display: block;
            margin: auto;
            position: relative;
            top:250px;
            right:230px;
            margin-bottom: 10px;
            width: 370px;
            height: 50px;
            border: 2px solid var(--color-info-dark);
            outline: none;
            border-radius: 6px;
            background-color: transparent;
            font-size: 30px;
            
            font-family: poppins,sans-serif;
            color:var(--color-info-dark);
            cursor: pointer;
        }
        .start_btn:hover{
            background-color: var(--color-info-dark);
            color:whitesmoke;
        }
        #delBtn{
            border:1px solid red;
            color:red;
        }
        #delBtn:hover{
            background-color: red;
            color: white;
        }
        .resetPassword{
            font-size: 18px;
            position: relative;
            right:200px;
            top:200px;
        }
        .resetPassword input{
            width: 200px;
            height: 23px;
            border:1px solid var(--color-info-dark);
            border-radius: 10px;
            padding: 5px;
        }
        .passwordBtn{
            border: 2px solid var(--color-info-dark);
            outline: none;
            width: 100px;
            margin-top: 5px;
            border-radius: 20px;
            background-color: transparent;
            font-size: 18px;
            font-family: poppins,sans-serif;
            color:var(--color-info-dark);
            cursor: pointer;
            
        }
        .resetPassword .passwordBtn{
            position: relative;
            left: 100px;
        }
        #pw_cancel_btn:hover,#pay_cancel_btn:hover,#delNoBtn:hover{
            background-color: var(--color-info-dark);
            color:whitesmoke;
        }
        #pw_confirm_btn:hover,#pay_confirm_btn:hover{
            border: 1px solid #32cd32;
            background-color: #32cd32;
            color:whitesmoke;
        }
        .payment{
            font-size: 18px;
            border:1px solid var(--color-info-dark);
            border-radius: 10px;
            padding:30px;
            position: relative;
            right: 200px;
            top:200px;
        }
        .payment input{
            width: 200px;
            height: 23px;
            border:1px solid var(--color-info-dark);
            border-radius: 10px;
            padding: 5px;
        }
        .payment button{
            position: relative;
            left: 60px;
        }
        .delConfirm{
            position: relative;
            left: 398px;
            bottom: 52%;
            text-align: center;
            font-size: 18px;
            border:1px solid red;
            padding: 10px;
            border-radius: 10px;
            background-color: white;
            width: 370px;
        }
        .delConfirm #delYesBtn:hover{
            border:1px solid red;
            background-color: red;
            color: white;
        }
    </style>
    <script>
        $(document).ready(function(){
            //$('.search').hide();
            $("#error_msg").hide();
            $('.btns').hide();
            $('.delConfirm').hide();
            $('.resetPassword').hide();
            $('.payment').hide();
            $("#search_btn").click(function(){
                var mail=$(".search input[name='search_mail']").val();
                $.ajax({
                    url:"usersAjax.php",
                    method:"POST",
                    data:{action:"search",email:mail},
                    error:function(xhr)
                    {
                        alert(xhr.statusText);
                    },
                    success:function(data)
                    {
                        if(data)
                        {
                            $("input[name='user_email']").val(mail);
                            $('.search').fadeOut(300,function(){
                                $(".search input[name='search_mail']").val("");
                                $(".btns").fadeIn();
                            });
                        }
                        else
                        {

                            $("#error_msg").show();
                        }
                    }

                });
            });
            $("#resetBtn").click(function(){
                $(".btns").fadeOut(300,function(){
                    $(".resetPassword").fadeIn();
                });
            });
            $("#pw_cancel_btn").click(function(){
                $(".resetPassword input").val("");
                $(".resetPassword").fadeOut(300,function(){
                    $(".btns").fadeIn();
                });
            });
            $("#pw_confirm_btn").click(function(){
                var mail=$("input[name='user_email']").val();
                var pw=$(".resetPassword input[name='txt_password']").val();
                alert(pw);
                $.ajax({
                    url:"usersAjax.php",
                    method:"POST",
                    data:{action:"reset",email:mail,password:pw},
                    error:function(xhr)
                    {
                        alert(xhr.statusText);
                    },
                    success:function()
                    {
                        $(".resetPassword input").val("");
                        $(".resetPassword").fadeOut(300,function(){
                            $(".btns").fadeIn();
                         });
                    }
                }); 
            });
            $(".resetPassword input[name='confirm_pass']").keyup(function(){
                var pw=$(".resetPassword input[name='txt_password']").val();
                var cpw=$(this).val();
                if(pw!="")
                {
                    if(pw!=cpw)
                    {
                        $(this).css("border","1px solid red");
                    }
                    else
                    {
                        $(this).css("border","1px solid #32cd32");
                    }
                }
            });
            $("#paymentBtn").click(function(){
                var mail=$("input[name='user_email']").val();
                $.ajax({
                    url:"userPaymentDetailAjax.php",
                    method:"POST",
                    data:{email:mail},
                    error:function(xhr)
                    {
                        alert(xhr.statusText);
                    },
                    success:function(data)
                    {
                        $(".payment").html(data);
                        $(".btns").fadeOut(300,function(){
                            $(".payment").fadeIn();
                        });
                    }
                });
            });
            $(document).on("keyup",".payment input[name='noMonths']",function(){
                var x=$(".payment input[name='noMonths']").val();
                var total=x*1149;
                $(".payment input[name='amount']").val(total+".00");
            });
            $(document).on("click","#pay_confirm_btn",function(){
                var mail=$("input[name='user_email']").val();
                var a=$(".payment input[name='amount']").val();
                var num=$(".payment input[name='noMonths']").val();
                var mEnd=$(".payment span").text();
                $.ajax({
                    url:"usersAjax.php",
                    method:"POST",
                    data:{action:"payment",email:mail,amount:a,months:num,membership_end:mEnd},
                    error:function(xhr)
                    {
                        alert(xhr.statusText);
                    },
                    success:function(data)
                    {
                        $(".payment input").val("");
                        $(".payment").fadeOut(300,function(){
                            $(".btns").fadeIn();
                        });
                    }
                }); 
            });
            $(document).on("click","#pay_cancel_btn",function(){
                $(".payment input").val("");
                $(".payment").fadeOut(300,function(){
                    $(".btns").fadeIn();
                });
            });
            $("#delBtn").click(function(){
                $(".delConfirm").fadeIn();
            });
            $(".delConfirm #delNoBtn").click(function(){
                $(".delConfirm").fadeOut();
            });
            $(".delConfirm #delYesBtn").click(function(){
                var mail=$("input[name='user_email']").val();
                $.ajax({
                    url:"usersAjax.php",
                    method:"POST",
                    data:{action:"delete",email:mail},
                    error:function(xhr)
                    {
                        alert(xhr.statusText);
                    },
                    success:function()
                    {
                        $(".delConfirm").fadeOut();
                        $(".btns").fadeOut(function(){
                            $(".search").fadeIn();
                        })
                    }
                });
            });
        });
    </script>
</head>

<body>
    <?php
        $activemenu="users";
        include('includes/menu.php');
    ?>
     <h1 class="title">User Section</h1>
    <div class="date" style="display:inline-block;">
    <?php 
        echo date("l")." ".date("d/m/y");
    ?>
    </div>
    <div class="search">
        <h2>Enter the customer email</h2>
        <input type="text" name="search_mail">
        <button id="search_btn" type="button"><i id="searchIcon" class="bi bi-search"></i></button><br><br><br><br>
        <h3 style="font-size:15px;"id="error_msg">No user found. Please try again</h3>
    </div>
    <input type="hidden" name="user_email">
    <div class="btns" style="margin-left:15%; display:inline-block;">
        <button class="start_btn" id="resetBtn"><i class="bi bi-arrow-clockwise"></i> Reset Password</button>
        <button class="start_btn" id="paymentBtn"><i class="bi bi-cash-coin"></i> Make Payment</button>
        <button class="start_btn" id="delBtn"><i class="bi bi-person-x-fill"></i> Delete User</button>
    </div>
    <div class='delConfirm' style="margin-left:15%; display:inline-block;">
        <label>Are you sure?</label><br>
        <button class="passwordBtn" id="delYesBtn">Yes</button>
        <button class="passwordBtn" id="delNoBtn">No</button>
    </div>
    <div class="resetPassword" style="margin-left:15%;display:inline-block;">
        <label for="">New Password:</label>
        <input type="password" name="txt_password"><br>
        <label for="">Confirm Password:</label>
        <input type="password" name="confirm_pass"><br>
        <button type="button" class="passwordBtn" id="pw_cancel_btn">Cancel</button>
        <button type="button" class="passwordBtn" id="pw_confirm_btn">Confirm</button>
    </div>
    <div class="payment" style='margin-left:15%;display:inline-block;'>
        
    </div>
</body>
</html>
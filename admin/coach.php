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
            right:170px;
            bottom: 50px;
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
        .input_form{
            border: 0;
            box-shadow: var(--box-shadow);
            border-radius: 20px;
            width: 800px;
            position: relative;
            left: 550px;
            bottom: 90%;
            padding: 50px;
            height:740px;
            font-size: 16px;
        }
        input[type='radio'],select
        {
            appearance: auto;
        }
       .items
       {
            display: inline-block;
            margin-bottom: 20px;
       }
       label.items{
            margin-right: 15px;
       }
       .input_form input,#spec_select{
        border: 1px solid var(--color-light);
        color:var(--info-dark);
        border-radius: 6px;
       }
       #roaster_label{
        font-weight: bold;
        position: relative;
        left:40%;
       }
       table{
        position: relative;
        left:90px;
        border-spacing: 70px 0;
       }
       .time_input{
        width: 40px;
       }
       .end_btn{
        border: 2px solid var(--color-info-dark);
        outline: none;
        border-radius: 6px;
        background-color: transparent;
        font-size: 18px;
        font-family: poppins,sans-serif;
        color:var(--color-info-dark);
        cursor: pointer;
        position: relative;
        left:250px;
       }
       #cancel_btn:hover{
        background-color: black;
        color: white;
       }
       #reg_btn:hover{
        background-color: rgb(6,0,255);
        color: white;
       }
       .clear_btn{
        cursor:pointer;
       }
       .search{
        display: inline-block;
        position: relative;
        right: 160px;
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
    
    </style>
    <script>
        $(document).ready(function(){
            $('form').hide();
            $('.search').hide();
            //$('.start_btn').hide();
            $("#error_msg").hide();
            $("#add_coach_btn").click(function(){
                $(".start_btn").hide(1100);
                $("form").fadeIn(1200);
            });
            $("input[name='txt_firstname'],input[name='txt_lastname']").focusout(function(){
                var f=$("input[name='txt_firstname']").val().toLowerCase();
                var l=$("input[name='txt_lastname']").val().toLowerCase();
                if(f && l)
                {
                    var mail=f+"."+l+"@xtremefitness.com";
                    $("input[name='txt_email']").val(mail);
                }
            });
            $("input[name='confirm_pass'],input[name='txt_password']").focusout(function(){
                var pw=$("input[name='txt_password']").val();
                var cpw=$("input[name='confirm_pass']").val();
                var x="input[name='confirm_pass']";
                if(pw!="" && cpw!="")
                {
                    
                    if(pw!=cpw)
                    {
                        $(x).css("border","3px solid red");
                    }
                    else
                    {
                        $(x).css("border","3px solid green");
                    }
                    
                }
            });
            $("#reg_btn").click(function(){
                var fn=$("input[name='txt_firstname']").val();
                var ln=$("input[name='txt_lastname']").val();
                var d=$("input[name='txt_dob']").val();
                var tel=$("input[name='txt_tel_no']").val();
                var add=$("input[name='txt_address']").val();
                var gen=$("input[name='txt_gender']:checked").val();
                var spec=$('#spec_select').val();
                var mail=$("input[name='txt_email']").val();
                var pw=$("input[name='txt_password']").val();
                var workday="";
                var firstAdd=false;
                var timeDay="";
                var radio="input[name='Mon']";
                if($(radio).is(':checked'))
                {
                    if(!firstAdd)
                    {
                        workday+=$(radio).attr("name");
                        timeDay+=$("input[name='mon_from']").val()+"-"+$("input[name='mon_to']").val();
                        firstAdd=true;

                    }
                    else
                    {
                        workday+="|"+$(radio).attr("name");   
                        timeDay+="|"+$("input[name='mon_from']").val()+"-"+$("input[name='mon_to']").val();
                    }
                }
                var radio="input[name='Tue']";
                if($(radio).is(':checked'))
                {
                    
                    if(!firstAdd)
                    {
                        workday+=$(radio).attr("name");
                        timeDay+=$("input[name='tue_from']").val()+"-"+$("input[name='tue_to']").val();
                        firstAdd=true;

                    }
                    else
                    {
                        workday+="|"+$(radio).attr("name");   
                        timeDay+="|"+$("input[name='tue_from']").val()+"-"+$("input[name='tue_to']").val();
                    }
                }
                var radio="input[name='Wed']";
                if($(radio).is(':checked'))
                {
                    
                    if(!firstAdd)
                    {
                        workday+=$(radio).attr("name");
                        timeDay+=$("input[name='wed_from']").val()+"-"+$("input[name='wed_to']").val();
                        firstAdd=true;

                    }
                    else
                    {
                        workday+="|"+$(radio).attr("name");   
                        timeDay+="|"+$("input[name='wed_from']").val()+"-"+$("input[name='wed_to']").val();
                    }
                }
                var radio="input[name='Thu']";
                if($(radio).is(':checked'))
                {
                    
                    if(!firstAdd)
                    {
                        workday+=$(radio).attr("name");
                        timeDay+=$("input[name='thu_from']").val()+"-"+$("input[name='thu_to']").val();
                        firstAdd=true;

                    }
                    else
                    {
                        workday+="|"+$(radio).attr("name");   
                        timeDay+="|"+$("input[name='thu_from']").val()+"-"+$("input[name='thu_to']").val();
                    }
                }
                var radio="input[name='Fri']";
                if($(radio).is(':checked'))
                {
                    
                    if(!firstAdd)
                    {
                        workday+=$(radio).attr("name");
                        timeDay+=$("input[name='fri_from']").val()+"-"+$("input[name='fri_to']").val();
                        firstAdd=true;

                    }
                    else
                    {
                        workday+="|"+$(radio).attr("name");   
                        timeDay+="|"+$("input[name='fri_from']").val()+"-"+$("input[name='fri_to']").val();
                    }
                }
                var radio="input[name='Sat']";
                if($(radio).is(':checked'))
                {
                    
                    if(!firstAdd)
                    {
                        workday+=$(radio).attr("name");
                        timeDay+=$("input[name='sat_from']").val()+"-"+$("input[name='sat_to']").val();
                        firstAdd=true;

                    }
                    else
                    {
                        workday+="|"+$(radio).attr("name");   
                        timeDay+="|"+$("input[name='sat_from']").val()+"-"+$("input[name='sat_to']").val();
                    }
                }
                var radio="input[name='Sun']";
                if($(radio).is(':checked'))
                {
                    
                    if(!firstAdd)
                    {
                        workday+=$(radio).attr("name");
                        timeDay+=$("input[name='sun_from']").val()+"-"+$("input[name='sun_to']").val();
                        firstAdd=true;

                    }
                    else
                    {
                        workday+="|"+$(radio).attr("name");   
                        timeDay+="|"+$("input[name='sun_from']").val()+"-"+$("input[name='sun_to']").val();
                    }
                }
                $.ajax({
                    url:"storeCoachAjax.php",
                    method:"POST",
                    data:{email:mail,firstname:fn,lastname:ln,dob:d,tel_no:tel,address:add,gender:gen,password:pw,working_day:workday,working_time:timeDay,specialisation:spec},
                    error:function(xhr)
                    {
                        alert(xhr.statusText);
                    },
                    success:function()
                    {
                        $('form').hide(1100);
                        $('.start_btn').show(1200);
                    }
                }); 
            });
            $("#clear_all_btn").click(function(){
                    $(".roaster_table input[type='radio']").prop("checked",false);
                    $(".roaster_table input").val("");
            });
            $("#cancel_btn").click(function(){
                $("form").fadeOut(1100);
                $(".start_btn").fadeIn(1200);
            });
            $("input[name='search_mail']").focusin(function(){
                $(this).val('@xtremefitness.com');
               
            }); 
            $("#search_btn").click(function(){
                var mail=$("input[name='search_mail']").val();
                $.ajax({
                    url:"searchCoachAjax.php",
                    method:"POST",
                    data:{email:mail},
                    error:function(xhr)
                    {
                        alert(xhr.statusText);
                    },
                    success:function(data)
                    {
                        if(data)
                        {
                            alert("success");
                        }
                        else
                        {
                            $("#error_msg").show();
                        }
                    }
                });
            });
            $("#update_coach_btn").click(function(){
                $('.start_btn').hide(1200);
                $('.search').show(1300);
            });
        });
        function clearSection(id)
        {
            var row="#row"+id;
            $(row+" input[type='radio']").prop("checked",false);
            $(row+" input").val("");
        }
    </script>
</head>

<body>
        <?php
        $activemenu="coach";
        include('includes/menu.php');
        ?>
        <h1 class="title">Coach Section</h1>
        <div class="date" style="display:inline-block;">
                <?php 
                    echo date("l")." ".date("d/m/y");
                ?>
            </div>
        <div class="btns" style="margin-left:15%; display:inline-block;">
        <button class="start_btn" id="add_coach_btn"><i class="bi bi-person-plus"> </i>Add Coach</button>
        <button class="start_btn" id="update_coach_btn"><i class="bi bi-pencil-square"></i> Update Info/Roaster</button>
        </div>
        <div class="search">
            <h2>Enter the coach email</h2>
            <input type="text" name="search_mail">
            <button id="search_btn" type="button"><i id="searchIcon" class="bi bi-search"></i></button><br><br><br><br>
            <h3 style="font-size:15px;"id="error_msg">No coach found. Please try again</h3>
        </div>
        
        
        <form action="" class="input_form">
            <label class="items name_label" for="">Firstname:</label>
            <input type="text" name="txt_firstname">
            <label class="items name_label" for="">Lastname:</label>
            <input type="text" name="txt_lastname">
            <br>
            <label class="items" for="">Date Of Birth:</label>
            <input type="date" name="txt_dob"><br>
            <label class="items" for="">Address:</label>
            <input type="text" name="txt_address"><br>
            <label class="items" for="">Tel No:</label>
            <input type="text" name="txt_tel_no"><br>
            <label class="items" for="">Gender:</label>
            <label for="">Male</label>
            <input type="radio" name="txt_gender" value="male" checked>
            <label for="">Female</label>
            <input type="radio" name="txt_gender" value="female">
            <label for="">Other</label>
            <input type="radio" name="txt_gender" value="other"><br>
            <label class="items" for="">Specialisation:</label>
            <select name="" id="spec_select">
                <option value="" selected>Select specialisation</option>
                <option value="body building">Body Building</option>
                <option value="yoga">Yoga</option>
                <option value="circuit training">Circuit Training</option>
                <option value="cross fit">Cross Fit</option>
                <option value="weight loss">Weight Loss</option>
                <option value="body sculpturing">Body Sculpturing</option>
                <option value="recovery">Recovery</option>
                <option value="all rounder">All Rounder</option>
                <option value="cycling">Cycling</option>
            </select><br>
            <label class="items">Email:</label>
            <input style='width:300px;' type="text" name="txt_email" placeholder="E.g email@xtremefitness.com"><br>
            <label class="items">Password:</label>
            <input type="password" name="txt_password"><br>
            <label class="items">Confirm Password:</label>
            <input type="password" name="confirm_pass"><br>
            <label id="roaster_label">Roaster</label><br>
            <table class="roaster_table">
                <tr>
                    <td>Working Day</td>
                    <td>Working Hours</td>
                </tr>
                <tr id="row1">
                    <td>
                        <label class="day_label">Monday</label>
                        <input type="radio" name="Mon"> 
                    </td>
                    <td>
                        <label class="from_label time_label">From:</label>
                        <input type="text" class="time_input" name="mon_from">
                        <label class="to_label time_label">To:</label>
                        <input type="text" class="time_input" name="mon_to"><br>
                    </td>
                    <td><button type="button" class="clear_btn" id="btn1" onclick="clearSection('1')">Clear</button></td>
                </tr>
                <tr id="row2">
                <td>
                        <label class="day_label">Tuesday</label>
                        <input type="radio" name="Tue"> 
                    </td>
                    <td>
                        <label class="from_label time_label">From:</label>
                        <input type="text" class="time_input" name="tue_from">
                        <label class="to_label time_label">To:</label>
                        <input type="text" class="time_input" name="tue_to"><br>
                    </td>
                    <td><button type="button" class="clear_btn" id="btn2" onclick="clearSection('2')">Clear</button></td>
                </tr>
                <tr id="row3">
                <td>
                        <label class="day_label">Wednesday</label>
                        <input type="radio" name="Wed"> 
                    </td>
                    <td>
                        <label class="from_label time_label">From:</label>
                        <input type="text" class="time_input" name="wed_from">
                        <label class="to_label time_label">To:</label>
                        <input type="text" class="time_input" name="wed_to"><br>
                    </td>
                    <td><button type="button" class="clear_btn" id="btn3" onclick="clearSection('3')">Clear</button></td>
                </tr>
                <tr id="row4">
                <td>
                        <label class="day_label">Thursday</label>
                        <input type="radio" name="Thu"> 
                    </td>
                    <td>
                        <label class="from_label time_label">From:</label>
                        <input type="text" class="time_input" name="thu_from">
                        <label class="to_label time_label">To:</label>
                        <input type="text" class="time_input" name="thu_to"><br>
                    </td>
                    <td><button type="button" class="clear_btn" id="btn4" onclick="clearSection('4')">Clear</button></td>
                </tr>
                <tr id="row5">
                <td>
                        <label class="day_label">Friday</label>
                        <input type="radio" name="Fri"> 
                    </td>
                    <td>
                        <label class="from_label time_label">From:</label>
                        <input type="text" class="time_input" name="fri_from">
                        <label class="to_label time_label">To:</label>
                        <input type="text" class="time_input" name="fri_to"><br>
                    </td>
                    <td><button type="button" class="clear_btn" id="btn5" onclick="clearSection('5')">Clear</button></td>
                </tr>
                <tr id="row6">
                <td>
                        <label class="day_label">Saturday</label>
                        <input type="radio" name="Sat"> 
                    </td>
                    <td>
                        <label class="from_label time_label">From:</label>
                        <input type="text" class="time_input" name="sat_from">
                        <label class="to_label time_label">To:</label>
                        <input type="text" class="time_input" name="sat_to"><br>
                    </td>
                    <td><button type="button" class="clear_btn" id="btn6" onclick="clearSection('6')">Clear</button></td>
                </tr>
                <tr id="row7">
                <td>
                        <label class="day_label">Sunday</label>
                        <input type="radio" name="Sun"> 
                    </td>
                    <td>
                        <label class="from_label time_label">From:</label>
                        <input type="text" class="time_input" name="sun_from">
                        <label class="to_label time_label">To:</label>
                        <input type="text" class="time_input" name="sun_to"><br>
                    </td>
                    <td><button type="button" class="clear_btn" id="btn7" onclick="clearSection('7')">Clear</button></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><button class="clear_btn" id="clear_all_btn" type="button">Clear All</button></td>
                </tr>
            </table><br>
        <button class="end_btn" id="cancel_btn" type="button">Cancel</button>
        <button class="end_btn" id="reg_btn" type="button">Register</button>
        </form>
        
</body>
</html>
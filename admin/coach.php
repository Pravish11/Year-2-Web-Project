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
            height:710px;
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
    
    </style>
    <script>
        $(document).ready(function(){
            $(".start_btn").hide();
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
                var ln=$("input[name='lastname']").val();
                var d=$("input[name='txt_dob']").val();
                var tel=$("input[name='txt_tel_no']").val();
                var gen=$("input[name='txt_gender']:checked").val();
                var spec=$('#spec_select').val();
                var mail=$("input[name='txt_email']").val();
                var pw=$("input[name='txt_password']").val();
                var workday="";
                var firstAdd=false;
                var radio="input[name='Mon']";
                var timeDay="";
                if($radio.is(':checked'))
                {
                    if(firstAdd)
                    {
                        workout+=$(radio).val();
                    }
                }
                alert(x);

            });
        });
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
                <tr>
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
                </tr>
                <tr>
                <td>
                        <label class="day_label">Tuesday</label>
                        <input type="radio" name="Ton"> 
                    </td>
                    <td>
                        <label class="from_label time_label">From:</label>
                        <input type="text" class="time_input" name="tue_from">
                        <label class="to_label time_label">To:</label>
                        <input type="text" class="time_input" name="tue_to"><br>
                    </td>
                </tr>
                <tr>
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
                </tr>
                <tr>
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
                </tr>
                <tr>
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
                </tr>
                <tr>
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
                </tr>
                <tr>
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
                </tr>
            </table><br>
        <button class="end_btn" id="cancel_btn" type="button">Cancel</button>
        <button class="end_btn" id="reg_btn" type="button">Register</button>
        </form>
        
</body>
</html>
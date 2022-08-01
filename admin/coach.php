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
       #reg_btn:hover,#upd_btn:hover{
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
            $('.search').hide();
            //$('.start_btn').hide();
            $("#error_msg").hide();
            
            $("#add_coach_btn").click(function(){
                $.ajax({
                    url:"getFormAjax.php",
                    method:"GET",
                    success:function(data)
                    {
                        $('.search').after(data);
                        $('.btns').fadeOut(500,function(){
                            $(".input_form").fadeIn();
                        })

                    }
                });
                
            });
            $(document).on("focusout","input[name='txt_firstname'],input[name='txt_lastname']",function(){
                var f=$("input[name='txt_firstname']").val().toLowerCase();
                var l=$("input[name='txt_lastname']").val().toLowerCase();
                if(f && l)
                {
                    var mail=f+"."+l+"@xtremefitness.com";
                    $("input[name='txt_email']").val(mail);
                }
            });
            $(document).on("focusout","input[name='confirm_pass'],input[name='txt_password']",function(){
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
            $(document).on('click',"#upd_btn",function(){
                var fn=$("input[name='txt_firstname']").val();
                var ln=$("input[name='txt_lastname']").val();
                var d=$("input[name='txt_dob']").val();
                var tel=$("input[name='txt_tel_no']").val();
                var add=$("input[name='txt_address']").val();
                var gen=$("input[name='txt_gender']:checked").val();
                var spec=$('#spec_select').val();
                var mail=$("input[name='txt_email']").val();
                var pw=$("input[name='txt_password']").val();
                var omail=$("input[name='old_mail']").val();
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
                    url:"updateCoachAjax.php",
                    method:"POST",
                    data:{email:mail,firstname:fn,lastname:ln,dob:d,tel_no:tel,address:add,gender:gen,password:pw,working_day:workday,working_time:timeDay,specialisation:spec,old_mail:omail},
                    error:function(xhr)
                    {
                        alert(xhr.statusText);
                    },
                    success:function(data)
                    {
                        alert(data);
                        /* $('.input_form').hide(1100,function(){
                            $(".input_form").remove();
                        });
                        $('.start_btn').show(1200); */
                    }
                }); 
            });
            $(document).on('click',"#reg_btn",function(){
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
                        $('.input_form').hide(1100,function(){
                            $(".input_form").remove();
                        });
                        $('.start_btn').show(1200);
                    }
                }); 
            });
            $(document).on('click','.clear_btn',function(){
                
                    $(".roaster_table input[type='radio']").prop("checked",false);
                    $(".roaster_table input").val("");
            });
            $(document).on('click',"#cancel_btn",function(){
                $(".input_form").fadeOut(900,function(){
                    $('.input_form').remove();
                });
                $(".start_btn").fadeIn(1000);
            });
            $("input[name='search_mail']").focusin(function(){
                if($(this).val()=="")
                {
                    $(this).val('@xtremefitness.com');
                } 
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
                           $.ajax({
                            url:"getSearchResultAjax.php",
                            method:"POST",
                            data:{email:mail},
                            error:function(xhr)
                            {
                                alert(xhr.statusText);
                            },
                            success:function(data)
                            {
                                $('.search').after(data);
                                $('.input_form').hide();
                                $('.search').fadeOut(1100,function(){
                                    $(".input_form").fadeIn();
                                });
                            }
                           });
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
        
       
        
        
</body>
</html>
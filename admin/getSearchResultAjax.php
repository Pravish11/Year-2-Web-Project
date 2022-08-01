<?php 
    require_once "includes/db_connect.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $coach_mail=$_POST['email'];
    //$coach_mail='al.james@xtremefitness.com';
    $sql="SELECT u.*,c.specialisation,w.working_day,w.working_time FROM user_details u,coach c,working_hours w WHERE u.email=c.email AND u.email=w.coach_mail AND u.email='$coach_mail'";
    $x=$conn->query($sql);
    if($x->rowCount()==0)
    {
        echo false;
    }
    else
    {
    $Result=$x->fetch();
    ?>
    <form class='input_form'>
    <label class="items name_label" for="">Firstname:</label>
    <input type="text" name="txt_firstname" value="<?php echo $Result['firstname']; ?>">
    <label class="items name_label" for="">Lastname:</label>
    <input type="text" name="txt_lastname" value="<?php echo $Result['lastname']; ?>">
    <br>
    <label class="items" for="">Date Of Birth:</label>
            <input type='hidden' name='old_mail' value='<?php echo $coach_mail; ?>'></input>
            <input type="date" name="txt_dob" value="<?php echo $Result['dob']; ?>"><br>
            <label class="items" for="">Address:</label>
            <input type="text" name="txt_address" value="<?php echo $Result['address']; ?>"><br>
            <label class="items" for="">Tel No:</label>
            <input type="text" name="txt_tel_no" value="<?php echo $Result['tel_no']; ?>"><br>
            <label class="items" for="">Gender:</label>
            <label for="">Male</label>
            <input type="radio" name="txt_gender" value="male" <?php if($Result['gender']=='male') echo "checked"; ?>>
            <label for="">Female</label>
            <input type="radio" name="txt_gender" value="female" <?php if($Result['gender']=='female') echo "checked"; ?>>
            <label for="">Other</label>
            <input type="radio" name="txt_gender" value="other" <?php if($Result['gender']=='other') echo "checked"; ?>><br>
            <label class="items" for="">Specialisation:</label>
            <select name="" id="spec_select">
                <option value="" selected>Select specialisation</option>
                <option value="body building" <?php if($Result['specialisation']=='body building') echo "selected"; ?>>Body Building</option>
                <option value="yoga" <?php if($Result['specialisation']=='yoga') echo "selected"; ?>>Yoga</option>
                <option value="circuit training" <?php if($Result['specialisation']=='circuit training') echo "selected"; ?>>Circuit Training</option>
                <option value="cross fit" <?php if($Result['specialisation']=='cross fit') echo "selected"; ?>>Cross Fit</option>
                <option value="weight loss" <?php if($Result['specialisation']=='weight loss') echo "selected"; ?>>Weight Loss</option>
                <option value="body sculpturing" <?php if($Result['specialisation']=='body sculpturing') echo "selected"; ?>>Body Sculpturing</option>
                <option value="recovery" <?php if($Result['specialisation']=='recovery') echo "selected"; ?>>Recovery</option>
                <option value="all rounder" <?php if($Result['specialisation']=='all rounder') echo "selected"; ?>>All Rounder</option>
                <option value="cycling" <?php if($Result['specialisation']=='cycling') echo "selected"; ?>>Cycling</option>
            </select><br>
            <label class="items">Email:</label>
            <input style='width:300px;' type="text" name="txt_email" placeholder="E.g email@xtremefitness.com" value="<?php echo $Result['email']; ?>"><br>
            <label class="items">New password:</label>
            <input type="password" name="txt_password"><br>
            <label class="items">Confirm Password:</label>
            <input type="password" name="confirm_pass"><br>
            <label id="roaster_label">Roaster</label><br>
            <table class="roaster_table">
                <tr>
                    <td>Working Day</td>
                    <td>Working Hours</td>
                </tr>
                <?php 
                    $working_days=explode("|",$Result['working_day']);
                    $working_time=explode("|",$Result['working_time']);
                    $found=false;
                    $index=0;
                ?>
                <tr id="row1">
                    <td>
                        <label class="day_label">Monday</label>
                        <input type="radio" name="Mon"
                        <?php
                            for($i=0;$i<sizeof($working_days);$i++)
                            {
                                if($working_days[$i]=='Mon')
                                {
                                    echo "checked > </td>";
                                        $time=explode("-",$working_time[$i]);
                                        $from=$time[0];
                                        $to=$time[1];
                                        
                                    ?>
                                    <td>
                                    <label class="from_label time_label">From:</label>
                                    <input type="text" class="time_input" name="mon_from" value="<?php echo $from; ?>">
                                    <label class="to_label time_label">To:</label>
                                    <input type="text" class="time_input" name="mon_to" value="<?php echo $to; ?>"><br>
                                     </td>
                                    <td><button type="button" class="clear_btn" id="btn1" onclick="clearSection('1')">Clear</button></td>
                                    <?php
                                    $found=true;
                                    $index=$i;
                                    break;
                                }
                            }
                            if(!$found)
                            {
                                echo "> </td>";
                                ?>
                                 <td>
                                <label class="from_label time_label">From:</label>
                                <input type="text" class="time_input" name="mon_from">
                                <label class="to_label time_label">To:</label>
                                <input type="text" class="time_input" name="mon_to"><br>
                                 </td>
                                <td><button type="button" class="clear_btn" id="btn1" onclick="clearSection('1')">Clear</button></td>
                                <?php 
                            }
                        ?>
                    <td>
                </tr>
                <tr id="row2">
                    <td>
                        <label class="day_label">Tuesday</label>
                        <input type="radio" name="Tue"
                        <?php
                            $found=false;$index=0;
                            for($i=0;$i<sizeof($working_days);$i++)
                            {
                                if($working_days[$i]=='Tue')
                                {
                                    echo "checked > </td>";
                                        $time=explode("-",$working_time[$i]);
                                        $from=$time[0];
                                        $to=$time[1];
                                    ?>
                                    <td>
                                    <label class="from_label time_label">From:</label>
                                    <input type="text" class="time_input" name="tue_from" value="<?php echo $from; ?>">
                                    <label class="to_label time_label">To:</label>
                                    <input type="text" class="time_input" name="tue_to" value="<?php echo $to; ?>"><br>
                                     </td>
                                    <td><button type="button" class="clear_btn" id="btn2" onclick="clearSection('2')">Clear</button></td>
                                    <?php
                                    $found=true;
                                    break;
                                }
                            }
                            if(!$found)
                            {
                                echo "> </td>";
                                ?>
                                <td>
                                <label class="from_label time_label">From:</label>
                                <input type="text" class="time_input" name="tue_from" >
                                <label class="to_label time_label">To:</label>
                                <input type="text" class="time_input" name="tue_to"><br>
                                 </td>
                                <td><button type="button" class="clear_btn" id="btn2" onclick="clearSection('2')">Clear</button></td>
                                <?php
                            }     
                        ?>

                    <td>
                </tr>
                <tr id="row3">
                    <td>
                        <label class="day_label">Wednesday</label>
                        <input type="radio" name="Wed"
                        <?php
                        $found=false;
                            for($i=0;$i<sizeof($working_days);$i++)
                            {
                                if($working_days[$i]=='Wed')
                                {
                                    echo "checked > </td>";
                                        $time=explode("-",$working_time[$i]);
                                        $from=$time[0];
                                        $to=$time[1];
                                    ?>
                                    <td>
                                    <label class="from_label time_label">From:</label>
                                    <input type="text" class="time_input" name="wed_from" value="<?php echo $from; ?>">
                                    <label class="to_label time_label">To:</label>
                                    <input type="text" class="time_input" name="wed_to" value="<?php echo $to; ?>"><br>
                                     </td>
                                    <td><button type="button" class="clear_btn" id="btn3" onclick="clearSection('3')">Clear</button></td>
                                    <?php
                                    $found=true;
                                    break;
                                }
                            }
                            if(!$found)
                            {
                                echo "> </td>";
                                    ?>
                                    <td>
                                    <label class="from_label time_label">From:</label>
                                    <input type="text" class="time_input" name="wed_from" >
                                    <label class="to_label time_label">To:</label>
                                    <input type="text" class="time_input" name="wed_to"><br>
                                     </td>
                                    <td><button type="button" class="clear_btn" id="btn3" onclick="clearSection('3')">Clear</button></td>
                                    <?php
                            }

                        ?>
                    <td>
                </tr>
                <tr id="row4">
                    <td>
                        <label class="day_label">Thursday</label>
                        <input type="radio" name="Thu"
                        <?php
                        $found=false;
                            for($i=0;$i<sizeof($working_days);$i++)
                            {
                                if($working_days[$i]=='Thu')
                                {
                                    echo "checked > </td>";
                                        $time=explode("-",$working_time[$i]);
                                        $from=$time[0];
                                        $to=$time[1];
                                    ?>
                                    <td>
                                    <label class="from_label time_label">From:</label>
                                    <input type="text" class="time_input" name="thu_from" value="<?php echo $from; ?>">
                                    <label class="to_label time_label">To:</label>
                                    <input type="text" class="time_input" name="thu_to" value="<?php echo $to; ?>"><br>
                                     </td>
                                    <td><button type="button" class="clear_btn" id="btn4" onclick="clearSection('4')">Clear</button></td>
                                    <?php
                                    $found=true;
                                    break;
                                }                               
                            }
                            if(!$found)
                            {
                                echo "> </td>";
                                    ?>
                                    <td>
                                    <label class="from_label time_label">From:</label>
                                    <input type="text" class="time_input" name="thu_from" >
                                    <label class="to_label time_label">To:</label>
                                    <input type="text" class="time_input" name="thu_to"><br>
                                     </td>
                                    <td><button type="button" class="clear_btn" id="btn4" onclick="clearSection('4')">Clear</button></td>
                                    <?php
                            }
                            
                        ?>
                    <td>
                </tr>
                <tr id="row5">
                    <td>
                        <label class="day_label">Friday</label>
                        <input type="radio" name="Fri"
                        <?php
                        $found=false;
                            for($i=0;$i<sizeof($working_days);$i++)
                            {
                                if($working_days[$i]=='Fri')
                                {
                                    echo "checked > </td>";
                                        $time=explode("-",$working_time[$i]);
                                        $from=$time[0];
                                        $to=$time[1];
                                    ?>
                                    <td>
                                    <label class="from_label time_label">From:</label>
                                    <input type="text" class="time_input" name="fri_from" value="<?php echo $from; ?>">
                                    <label class="to_label time_label">To:</label>
                                    <input type="text" class="time_input" name="fri_to" value="<?php echo $to; ?>"><br>
                                     </td>
                                    <td><button type="button" class="clear_btn" id="btn5" onclick="clearSection('5')">Clear</button></td>
                                    <?php
                                    $found=true;
                                    break;
                                }
                            }
                            if(!$found)
                            {
                                echo "> </td>";
                                    ?>
                                    <td>
                                    <label class="from_label time_label">From:</label>
                                    <input type="text" class="time_input" name="fri_from" >
                                    <label class="to_label time_label">To:</label>
                                    <input type="text" class="time_input" name="fri_to"><br>
                                     </td>
                                    <td><button type="button" class="clear_btn" id="btn5" onclick="clearSection('5')">Clear</button></td>
                                    <?php
                            }
                        ?>
                    <td>
                </tr>
                <tr id="row6">
                    <td>
                        <label class="day_label">Saturday</label>
                        <input type="radio" name="Sat"
                        <?php
                        $found=false;
                            for($i=0;$i<sizeof($working_days);$i++)
                            {
                                if($working_days[$i]=='Sat')
                                {
                                    echo "checked > </td>";
                                        $time=explode("-",$working_time[$i]);
                                        $from=$time[0];
                                        $to=$time[1];
                                    ?>
                                    <td>
                                    <label class="from_label time_label">From:</label>
                                    <input type="text" class="time_input" name="sat_from" value="<?php echo $from; ?>">
                                    <label class="to_label time_label">To:</label>
                                    <input type="text" class="time_input" name="sat_to" value="<?php echo $to; ?>"><br>
                                     </td>
                                    <td><button type="button" class="clear_btn" id="btn6" onclick="clearSection('6')">Clear</button></td>
                                    <?php
                                    $found=true;
                                    break;
                                }
                            }
                            if(!$found)
                            {
                                echo "> </td>";
                                ?>
                                <td>
                                <label class="from_label time_label">From:</label>
                                <input type="text" class="time_input" name="sat_from" >
                                <label class="to_label time_label">To:</label>
                                <input type="text" class="time_input" name="sat_to"><br>
                                 </td>
                                <td><button type="button" class="clear_btn" id="btn6" onclick="clearSection('6')">Clear</button></td>
                                <?php
                            }
                        ?>
                    <td>
                </tr>
                <tr id="row7">
                    <td>
                        <label class="day_label">Sunday</label>
                        <input type="radio" name="Sun"
                        <?php
                        $found=false;
                            for($i=0;$i<sizeof($working_days);$i++)
                            {
                                if($working_days[$i]=='Sun')
                                {
                                    echo "checked > </td>";
                                        $time=explode("-",$working_time[$i]);
                                        $from=$time[0];
                                        $to=$time[1];
                                    ?>
                                    <td>
                                    <label class="from_label time_label">From:</label>
                                    <input type="text" class="time_input" name="sun_from" value="<?php echo $from; ?>">
                                    <label class="to_label time_label">To:</label>
                                    <input type="text" class="time_input" name="sun_to" value="<?php echo $to; ?>"><br>
                                     </td>
                                    <td><button type="button" class="clear_btn" id="btn7" onclick="clearSection('7')">Clear</button></td>
                                    <?php
                                    $found=true;
                                    break;
                                }
                            }
                            if(!$found)
                            {
                                echo "> </td>";
                                ?>
                                <td>
                                <label class="from_label time_label">From:</label>
                                <input type="text" class="time_input" name="sun_from" >
                                <label class="to_label time_label">To:</label>
                                <input type="text" class="time_input" name="sun_to"><br>
                                 </td>
                                <td><button type="button" class="clear_btn" id="btn7" onclick="clearSection('7')">Clear</button></td>
                                <?php
                            }
                        ?>
                    <td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><button class="clear_btn" id="clear_all_btn1" type="button">Clear All</button></td>
                </tr>
            </table><br>
        <button class="end_btn" id="cancel_btn" type="button">Cancel</button>
        <button class="end_btn" id="upd_btn" type="button">Update</button>
        </form>
        <?php 
    }
    ?>
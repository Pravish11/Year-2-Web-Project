<form action="" class="input_form" id="new_form">
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
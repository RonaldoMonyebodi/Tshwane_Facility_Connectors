<?php
if (isset($_GET['room_id'])){
    $get_room_id = $_GET['room_id'];
    $get_room_sql = "SELECT * FROM room NATURAL JOIN room_type WHERE room_id = '$get_room_id'";
    $get_room_result = mysqli_query($connection,$get_room_sql);
    $get_room = mysqli_fetch_assoc($get_room_result);

    $get_room_type_id = $get_room['room_type_id'];
    $get_room_type = $get_room['room_type'];
    $get_room_no = $get_room['room_no'];
    $get_room_price = $get_room['price'];
}

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Reservation</li>
        </ol>
    </div><!--/.row-->

    <!-- <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Reservation</h1>
        </div>
    </div>/.row -->

    

    <div class="row">
        <div class="col-lg-12">
            <form role="form" id="booking" data-toggle="validator">
                <div class="response"></div>
                <div class="col-lg-12">
                    <?php
                    if (isset($_GET['room_id'])){?>

                        <div class="panel panel-default">
                            <div class="panel-heading">Facilities Information:
                                <a class="btn btn-secondary pull-right" href="index.php?room_mang">Replan Booking</a>
                            </div>
                            <div class="panel-body">
                                <div class="form-group col-lg-6">
                                    <label>Facility Type</label>
                                    <select class="form-control" id="room_type" data-error="Select Facility Type" required>
                                        <option selected disabled>Select Facility Type</option>
                                        <option selected value="<?php echo $get_room_type_id; ?>"><?php echo $get_room_type; ?></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Facility Type</label>
                                    <select class="form-control" id="room_no" onchange="fetch_price(this.value)" required data-error="Select Facility">
                                        <option selected disabled>Select Room No</option>
                                        <option selected value="<?php echo $get_room_id; ?>"><?php echo $get_room_no; ?></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check In Date</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_in_date" data-error="Select Check In Date" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check Out Date</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_out_date" data-error="Select Check Out Date" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 style="font-weight: bold">Total Hours : <span id="staying_day">0</span> Hours</h4>
                                    <h4 style="font-weight: bold">Price: <span id="price"><?php echo $get_room_price; ?></span> /-</h4>
                                    <h4 style="font-weight: bold">Total Amount Due: <span id="total_price">0</span> /-</h4>
                                </div>
                            </div>
                        </div>
                    <?php } else{?>
                        <div class="panel panel-default">
                            <div class="panel-heading">Facility Type:
                                <a class="btn btn-secondary pull-right" style="border-radius:0%" href="index.php?reservation">Replan Booking</a>
                            </div>
                            <div class="panel-body">
                                <div class="form-group col-lg-6">
                                    <label>Select Facility Type</label>
                                    <select class="form-control" id="room_type" onchange="fetch_room(this.value)" required data-error="Select Facility Type">
                                        <option selected disabled>Select Facility Type</option>
                                        <?php
                                        $query  = "SELECT * FROM room_type";
                                        $result = mysqli_query($connection,$query);
                                        if (mysqli_num_rows($result) > 0){
                                            while ($room_type = mysqli_fetch_assoc($result)){
                                                echo '<option value="'.$room_type['room_type_id'].'">'.$room_type['room_type'].'</option>';
                                            }}
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Facility</label>
                                    <select class="form-control" id="room_no" onchange="fetch_price(this.value)" required data-error="Select Facility">

                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check In Date</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_in_date" data-error="Select Check In Date" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check Out Date</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_out_date" data-error="Select Check Out Date" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 style="font-weight: bold">Total Hours : <span id="staying_day">0</span> Hours</h4>
                                    <h4 style="font-weight: bold">Price: <span id="price">0</span> /-</h4>
                                    <h4 style="font-weight: bold">Total Amount Due : <span id="total_price">0</span> /-</h4>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">Patrons Detail:</div>
                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                <label>First Name</label>
                                <input class="form-control" placeholder="First Name" id="first_name" data-error="Enter First Name" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Last Name</label>
                                <input class="form-control" placeholder="Last Name" id="last_name" data-error="Enter Last Name" required>
                                <div class="help-block with-errors"></div>
                            </div>

                           <!-- <div class="form-group col-lg-6">
                                <label>Contact Number</label>
                                <input type="number" class="form-control" data-error="Enter Min 10 Digit" data-minlength="10" placeholder="Contact No" id="contact_no" required>
                                <div class="help-block with-errors"></div>
                            </div>
                                        -->
                                        <div class="form-group col-lg-6">
    <label for="country_code">Country Code</label>
    <select class="form-control" id="country_code" required>
        <option value="+93">Afghanistan (+93)</option>
        <option value="+355">Albania (+355)</option>
        <option value="+213">Algeria (+213)</option>
        <option value="+1-684">American Samoa (+1-684)</option>
        <option value="+376">Andorra (+376)</option>
        <option value="+244">Angola (+244)</option>
        <option value="+1-264">Anguilla (+1-264)</option>
        <option value="+672">Antarctica (+672)</option>
        <option value="+1-268">Antigua and Barbuda (+1-268)</option>
        <option value="+54">Argentina (+54)</option>
        <option value="+374">Armenia (+374)</option>
        <option value="+297">Aruba (+297)</option>
        <option value="+61">Australia (+61)</option>
        <option value="+43">Austria (+43)</option>
        <option value="+994">Azerbaijan (+994)</option>
        <option value="+1-242">Bahamas (+1-242)</option>
        <option value="+973">Bahrain (+973)</option>
        <option value="+880">Bangladesh (+880)</option>
        <option value="+1-246">Barbados (+1-246)</option>
        <option value="+375">Belarus (+375)</option>
        <option value="+32">Belgium (+32)</option>
        <option value="+501">Belize (+501)</option>
        <option value="+229">Benin (+229)</option>
        <option value="+1-441">Bermuda (+1-441)</option>
        <option value="+975">Bhutan (+975)</option>
        <option value="+591">Bolivia (+591)</option>
        <option value="+387">Bosnia and Herzegovina (+387)</option>
        <option value="+267">Botswana (+267)</option>
        <option value="+55">Brazil (+55)</option>
        <option value="+246">British Indian Ocean Territory (+246)</option>
        <option value="+1-284">British Virgin Islands (+1-284)</option>
        <option value="+673">Brunei (+673)</option>
        <option value="+359">Bulgaria (+359)</option>
        <option value="+226">Burkina Faso (+226)</option>
        <option value="+257">Burundi (+257)</option>
        <option value="+855">Cambodia (+855)</option>
        <option value="+237">Cameroon (+237)</option>
        <option value="+1">Canada (+1)</option>
        <option value="+238">Cape Verde (+238)</option>
        <option value="+1-345">Cayman Islands (+1-345)</option>
        <option value="+236">Central African Republic (+236)</option>
        <option value="+235">Chad (+235)</option>
        <option value="+56">Chile (+56)</option>
        <option value="+86">China (+86)</option>
        <option value="+57">Colombia (+57)</option>
        <option value="+269">Comoros (+269)</option>
        <option value="+682">Cook Islands (+682)</option>
        <option value="+506">Costa Rica (+506)</option>
        <option value="+385">Croatia (+385)</option>
        <option value="+53">Cuba (+53)</option>
        <option value="+599">Curaçao (+599)</option>
        <option value="+357">Cyprus (+357)</option>
        <option value="+420">Czech Republic (+420)</option>
        <option value="+45">Denmark (+45)</option>
        <option value="+253">Djibouti (+253)</option>
        <option value="+1-767">Dominica (+1-767)</option>
        <option value="+1-809">Dominican Republic (+1-809)</option>
        <option value="+670">East Timor (+670)</option>
        <option value="+593">Ecuador (+593)</option>
        <option value="+20">Egypt (+20)</option>
        <option value="+503">El Salvador (+503)</option>
        <option value="+240">Equatorial Guinea (+240)</option>
        <option value="+291">Eritrea (+291)</option>
        <option value="+372">Estonia (+372)</option>
        <option value="+251">Ethiopia (+251)</option>
        <option value="+679">Fiji (+679)</option>
        <option value="+358">Finland (+358)</option>
        <option value="+33">France (+33)</option>
        <option value="+241">Gabon (+241)</option>
        <option value="+220">Gambia (+220)</option>
        <option value="+995">Georgia (+995)</option>
        <option value="+49">Germany (+49)</option>
        <option value="+233">Ghana (+233)</option>
        <option value="+350">Gibraltar (+350)</option>
        <option value="+30">Greece (+30)</option>
        <option value="+299">Greenland (+299)</option>
        <option value="+1-473">Grenada (+1-473)</option>
        <option value="+1-671">Guam (+1-671)</option>
        <option value="+502">Guatemala (+502)</option>
        <option value="+44-1481">Guernsey (+44-1481)</option>
        <option value="+224">Guinea (+224)</option>
        <option value="+245">Guinea-Bissau (+245)</option>
        <option value="+592">Guyana (+592)</option>
        <option value="+509">Haiti (+509)</option>
        <option value="+504">Honduras (+504)</option>
        <option value="+852">Hong Kong (+852)</option>
        <option value="+36">Hungary (+36)</option>
        <option value="+354">Iceland (+354)</option>
        <option value="+91">India (+91)</option>
        <option value="+62">Indonesia (+62)</option>
        <option value="+98">Iran (+98)</option>
        <option value="+964">Iraq (+964)</option>
        <option value="+353">Ireland (+353)</option>
        <option value="+44-1624">Isle of Man (+44-1624)</option>
        <option value="+972">Israel (+972)</option>
        <option value="+39">Italy (+39)</option>
        <option value="+1-876">Jamaica (+1-876)</option>
        <option value="+81">Japan (+81)</option>
        <option value="+44">Jersey (+44)</option>
        <option value="+962">Jordan (+962)</option>
        <option value="+7">Kazakhstan (+7)</option>
        <option value="+254">Kenya (+254)</option>
        <option value="+686">Kiribati (+686)</option>
        <option value="+383">Kosovo (+383)</option>
        <option value="+965">Kuwait (+965)</option>
        <option value="+996">Kyrgyzstan (+996)</option>
        <option value="+856">Laos (+856)</option>
        <option value="+371">Latvia (+371)</option>
        <option value="+961">Lebanon (+961)</option>
        <option value="+266">Lesotho (+266)</option>
        <option value="+231">Liberia (+231)</option>
        <option value="+218">Libya (+218)</option>
        <option value="+423">Liechtenstein (+423)</option>
        <option value="+370">Lithuania (+370)</option>
        <option value="+352">Luxembourg (+352)</option>
        <option value="+853">Macau (+853)</option>
        <option value="+389">Macedonia (+389)</option>
        <option value="+261">Madagascar (+261)</option>
        <option value="+265">Malawi (+265)</option>
        <option value="+60">Malaysia (+60)</option>
        <option value="+960">Maldives (+960)</option>
        <option value="+223">Mali (+223)</option>
        <option value="+356">Malta (+356)</option>
        <option value="+692">Marshall Islands (+692)</option>
        <option value="+222">Mauritania (+222)</option>
        <option value="+230">Mauritius (+230)</option>
        <option value="+262">Mayotte (+262)</option>
        <option value="+52">Mexico (+52)</option>
        <option value="+691">Micronesia (+691)</option>
        <option value="+373">Moldova (+373)</option>
        <option value="+377">Monaco (+377)</option>
        <option value="+976">Mongolia (+976)</option>
        <option value="+382">Montenegro (+382)</option>
        <option value="+1-664">Montserrat (+1-664)</option>
        <option value="+212">Morocco (+212)</option>
        <option value="+258">Mozambique (+258)</option>
        <option value="+95">Myanmar (+95)</option>
        <option value="+264">Namibia (+264)</option>
        <option value="+674">Nauru (+674)</option>
        <option value="+977">Nepal (+977)</option>
        <option value="+31">Netherlands (+31)</option>
        <option value="+599">Netherlands Antilles (+599)</option>
        <option value="+687">New Caledonia (+687)</option>
        <option value="+64">New Zealand (+64)</option>
        <option value="+505">Nicaragua (+505)</option>
        <option value="+227">Niger (+227)</option>
        <option value="+234">Nigeria (+234)</option>
        <option value="+683">Niue (+683)</option>
        <option value="+850">North Korea (+850)</option>
        <option value="+47">Norway (+47)</option>
        <option value="+968">Oman (+968)</option>
        <option value="+92">Pakistan (+92)</option>
        <option value="+680">Palau (+680)</option>
        <option value="+970">Palestine (+970)</option>
        <option value="+507">Panama (+507)</option>
        <option value="+675">Papua New Guinea (+675)</option>
        <option value="+595">Paraguay (+595)</option>
        <option value="+51">Peru (+51)</option>
        <option value="+63">Philippines (+63)</option>
        <option value="+48">Poland (+48)</option>
        <option value="+351">Portugal (+351)</option>
        <option value="+1-787">Puerto Rico (+1-787)</option>
        <option value="+974">Qatar (+974)</option>
        <option value="+262">Réunion (+262)</option>
        <option value="+40">Romania (+40)</option>
        <option value="+7">Russia (+7)</option>
        <option value="+250">Rwanda (+250)</option>
        <option value="+1-869">Saint Kitts and Nevis (+1-869)</option>
        <option value="+1-758">Saint Lucia (+1-758)</option>
        <option value="+1-784">Saint Vincent and the Grenadines (+1-784)</option>
        <option value="+685">Samoa (+685)</option>
        <option value="+378">San Marino (+378)</option>
        <option value="+239">São Tomé and Príncipe (+239)</option>
        <option value="+966">Saudi Arabia (+966)</option>
        <option value="+221">Senegal (+221)</option>
        <option value="+381">Serbia (+381)</option>
        <option value="+248">Seychelles (+248)</option>
        <option value="+232">Sierra Leone (+232)</option>
        <option value="+65">Singapore (+65)</option>
        <option value="+421">Slovakia (+421)</option>
        <option value="+386">Slovenia (+386)</option>
        <option value="+677">Solomon Islands (+677)</option>
        <option value="+252">Somalia (+252)</option>
        <option value="+27">South Africa (+27)</option>
        <option value="+82">South Korea (+82)</option>
        <option value="+34">Spain (+34)</option>
        <option value="+94">Sri Lanka (+94)</option>
        <option value="+249">Sudan (+249)</option>
        <option value="+597">Suriname (+597)</option>
        <option value="+268">Swaziland (+268)</option>
        <option value="+46">Sweden (+46)</option>
        <option value="+41">Switzerland (+41)</option>
        <option value="+963">Syria (+963)</option>
        <option value="+886">Taiwan (+886)</option>
        <option value="+992">Tajikistan (+992)</option>
        <option value="+255">Tanzania (+255)</option>
        <option value="+66">Thailand (+66)</option>
        <option value="+228">Togo (+228)</option>
        <option value="+690">Tokelau (+690)</option>
        <option value="+676">Tonga (+676)</option>
        <option value="+1-868">Trinidad and Tobago (+1-868)</option>
        <option value="+216">Tunisia (+216)</option>
        <option value="+90">Turkey (+90)</option>
        <option value="+993">Turkmenistan (+993)</option>
        <option value="+1-649">Turks and Caicos Islands (+1-649)</option>
        <option value="+688">Tuvalu (+688)</option>
        <option value="+256">Uganda (+256)</option>
        <option value="+380">Ukraine (+380)</option>
        <option value="+971">United Arab Emirates (+971)</option>
        <option value="+44">United Kingdom (+44)</option>
        <option value="+1">United States (+1)</option>
        <option value="+598">Uruguay (+598)</option>
        <option value="+998">Uzbekistan (+998)</option>
        <option value="+678">Vanuatu (+678)</option>
        <option value="+379">Vatican City (+379)</option>
        <option value="+58">Venezuela (+58)</option>
        <option value="+84">Vietnam (+84)</option>
        <option value="+681">Wallis and Futuna (+681)</option>
        <option value="+967">Yemen (+967)</option>
        <option value="+260">Zambia (+260)</option>
        <option value="+263">Zimbabwe (+263)</option>
    </select>
</div>

<div class="form-group col-lg-6">
    <label>Contact Number</label>
    <div class="input-group">
        <input type="text" class="form-control" id="country-code-display" value="+1" readonly style="max-width: 80px;">
        <input type="number" class="form-control" data-error="Missing contact number" data-minlength="30" placeholder="Contact No" id="contact_no" required>
    </div>
    <div class="help-block with-errors"></div>
</div>

<script>
    document.getElementById('country_code').addEventListener('change', function() {
        var selectedCode = this.value;
        document.getElementById('country-code-display').value = selectedCode;
        document.getElementById('country-code-display').removeAttribute('readonly');
    });
</script>


                            <div class="form-group col-lg-6">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" data-error="Enter Valid Email Address" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>ID Card Type</label>
                                <select class="form-control" id="id_card_id" data-error="Select ID Card Type" required onchange="validId(this.value);">
                                    <option selected disabled>Select ID Card Type</option>
                                    <?php
                                    $query  = "SELECT * FROM id_card_type";
                                    $result = mysqli_query($connection,$query);
                                    if (mysqli_num_rows($result) > 0){
                                        while ($id_card_type = mysqli_fetch_assoc($result)){
                                            echo '<option value="'.$id_card_type['id_card_type_id'].'">'.$id_card_type['id_card_type'].'</option>';
                                        }}
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Selected ID Card Number</label>
                                <input type="text" class="form-control" placeholder="ID Card Number" id="id_card_no" data-error="Enter Valid ID Card No" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label>Residential Address</label>
                                <input type="text" class="form-control" placeholder="Full Address" id="address" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-success pull-right" style="border-radius:0%">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <p class="back-link">Developed By Tshwane Facility Connectors @2024</p>
        </div>
    </div>

</div>    <!--/.main-->


<!-- Booking Confirmation-->
<div id="bookingConfirm" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><b>Facility Booking</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert bg-success alert-dismissable" role="alert"><em class="fa fa-lg fa-check-circle">&nbsp;</em>Facility Successfully Booked</div>
                        <table class="table table-striped table-bordered table-responsive">
                            <!-- <thead>
                            <tr>
                                <th>Name</th>
                                <th>Detail</th>
                            </tr>
                            </thead> -->
                            <tbody>
                            <tr>
                                <td><b>Patron Name</b></td>
                                <td id="getCustomerName"></td>
                            </tr>
                            <tr>
                                <td><b>Facility Type</b></td>
                                <td id="getRoomType"></td>
                            </tr>
                            <tr>
                                <td><b>Facility</b></td>
                                <td id="getRoomNo"></td>
                            </tr>
                            <tr>
                                <td><b>Check In</b></td>
                                <td id="getCheckIn"></td>
                            </tr>
                            <tr>
                                <td><b>Check Out</b></td>
                                <td id="getCheckOut"></td>
                            </tr>
                            <tr>
                                <td><b>Total Amount</b></td>
                                <td id="getTotalPrice"></td>
                            </tr>
                            <tr>
                                <td><b>Payment Status</b></td>
                                <td id="getPaymentStaus"></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" style="border-radius:60px;" href="index.php?reservation"><i class="fa fa-check-circle"></i></a>
            </div>
        </div>

    </div>
</div>



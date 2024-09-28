<?php 
session_start();
if (isset($_SESSION['username'])){
include 'includes/document_head.php'?>
<?php include 'includes/document_head.php'?>
		<div id="wrapper">
			<?php include 'includes/topbar.php'?>		
			<?php include 'includes/sidebar.php'?>
				<div id="main_container" class="main_container container_16 clearfix">
					<?php include 'includes/navigation.php'?>
					<div class="flat_area grid_16">
						<h2>Settings</h2>
					</div>
					<div class="box grid_8 round_all">
						<h2 class="box_head grad_colour">General</h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
						<div class="toggle_container">
							<div class="block">
                            <?php 
							include "libraries/mysqlconnect.php";
							$query="SELECT * FROM companyInformation";
							$result=mysql_query($query);
							$row=@mysql_fetch_assoc($result);
							$vacio=false;
							if ($row['CN']==""){
								$vacio=true;
							}
								$query="SELECT * FROM MMode";
								$result=mysql_query($query);
							$row2=@mysql_fetch_assoc($result);
							$vacio2=false;
							if ($row2['Mtext']==""){
								$vacio2=true;
							}
							include "libraries/closecon.php";
							?>
								<form method="post" name="form_comp">	
              						<label>Company Name</label> 
								  <input name="CN" <?php if ($vacio==false){ echo "value='{$row['CN']}'"; } ?> title="Your Company Name as you want it to appear throughout the system" type="text" class="large">
                                  	
                                  	<label>Email Address</label>
                                  <input name="mail" <?php if ($vacio==false){ echo "value='{$row['mail']}'"; } ?> title="The default sender address used for emails sent" type="text" class="large">
                                  
                                  <label>Pay To Text</label> 
								  <textarea name="PT"><?php if ($vacio==false){ echo $row['PT']; } ?></textarea>
                                               <button type="submit" name="buttonfinish" class="button_colour round_all"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span>Save Settings</span></button>
                                               </form>
                                               	<form method="post" name="form_Mmode">	
                                  <label>Maintenance Mode</label>
									<div class="input_group">
										<input type="checkbox" <?php if ($vacio2==false){ if($row2['activado']==1){ echo "checked"; } } ?>  name="option" value="1">Tick to enable - prevents client area access when enabled<br>
                                        
									</div>
                                    
                                  <label>Maintenance Mode Message</label> 
								  <textarea name="Mtext"><?php if ($vacio2==false){ echo $row2['Mtext']; } ?></textarea>
						                     <button type="submit" name="buttonfinishM" class="button_colour round_all"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span>Save Settings</span></button>
              </form>
							</div>
						</div>
					</div>
                    <div class="box grid_8 round_all">
						<h2 class="box_head grad_colour">Localisation</h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
						<div class="toggle_container">
							<div class="block">
							  <form>	
              						<label>System Charset</label> 
							    <input title="Default: utf-8" type="text" class="large">
                                  
                                  <label>Date Format</label>
									<div class="input_group">
										<select>
								    <option value="DD/MM/YYYY">
												DD/MM/YYYY
											</option>
								    <option value="DD.MM.YYYY">
												DD.MM.YYYY
											</option>
								    <option value="DD-MM-YYYY">
												DD-MM-YYYY
											</option>
                                    <option value="MM-DD-YYYY">
												MM-DD-YYYY
											</option>
                                    <option value="YYYY/MM/DD">
												YYYY/MM/DD
											</option>
                                    <option value="YYYY-MM-DD">
												YYYY-MM-DD
											</option>
										</select>
									</div>
                                   <label>Default Country</label>
								<div class="input_group">
										<select>
										  <option value="AF">Afghanistan</option>
                                            <option value="AX">Aland Islands</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AS">American Samoa</option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">Antarctica</option>
                                            <option value="AG">Antigua And Barbuda</option>
                                          	<option value="AR">Argentina</option>
                                            <option value="AM">Armenia</option>
                                            <option value="AW">Aruba</option>
                                            <option value="AU">Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="AZ">Azerbaijan</option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BD">Bangladesh</option>
                                            <option value="BB">Barbados</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Benin</option>
                                            <option value="BM">Bermuda</option>
                                            <option value="BT">Bhutan</option>
                                            <option value="BO">Bolivia</option>
                                            <option value="BA">Bosnia And Herzegovina</option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">Bouvet Island</option>
                                            <option value="BR">Brazil</option>
                                            <option value="IO">British Indian Ocean Territory</option>
                                            <option value="BN">Brunei Darussalam</option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="BF">Burkina Faso</option>
                                            <option value="BI">Burundi</option>
                                            <option value="KH">Cambodia</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">Cape Verde</option>
                                            <option value="KY">Cayman Islands</option>
                                            <option value="CF">Central African Republic</option>
                                            <option value="TD">Chad</option>
                                            <option value="CL">Chile</option>
                                            <option value="CN">China</option>
                                            <option value="CX">Christmas Island</option>
                                            <option value="CC">Cocos (Keeling) Islands</option>
                                            <option value="CO">Colombia</option>
                                            <option value="KM">Comoros</option>
                                            <option value="CG">Congo</option>
                                            <option value="CD">Congo, Democratic Republic</option>
                                            <option value="CK">Cook Islands</option>
                                            <option value="CR">Costa Rica</option>
                                            <option value="CI">Cote D'Ivoire</option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">Czech Republic</option>
                                            <option value="DK">Denmark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DM">Dominica</option>
                                            <option value="DO">Dominican Republic</option>
                                            <option value="EC">Ecuador</option>
                                            <option value="EG">Egypt</option>
                                            <option value="SV">El Salvador</option>
                                            <option value="GQ">Equatorial Guinea</option>
                                            <option value="ER">Eritrea</option>
                                            <option value="EE">Estonia</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="FK">Falkland Islands (Malvinas)</option>
                                            <option value="FO">Faroe Islands</option>
                                            <option value="FJ">Fiji</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="GF">French Guiana</option>
                                            <option value="PF">French Polynesia</option>
                                            <option value="TF">French Southern Territories</option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambia</option>
                                            <option value="GE">Georgia</option>
                                            <option value="DE">Germany</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">Gibraltar</option>
                                            <option value="GR">Greece</option>
                                            <option value="GL">Greenland</option>
                                            <option value="GD">Grenada</option>
                                            <option value="GP">Guadeloupe</option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">Guatemala</option>
                                            <option value="GG">Guernsey</option>
                                            <option value="GN">Guinea</option>
                                            <option value="GW">Guinea-Bissau</option>
                                            <option value="GY">Guyana</option>
                                            <option value="HT">Haiti</option>
                                            <option value="HM">Heard Island & Mcdonald Islands</option>
                                            <option value="VA">Holy See (Vatican City State)</option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">Hong Kong</option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="IN">India</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="IR">Iran, Islamic Republic Of</option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IM">Isle Of Man</option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="JP">Japan</option>
                                            <option value="JE">Jersey</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KZ">Kazakhstan</option>
                                            <option value="KE">Kenya</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KR">Korea</option>
                                            <option value="KW">Kuwait</option>
                                            <option value="KG">Kyrgyzstan</option>
                                            <option value="LA">Lao People's Democratic Republic</option>
                                            <option value="LV">Latvia</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LR">Liberia</option>
                                            <option value="LY">Libyan Arab Jamahiriya</option>
                                            <option value="LI">Liechtenstein</option>
                                            <option value="LT">Lithuania</option>
                                            <option value="LU">Luxembourg</option>
                                            <option value="MO">Macao</option>
                                            <option value="MK">Macedonia</option>
                                            <option value="MG">Madagascar</option>
                                            <option value="MW">Malawi</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malta</option>
                                            <option value="MH">Marshall Islands</option>
                                            <option value="MQ">Martinique</option>
                                            <option value="MR">Mauritania</option>
                                            <option value="MU">Mauritius</option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexico</option>
                                            <option value="FM">Micronesia, Federated States Of</option>
                                            <option value="MD">Moldova</option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolia</option>
                                            <option value="ME">Montenegro</option>
                                            <option value="MS">Montserrat</option>
                                            <option value="MA">Morocco</option>
                                            <option value="MZ">Mozambique</option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibia</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Nepal</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="AN">Netherlands Antilles</option>
                                            <option value="NC">New Caledonia</option>
                                            <option value="NZ">New Zealand</option>
                                            <option value="NI">Nicaragua</option>
                                            <option value="NE">Niger</option>
                                            <option value="NG">Nigeria</option>
                                            <option value="NU">Niue</option>
                                            <option value="NF">Norfolk Island</option>
                                            <option value="MP">Northern Mariana Islands</option>
                                            <option value="NO">Norway</option>
                                            <option value="OM">Oman</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PW">Palau</option>
                                            <option value="PS">Palestinian Territory, Occupied</option>
                                            <option value="PA">Panama</option>
                                            <option value="PG">Papua New Guinea</option>
                                            <option value="PY">Paraguay</option>
                                            <option value="PE">Peru</option>
                                            <option value="PH">Philippines</option>
                                            <option value="PN">Pitcairn</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="PR">Puerto Rico</option>
                                            <option value="QA">Qatar</option>
                                            <option value="RE">Reunion</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">Russian Federation</option>
                                            <option value="RW">Rwanda</option>
                                            <option value="BL">Saint Barthelemy</option>
                                            <option value="SH">Saint Helena</option>
                                            <option value="KN">Saint Kitts And Nevis</option>
                                            <option value="LC">Saint Lucia</option>
                                            <option value="MF">Saint Martin</option>
                                            <option value="PM">Saint Pierre And Miquelon</option>
                                            <option value="VC">Saint Vincent And Grenadines</option>
                                            <option value="WS">Samoa</option>
                                            <option value="SM">San Marino</option>
                                            <option value="ST">Sao Tome And Principe</option>
                                            <option value="SA">Saudi Arabia</option>
                                            <option value="SN">Senegal</option>
                                            <option value="RS">Serbia</option>
                                            <option value="SC">Seychelles</option>
                                            <option value="SL">Sierra Leone</option>
                                            <option value="SG">Singapore</option>
                                            <option value="SK">Slovakia</option>
                                            <option value="SI">Slovenia</option>
                                            <option value="SB">Solomon Islands</option>
                                            <option value="SO">Somalia</option>
                                            <option value="ZA">South Africa</option>
                                            <option value="GS">South Georgia And Sandwich Isl.</option>
                                            <option value="ES">Spain</option>
                                            <option value="LK">Sri Lanka</option>
                                            <option value="SD">Sudan</option>
                                            <option value="SR">Suriname</option>
                                            <option value="SJ">Svalbard And Jan Mayen</option>
                                            <option value="SZ">Swaziland</option>
                                            <option value="SE">Sweden</option>
                                            <option value="CH">Switzerland</option>
                                            <option value="SY">Syrian Arab Republic</option>
                                            <option value="TW">Taiwan</option>
                                            <option value="TJ">Tajikistan</option>
                                            <option value="TZ">Tanzania</option>
                                            <option value="TH">Thailand</option>
                                            <option value="TL">Timor-Leste</option>
                                            <option value="TG">Togo</option>
                                            <option value="TK">Tokelau</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TT">Trinidad And Tobago</option>
                                            <option value="TN">Tunisia</option>
                                            <option value="TR">Turkey</option>
                                            <option value="TM">Turkmenistan</option>
                                            <option value="TC">Turks And Caicos Islands</option>
                                            <option value="TV">Tuvalu</option>
                                            <option value="UG">Uganda</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="AE">United Arab Emirates</option>
                                            <option value="GB">United Kingdom</option>
                                          	<option value="US" selected="selected">United States</option>
                                            <option value="UM">United States Outlying Islands</option>
                                            <option value="UY">Uruguay</option>
                                            <option value="UZ">Uzbekistan</option>
                                            <option value="VU">Vanuatu</option>
                                            <option value="VE">Venezuela</option>
                                            <option value="VN">Viet Nam</option>
                                            <option value="VG">Virgin Islands, British</option>
                                            <option value="VI">Virgin Islands, U.S.</option>
                                            <option value="WF">Wallis And Futuna</option>
                                            <option value="EH">Western Sahara</option>
                                            <option value="YE">Yemen</option>
                                            <option value="ZM">Zambia</option>
                                          <option value="ZW">Zimbabwe</option>
										</select>
								  </div>
								</form>
							</div>
						</div>
					</div>
                    <div class="box grid_8 round_all">
						<h2 class="box_head grad_colour">Use Carrier</h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
						<div class="toggle_container">
							<div class="block">
								<form method="post" name="car_form">	
           						  <label>Add Carrier</label> 
								  <input name="car" title="Insert carrier" type="text" class="medium"><button type="submit" name="add_car" class="button_colour round_all"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Truck.png"><span>Save New Add Carrier</span></button>
                                  	
                                  	<label>Check Boxes</label>
									<div class="input_group">
                                    <?php
									include "libraries/mysqlconnect.php";
									$query="SELECT * FROM carriers";
									$result=mysql_query($query) or die ("Error collecting the carriers");
									while ($row=@mysql_fetch_assoc($result)){
									echo "<input type='checkbox' name='option' value='{$row['carrier']}'>{$row['carrier']}<a href='delcar.php?id={$row['id']}'><img height='24' width='24' style='vertical-align:middle' alt='Bended Arrow Right' src='images/icons/small/grey/Alert%202.png'></a><br>";
									}
									include "libraries/closecon.php";
									?> 
									</div> 
						
							</div>
						</div>
					</div>
       
				</div>
			</div>
		</div>
        		</form>
<?php include 'includes/closing_items.php'?>
<?php

if (isset($_POST['buttonfinish'])){
$CN=$_POST['CN'];
$mail=$_POST['mail'];
$PT=$_POST['PT'];
include "libraries/mysqlconnect.php";
if ($vacio==true){
$query="INSERT INTO companyInformation (CN,mail,PT) VALUES ('$CN','$mail','$PT')";
}else{
$query="UPDATE companyInformation SET CN='$CN', mail='$mail', PT='$PT'";
}
mysql_query($query) or die ("ERROR!");
include "libraries/closecon.php";
	echo "<meta http-equiv=refresh content=0;URL={$_SERVER['PHP_SELF']}>";

}

if (isset($_POST['buttonfinishM'])){

$option=$_POST['option'];
if ($option=="1"){
$activado=1;
}else{
$activado=0;
}
$Mtext=$_POST['Mtext'];
include "libraries/mysqlconnect.php";
if ($vacio2==true){
$query="INSERT INTO MMode (activado,Mtext) VALUES ($activado,'$Mtext')";
}else{
$query="UPDATE MMode SET activado=$activado, Mtext='$Mtext'";
}
mysql_query($query) or die ("ERROR!");
include "libraries/closecon.php";
	echo "<meta http-equiv=refresh content=0;URL={$_SERVER['PHP_SELF']}>";

}



if (isset($_POST['add_car'])){
include "libraries/mysqlconnect.php";
if (trim($_POST['car'])!=""){
$query="INSERT INTO carriers (carrier) VALUES ('" . $_POST['car'] . "')";
mysql_query($query) or die ("Error inserting carrier");

}

include "libraries/closecon.php";
}

}else{
header("Location:login.php");
}
?>
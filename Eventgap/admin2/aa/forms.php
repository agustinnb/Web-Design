<?php include 'includes/document_head.php'?>
		<div id="wrapper">
			<?php include 'includes/topbar.php'?>		
			<?php include 'includes/sidebar.php'?>
				<div id="main_container" class="main_container container_16 clearfix">
					<?php include 'includes/navigation.php'?>
					<div class="flat_area grid_16">
						<h2>Form elements and controls</h2>
						<p>Check out the Application like <a href="#">navigation</a>. Resize to see the liquid layout in action. Expand/Collapse and sort boxes. Try out the WYSIWYGs.</p>
					</div>
					<div class="box grid_8 round_all">
						<h2 class="box_head grad_colour">Form Elements</h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
						<div class="toggle_container">
							<div class="block">
								<form>
									<label>Small input form</label> 
									<input title="This field has an HTML5 autofocus property" type="text" class="small required" autofocus> 
					
									<label>Medium input form</label> 
									<input title="This is a tool tip" type="text" class="medium">
								
									<label>Long input form</label> 
									<input title="A tooltip can be set on any object by giving it a title property" type="text" class="large"> 
							
									<label>Regular Text Area</label> 
									<textarea></textarea> 
							
									<button class="button_colour round_all"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span>Submit</span></button>
								</form>
							</div>
						</div>
					</div>
					<div class="box grid_8 round_all">
						<h2 class="box_head grad_colour">Form Elements</h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
						<div class="toggle_container">
							<div class="block">
								<form>
									<label>Modal Popup</label>
									<button id="opener" class="skin_colour round_all"><img width="24" height="24" alt="Speech Bubble 2" src="images/icons/small/white/Speech Bubble 2.png"><span>Open Dialog</span></button>
									<div id="dialog" title="Popup Dialog">
										<p>
											This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.
										
										</p>
									</div>

									<label>Radio Buttons</label>
									<div class="input_group">
										<input type="radio" name="radio" value="option 1" checked>First option<br>
										<input type="radio" name="radio" value="option 2">Second option<br>
										<input type="radio" name="radio" value="option 3">Third option
									</div>

									<label>Check Boxes</label>
									<div class="input_group">
										<input type="checkbox" name="option" value="option 1">First option<br>
										<input type="checkbox" name="option" value="option 2">Second option<br>
										<input type="checkbox" name="option" value="option 3">Third option
									</div>

									<label>Select Menu</label>
									<div class="input_group">
										<select>
											<option value="apples">
												Apples
											</option>
											<option value="oranges">
												Oranges
											</option>
											<option value="bananas">
												Bananas
											</option>
										</select>
									</div>

									<label>Please Upload a File</label>
									<div class="input_group">
										<input type="file">
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="box grid_8 round_all">
						<h2 class="box_head grad_colour round_top">Alert Boxes</h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
						<div class="toggle_container">
							<div class="block">
								<p>These alerts can have any of the 400+ icons. Click to dismiss and they'll fade away!</p>
								<div class="alert alert_blue">
								<img height="24" width="24" src="images/icons/small/white/Alert%202.png">
								This is a <strong>blue</strong> Alert!
								</div>					
								<div class="alert alert_green">
								<img height="24" width="24" src="images/icons/small/white/Alert.png">
								This is a <strong>green</strong> Alert!
								</div>
								<div class="alert alert_red">
								<img height="24" width="24" src="images/icons/small/white/Alarm%20Bell.png">
								This is a <strong>red</strong> Alert!
								</div>
								<div class="alert alert_orange">
								<img height="24" width="24" src="images/icons/small/white/Alarm%20Clock.png">
								This is an <strong>orange</strong> Alert!
								</div>
								<div class="alert alert_black">
								<img height="24" width="24" src="images/icons/small/white/Locked%202.png">
								This is a <strong>black</strong> Alert!
								</div>
								<div class="alert alert_navy">
								<img height="24" width="24" src="images/icons/small/white/Cog%203.png">
								This is a <strong>navy</strong> Alert!
								</div>
								<div class="alert alert_grey">
								<img height="24" width="24" src="images/icons/small/grey/Speech%20Bubble%202.png">
								This is a <strong>grey</strong> Alert!
								</div>
							</div>
						</div>
					</div>
					<div class="box grid_8 round_all">
						<h2 class="box_head grad_colour">More Elements <small>(jQuery UI, themeroller compatible)</small></h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
							<div class="toggle_container">
								<div class="block">
									<form>

									<label>Inline Date Picker</label>
									<div class="datepicker"></div>

									<label>Date Field</label> 
									<input type="text" class="datepicker"> 

									<label>Slider Control</label>
									<div class="slider"></div>

									<label>Range Slider Control</label>
									<div class="slider_range"></div>

									<label>Progress Bar</label>
									<div id="progressbar"></div>

									<button class="button_colour"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span>Submit</span></button>
								</form>							
							</div>
						</div>
					</div>	
					<div class="box grid_8 round_all">
						<h2 class="box_head grad_colour round_top">HTML5 Elements <small>(Not available on every browser)</small></h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle toggle_closed">&nbsp;</a>
						<div class="toggle_container" style="display:none;">
							<div class="block">
								<form>						
									<label>HTML5 Number box</label>
									<input type="number"
									       min="0"
									       max="10"
									       step="2"
									       value="6">

									<label>HTML5 native slider</label>
									<input type="range"
									       min="0"
									       max="10"
									       step="2"
									       value="6">

								</form>
							</div>
						</div>
					</div>
					
					<div class="box grid_8 round_all">
						<h2 class="box_head grad_colour round_top">Form Validation</h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
						<div class="toggle_container">
							<div class="block">
								<form>
									<label>This input cannot be empty</label> 
									<input id="notempty" type="text" class="medium">
									
									<label>This input has to be an email address</label> 
									<input id="realemail" type="text" class="medium">
									
									<label>Enter atleast 30 characters</label> 
									<textarea id="atleast" style="height:auto"/></textarea>
									<button class="button_colour"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span>Submit</span></button>
								</form>

								<script type="text/javascript"> 
						            var notempty = new LiveValidation('notempty');
									notempty.add( Validate.Presence );

									var realemail = new LiveValidation('realemail');
									realemail.add( Validate.Email );

									var atleast = new LiveValidation('atleast');
									atleast.add( Validate.Length, { minimum: 30 } );

								</script>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'includes/closing_items.php'?>
<?php include 'includes/document_head.php'?>
		<div id="wrapper">
			<?php include 'includes/topbar.php'?>		
			<?php include 'includes/sidebar.php'?>
			<div class="main_container container_16 clearfix">
				<?php include 'includes/navigation.php'?>	
				<div class="box grid_6 round_all tabs">
					<ul class="tab_header grad_colour clearfix">
						<li>
							<a href="#tabs-1">Layout</a>
						</li>
						<li>
							<a href="#tabs-2" class="round_top">Tricycle</a>
						</li>
					</ul>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<div id="tabs-1" class="block no_padding">
							<ul class="full_width">
								<li>Toggle <a href="{site_url}css/theme/switcher1.php?style=../layout_fixed.css">Fixed</a> and <a href="css/theme/switcher1.php?style=switcher.css">Fluid</a> width layout</li>
								<li><a href="{site_url}css/theme/switcher2.php?style=switcher.css">Sidebar</a> or <a href="css/theme/switcher2.php?style=../layout_top.css">Full Width</a></li>								
								<li class="theme_colour round_all">
									<a class="black" href="css/theme/switcher3.php?style=switcher.css">
										<span>Black</span></a>
									<a class="blue" href="css/theme/switcher3.php?style=theme_blue.css">
										<span>Blue</span></a>
									<a class="navy" href="css/theme/switcher3.php?style=theme_navy.css">
										<span>Navy</span></a>
									<a class="red" href="css/theme/switcher3.php?style=theme_red.css">
										<span>Red</span></a>
									<a class="green" href="css/theme/switcher3.php?style=theme_green.css">
										<span>Green</span></a>
									<a class="magenta" href="css/theme/switcher3.php?style=theme_magenta.css">
										<span>Magenta</span></a>
									<a class="orange" href="css/theme/switcher3.php?style=theme_brown.css">
										<span>Brown</span></a>
								</li>
								<li><a href="css/theme/switcher2.php?style=../header_slideout.css">New Slide Menu!</a> Check it out.</li>
							</ul>
						</div>
						<div id="tabs-2" class="block">
							<div class="content">
								<p><strong>Adminica</strong> was created by <a href="http://www.tricycle.ie" target="_blank">Tricycle Interactive</a>. Please visit our site and have a look around - <a href="http://www.tricycle.ie" target="_blank">www.tricycle.ie</a></p>
								<p>If you need special customization to the theme, please email <strong>themeforest@tricycle.ie</strong>.
							</div>
						</div>
					</div>
				</div>		
				
				<div class="flat_area grid_10">
					<h2>Welcome to <strong>Adminica</strong></h2>
					<p><strong>Adminica</strong> is a <strong>cleanly coded</strong>, <strong>beautifully styled</strong>, easily <strong>customisable</strong>, <strong>cross-browser</strong> compatible <strong>Web Application Interface</strong>.</p>

					<p><strong>Adminica</strong> is packed full of features, allowing you<strong> unlimited combinations</strong> of layouts, controls and styles to ensure you have a <strong>trully unique app</strong>. </p>

					<p><strong>Adminica</strong>  can <strong>scale itself automatically</strong> to fit whatever screen resolution the user has. The interface<strong> works perfectly all the way down to iPhone size</strong></p>
				</div>				
			</div>
			
			<div class="main_container container_16 clearfix">
				<div id="feature_container" class="grid_16">					
						
					<form id="filter" class="clearfix indent gallery_sorter">
				  		<fieldset class="grid_7 alpha">
						    <H3>Features:</h3>
						    <label><input type="radio" name="type" value="all" checked="checked">All</label>
						    <label><input type="radio" name="type" value="new">New</label>
						    <label><input type="radio" name="type" value="cool">Cool</label>
						</fieldset>
						<fieldset class="grid_7 omega">
						    <h3>Sort by</h3>
						    <label><input type="radio" name="sort" value="name" checked="checked">Name</label>
						    <label><input type="radio" name="sort" value="update">Update</label>    
						</fieldset>
					</form>
					
					<ul class="feature_list clearfix">

						<li data-id="side_nav" data-type="cool">
							<a href="css/theme/switcher2.php?style=switcher.css" class="features">
							<img src="images/content/sidebar.png"><strong>Side Nav</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div>
							</a>
						</li>

						<li data-id="slideout" data-type="new">
							<a href="css/theme/switcher2.php?style=../header_slideout.css" class="features">
							<img src="images/content/side_top.png"><strong>Slide Nav</strong>
							<span class="update">1</span>
							<div class="starred blue">&nbsp;</div>
							</a>
						</li>

						<li data-id="full_width" data-type="all">
							<a href="css/theme/switcher2.php?style=../header_top.css" class="features">
							<img src="images/content/full_width.png"><strong>Full Width</strong>
							<span class="update">0</span>
							</a>
						</li>							
							
						<li data-id="drag" data-type="all">
							<a href="layout.php" class="features">
							<img src="images/content/sortable.png"><strong>Drag, Sort & Toggle</strong>
							<span class="update">0</span>
							</a>
						</li>
							
						<li data-id="tabs" data-type="cool">
							<a id="opener" href="tabs.php" class="features">
							<img src="images/content/tabs.png"><strong>2 Types of Tabs</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div></a>
						</li>
							
						<li data-id="accordion" data-type="cool">
							<a href="accordions.php" class="features">
							<img src="images/content/accordion.png"><strong>Sortable Accordions</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div></a>
						</li>
							
						<li data-id="fluid_width" data-type="cool">
							<a href="css/theme/switcher1.php?style=switcher.css" class="features">
							<img src="images/content/fluid.png"><strong>Fluid Width</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div>
							</a>
						</li>

						<li data-id="fixed_width" data-type="cool">
							<a href="css/theme/switcher1.php?style=../layout_fixed.css" class="features">
							<img src="images/content/fixed.png"><strong>Fixed Width</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div>
							</a>
						</li>
						<li data-id="nav" data-type="all">
							<a href="#" class="features">
							<img src="images/content/nav.png"><strong>Unique Navigation</strong>
							<span class="update">0</span>
							</a>
						</li>
							
						<li data-id="iOS" data-type="cool">
							<a href="css/theme/switcher1.php?style=switcher.css" class="features"><img src="images/content/touchscreens.png"><strong>iOS & Android Ready</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div></a>
						</li>
							
						<li data-id="syntax" data-type="all">
							<a href="code.php" class="features">
							<img src="images/content/code.png"><strong>Syntax Highlighting</strong>
							<span class="update">0</span>
							</a>
						</li>
							
						<li data-id="themes" data-type="cool">
							<a href="theme.php" class="features">
							<img src="images/content/themes.png"><strong>7 Themes</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div></a>
						</li>

						<li data-id="theme_switcher" data-type="new">
							<a href="#" class="features">
							<img src="images/content/theme_switcher.png"><strong>Theme Switcher</strong>
							<span class="update">1</span>
							<div class="starred blue">&nbsp;</div>
							</a>
						</li>
							
						<li data-id="contact" data-type="cool">
							<a href="contacts.php" class="features">
							<img src="images/content/contacts.png"><strong>Unique Slider Lists</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div></a>
						</li>
							
						<li data-id="icons" data-type="all">
							<a href="buttons.php" class="features">
							<img src="images/content/icons.png"><strong>400+ Icons</strong>
							<span class="update">0</span>
							</a>
						</li>
							
						<li data-id="buttons" data-type="cool">
							<a href="buttons.php" class="features">
							<img src="images/content/buttons.png"><strong>290+ CSS3 Buttons</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div></a>
						</li>
							
						<li data-id="forms" data-type="all">
							<a href="forms.php" class="features">
							<img src="images/content/forms.png"><strong>Fully Styled Forms</strong>
							<span class="update">0</span>
							</a>
						</li>
							
						<li data-id="date" data-type="all">
							<a href="forms.php" class="features">
							<img src="images/content/datepicker.png"><strong>Date Picker</strong>
							<span class="update">0</span>
							</a>
						</li>

						<li data-id="dismiss_box" data-type="new">
							<a href="forms.php" class="features">
							<img src="images/content/dismiss_box.png"><strong>Alert Boxes</strong>
							<span class="update">1</span>
							<div class="starred blue">&nbsp;</div>
							</a>
						</li>
							
						<li data-id="960" data-type="all">
							<a href="layout.php" class="features">
							<img src="images/content/960.png"><strong>960.gs Framework</strong>
							<span class="update">0</span>
							</a>
						</li>
						
						<li data-id="typography" data-type="all">
							<a href="text.php" class="features">
							<img src="images/content/typography.png"><strong>Typography & Text</strong>
							<span class="update">0</span>
							</a>
						</li>
						
						<li data-id="RTE" data-type="all">
							<a href="editor.php" class="features">
							<img src="images/content/type.png"><strong>Rich Text Editor</strong>
							<span class="update">0</span>
							</a>
						</li>
						
						<li data-id="sortable_gallery" data-type="cool">
							<a href="gallery_sortable.php" class="features">
							<img src="images/content/gallery.png"><strong>Sortable Gallery</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div>
							</a>
						</li>
						
						<li data-id="gallery" data-type="cool">
							<a href="gallery.php" class="features">
							<img src="images/content/fancybox.png"><strong>Fancybox Viewer</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div>
							</a>
						</li>
						
						<li data-id="tables" data-type="cool">
							<a href="tables.php" class="features">
							<img src="images/content/tables.png"><strong>Dynamic Tables</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div>
							</a>
						</li>
						
						<li data-id="files" data-type="cool">
							<a href="files.php" class="features">
							<img src="images/content/files.png"><strong>File Browser</strong>
							<span class="update">0</span>
							<div class="starred">&nbsp;</div>
							</a>
						</li>
						
						<li data-id="login" data-type="all">
							<a href="login.php" class="features">
							<img src="images/content/login.png"><strong>Login Box</strong>
							<span class="update">0</span>
							</a>
						</li>
						
						<li data-id="CSS3" data-type="all">
							<a href="#" class="features">
							<img src="images/content/css3.png"><strong>CSS3 enhanced</strong>
							<span class="update">0</span>
							</a>
						</li>
						
						<li data-id="cross_browser" data-type="all">
							<a href="#" class="features">
							<img src="images/content/browser.png"><strong>Cross Browser (IE7+)</strong>
							<span class="update">0</span>
							</a>
						</li>

						<li data-id="scroll_top" data-type="new">
							<a href="#" class="features">
							<img src="images/content/scroll_top.png"><strong>Scroll Top</strong>
							<span class="update">1</span>
							<div class="starred blue">&nbsp;</div>
							</a>
						</li>
				
					</ul>
				</div>
			</div>
			<div class="main_container container_16 clearfix">
				<div class="flat_area grid_16">
					<p><strong>Adminica</strong> comes bundled with <strong>7 beautiful themes</strong> and backgrounds (...my favorite are <a href="css/theme/switcher1.php?style=multiple&switcher3.php=theme_navy.css&switcher4.php=bg_wood.css">navy</a> and <a href="css/theme/switcher1.php?style=multiple&switcher3.php=theme_blue.css&switcher4.php=bg_honeycomb.css">blue</a>). You can easily create your own themes by specifying your own colour values. All gradients and buttons have been created using <strong>CSS3 so no need to save out new images!</strong></p>
				</div>
			</div>
			<div class="main_container container_16 clearfix fullsize">
				<div class="box grid_16 round_all">
					<ul class="block content_accordion no_header">
						<li>
							<a href="#" class="handle">&nbsp;</a>
							<h3 class="bar">First Heading</h3>
							<div class="content no_padding">
								<table class="display table" > 
									<thead> 
										<tr> 
											<th>Rendering engine</th> 
											<th>Browser</th> 
											<th>Platform(s)</th> 
											<th>Engine version</th> 
											<th>CSS grade</th> 
										</tr> 
									</thead> 
									<tbody> 
										<tr class="gradeX"> 
											<td>Trident</td> 
											<td>Internet
												 Explorer 4.0</td> 
											<td>Win 95+</td> 
											<td class="center">4</td> 
											<td class="center">X</td> 
										</tr> 
										<tr class="gradeC"> 
											<td>Trident</td> 
											<td>Internet
												 Explorer 5.0</td> 
											<td>Win 95+</td> 
											<td class="center">5</td> 
											<td class="center">C</td> 
										</tr> 
										<tr class="gradeA"> 
											<td>Trident</td> 
											<td>Internet
												 Explorer 5.5</td> 
											<td>Win 95+</td> 
											<td class="center">5.5</td> 
											<td class="center">A</td> 
										</tr> 
										<tr class="gradeA"> 
											<td>Trident</td> 
											<td>Internet
												 Explorer 6</td> 
											<td>Win 98+</td> 
											<td class="center">6</td> 
											<td class="center">A</td> 
										</tr> 
										<tr class="gradeU"> 
											<td>Other browsers</td> 
											<td>All others</td> 
											<td>-</td> 
											<td class="center">-</td> 
											<td class="center">U</td> 
										</tr> 
									</tbody> 
								</table>
								
	
								
							</div>
						</li>
						<li>
							<a href="#" class="handle">&nbsp;</a>
							<h3 class="bar">Second Heading</h3>
							<div class="content">
								<p>Content goes here</p>
							</div>
						</li>
						<li>
							<a href="#" class="handle">&nbsp;</a>
							<h3 class="bar">Third Heading</h3>
							<div class="content">
								<p>Content goes here</p>
							</div>
						</li>
						<li>
							<a href="#" class="handle">&nbsp;</a>
							<h3 class="bar">Fourth Heading</h3>
							<div class="content">
								<p>Content goes here</p>
							</div>
						</li>
					</ul>
				</div>
			</div>	
		</div>	
<?php include 'includes/closing_items.php'?>
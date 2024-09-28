<?php include 'includes/document_head.php'?>
		<div id="wrapper">
		<?php include 'includes/topbar.php'?>		
		<?php include 'includes/sidebar.php'?>
		<div id="main_container" class="main_container container_16 clearfix">
			<?php include 'includes/navigation.php'?>
			<div class="flat_area grid_16">
				<h2>Accordion Controls <small>(<strong>note:</strong> these will not play music)</small></h2>
				<p>Below is a standard accordion control placed inside a regular box. It can be <strong>dragged</strong> and <strong>dropped</strong> and <strong>toggled</strong> like any other box. Click on the accordion bars to open and close it. </p>
				
				<p><strong>Bonus feature</strong>, you can rearrange the bars by grabbing the dotted area to the right of the bar. <strong>Go ahead and try it out</strong>.</p>
			</div>
			<div class="box grid_16">
				<h2 class="box_head grad_colour">Accordion with Heading</h2>
				<a href="#" class="grabber">&nbsp;</a>
				<a href="#" class="toggle">&nbsp;</a>
				<div class="toggle_container">
					<ul class="block content_accordion">
						<li>
							<a href="#" class="handle">&nbsp;</a>
							<h3 class="bar">First Heading</h3>
							<div class="content">
								<h1>Primary Heading</h1>
								<p>Lorem Ipsum is simply dummy text of the <a href="#" title="This is a tooltip">printing industry</a>. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> 
			
								<h2>Secondary Heading</h2>
								<p>Lorem Ipsum is simply dummy text of the printing industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> 				
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
			<div class="flat_area grid_16">
				<p>The next accordions dont have headers. This can sometimes be a cleaner, <strong>more simple way to present information.</strong> This type of accordion cannot be dragged (at the moment anyway) but its bars can still be rearranged. </p>
			</div>
			<div class="box grid_8 round_all">
				<ul class="block content_accordion no_header">
					<li>
						<a href="#" class="handle">&nbsp;</a>
						<h3 class="bar">First Heading</h3>
						<div class="content">
							<p>Content goes here</p> 
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
				<div class="box grid_8 round_all">
					<ul class="block content_accordion no_header">
						<li>
							<a href="#" class="handle">&nbsp;</a>
							<h3 class="bar">First Heading</h3>
							<div class="content">
								<p>Content goes here</p>
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
				<div class="flat_area grid_16">
					<p><strong>Note:</strong> Like nearly all Adminica layout objects, the accordions width can be controlled using the <strong>960.gs</strong> grid system, eg. to make a full width accordion you would give the box it is contained in a <strong>class="grid_16"</strong>.</p>
				</div>
			</div>		
			<div class="main_container container_16 clearfix fullsize">
				<div class="box grid_16 round_all">
					<ul class="block content_accordion no_header">
						<li>
							<a href="#" class="handle">&nbsp;</a>
							<h3 class="bar">First Heading</h3>
							<div class="content">
								<p>Content goes here</p>
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
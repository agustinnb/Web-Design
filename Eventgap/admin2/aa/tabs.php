<?php include 'includes/document_head.php'?>
		<div id="wrapper">
			<?php include 'includes/topbar.php'?>		
			<?php include 'includes/sidebar.php'?>
			<div id="main_container" class="main_container container_16 clearfix">
				<?php include 'includes/navigation.php'?>
				<div class="flat_area grid_16">
					<h2>Tab Controls</h2>
					<p>Like accordions, tabs are a great way to<strong> present alot of content/data without overwhelming the user</strong>. <strong>Adminica</strong> has two types: a regular <strong>horizontal tab</strong> layout and a <strong>vertical tab</strong> layout. </p>
					<p><strong>Note: </strong>Like nearly all Adminica layout objects, the tab boxes width can be controlled using the <a target="_blank" href="http://www.960.gs">960.gs Grid System</a>. In this example, both tab boxes have a <strong>class="grid_8".</strong></p>
				</div>
			
				<div class="box grid_8 tabs">
					<ul class="tab_header grad_colour clearfix">
						<li><a href="#tabs-1">Quicklinks</a></li>
						<li><a href="#tabs-2">Content</a></li>
					</ul>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<div id="tabs-1" class="block no_padding">
							<ul class="full_width">
								<li>Aenean tempor ullamcorper</li>
								<li>Rutrum commodo, vehicula tempus</li>
								<li><a href="#">Curabitur nec arcu</a></li>
								<li>Donec sollicitudin mi sit amet mauris</li>
							</ul>
						</div>
						<div id="tabs-2" class="block">
							<div class="content">
								<h1>Primary Heading</h1>
								<p>Lorem Ipsum is simply dummy text of the <a href="#" title="This is a tooltip">printing industry</a>. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> 
								<h2>Secondary Heading</h2>
								<p>Lorem Ipsum is simply dummy text of the printing industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> 					</div>
						</div>
					</div>
				</div>
				<div class="box grid_8 side_tabs tabs">
					<div class="side_holder">
						<ul class="tab_sider clearfix">
							<li><a href="#tabs-a">Daily Stats</a></li>
							<li><a href="#tabs-b">Content</a></li>
							<li><a href="#tabs-c">Tab 3</a></li>
							<li><a href="#tabs-d">Tab 4</a></li>			
							<li><a href="#tabs-e">Tab 5</a></li>	
						</ul>
					</div>
					<div id="tabs-a" class="block no_padding tab_sider">
						<ul class="full_width">
							<li><span>341</span>Items</li>
							<li><span>892</span>Posts</li>
							<li><span>12,062</span>Comments</li>
							<li><span>90,568</span>Members</li>
							<li><span>103,451</span>Unique Visitors</li>
							<li><span>983,876</span>Hits</li>
							<li><span>7,543,948</span>Monthly Hits</li>
						</ul>
					</div>
					<div id="tabs-b" class="block tab_sider">
						<div class="content">
							<h1>Primary Heading</h1>
							<p>Lorem Ipsum is simply dummy text of the <a href="#" title="This is a tooltip">printing industry</a>. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> 

							<h2>Secondary Heading</h2>
							<p>Lorem Ipsum is simply dummy text of the printing industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> 
						</div>
					</div>
					<div id="tabs-c" class="block tab_sider" style="min-height:193px;">
						<div class="content">
							<p>Content goes here.</p> 
						</div>
					</div>
					<div id="tabs-d" class="block tab_sider" style="min-height:193px;">
						<div class="content">
							<p>Content goes here.</p>
						</div>
					</div>
					<div id="tabs-e" class="block tab_sider" style="min-height:193px;">
						<div class="content">
							<p>Content goes here.</p>
						</div>
					</div>
				</div>	
				<div class="flat_area grid_16">
					<p><strong>Note: </strong>The vertical version cannot be toggled/dragged at the moment but this feature is <strong>coming soon</strong>.</p>
				</div>
			</div>
		</div>
<?php include 'includes/closing_items.php'?>
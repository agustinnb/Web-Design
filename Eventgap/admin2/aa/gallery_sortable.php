<?php include 'includes/document_head.php'?>
		<div id="wrapper">	
			<?php include 'includes/topbar.php'?>		
			<?php include 'includes/sidebar.php'?>
			<div id="main_container" class="main_container container_16 clearfix">
<?php include 'includes/navigation.php'?>
				<div class="flat_area grid_16">
					<h2>Sortable Gallery</h2>
					<p>This is one of <strong>Adminica</strong>'s coolest features, a dynamically sortable gallery. Change the radio buttons and watch them slide! </p>
					<p><strong>You can sort anything with this not just image tiles</strong> eg. it could rearrange a contact or feature list.</p>
					<form id="filter" class="clearfix indent gallery_sorter">
				  		<fieldset class="grid_7 alpha">
						    <H3>Filter by colour</h3>
						    <label><input type="radio" name="type" value="all" checked="checked">All</label>
						    <label><input type="radio" name="type" value="blue">Blue</label>
						    <label><input type="radio" name="type" value="sepia">Sepia</label>
						    <label><input type="radio" name="type" value="grey">Black & White</label>
						</fieldset>
						<fieldset class="grid_7 omega">
						    <h3>Sort by</h3>
						    <label><input type="radio" name="sort" value="name" checked="checked">Name</label>
						    <label><input type="radio" name="sort" value="size">Size</label>      
						</fieldset>
					</form>
					<div class="indent gallery">
						<?php include 'includes/gallery_images.php'?>
					</div>
					<p><strong>Note:</strong> You will need moderate programming ability if you want to change how the sorter works, eg. If you wanted to reverse sort or sort by date. However, if you just want to add more categories then it's a piece of cake.</p>
				</div>		
			</div>
		</div>
<?php include 'includes/closing_items.php'?>
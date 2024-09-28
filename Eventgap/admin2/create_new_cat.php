<?php 
session_start();
if (isset($_SESSION['username'])){
include 'includes/document_head.php'?>

		<div id="wrapper">
			<?php include 'includes/topbar.php'?>		
			<?php include 'includes/sidebar.php'?>
				<div id="main_container" class="main_container container_16 clearfix">
					<?php include 'includes/navigation.php'?>
					<div class="flat_area grid_16">
						<h2>Create New Category</h2>
						<p>This is where you configure all your Categories.</p>
					</div>
					<div class="box grid_8 round_all">
						<h2 class="box_head grad_colour">Create New Category</h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
						<div class="toggle_container">
							<div class="block">
                               <?php if (isset($_GET['id'])){
								 include "libraries/mysqlconnect.php";
								 $query="SELECT * FROM categories WHERE id=" . $_GET['id'];
								 $result=mysql_query($query);
								 $row=@mysql_fetch_assoc($result);
								 }
								?>
								<form name="create_cat" method="post">	
                                	<label>Category</label> 
								  <input name="cat" <?php if (isset($_GET['id'])){ echo "value='" . $row['cat'] . "'"; } ?> title="Enter the category name" type="text" class="large"> 
              						
							
									<button name="add_cat_but" type="submit" class="button_colour round_all"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span>Submit</span></button>
								</form>
                                  <?php if (isset($_GET['id'])){
								 include "libraries/closecon.php"; }
								?> 
							</div>
                                    <?php if (isset($_GET['success'])){ ?>
                            <div align="center" class="large">Category was succesfully inserted</div>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
        
<?php
if (isset($_POST['add_cat_but'])){
include "libraries/mysqlconnect.php";
$cat=$_POST['cat'];
if (isset($_GET['id'])){
		$query="UPDATE categories SET cat='$cat' WHERE id=" . $_GET['id'];
}else{
	$query="INSERT INTO categories (cat) VALUES ('$cat')";
}
mysql_query($query) or die ("Error inserting the product in the DB");


include "libraries/closecon.php";
 	echo "<meta http-equiv=refresh content=0;URL=create_new_cat.php?success=1>";
}



include 'includes/closing_items.php';

}else{
header("Location:login.php");
}
?>
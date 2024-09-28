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
						<h2>Category List</h2>
					</div>
                    <div class="box grid_16 round_all">
				<table class="display table"> 
					<thead> 
						<tr>
						  	<th>ID</th> 
							<th>Category</th> 
							<th>Delete</th> 
						</tr> 
					</thead> 
					<tbody> 
                    <?php 
					include "libraries/mysqlconnect.php";
					$query="SELECT * FROM categories";
					$result=@mysql_query($query);
					while ($row=@mysql_fetch_assoc($result)){
					echo "	<tr>
                        
						 	<td>" . $row['id'] . "</td> 
							<td><a href='create_new_cat.php?id=" . $row['id'] . "'>{$row['cat']}</a></td> 
							<td><a href='delcat.php?id={$row['id']}'>Delete</a></td> 
							</tr> ";
					}
					
					include "libraries/closecon.php";
					
					?>
				
					</tbody> 
				</table>
			</div>
				</div>
			</div>
		</div>
<?php include 'includes/closing_items.php';
}else{
header("Location:login.php");
}


?>
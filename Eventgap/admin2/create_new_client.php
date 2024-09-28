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
						<h2>Add New Client</h2>
					</div>
					<div class="box grid_8 round_all">
						<h2 class="box_head grad_colour">Add New Client</h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
						<div class="toggle_container">
							<div class="block">
                            <?php if (isset($_GET['id'])){
								 include "libraries/mysqlconnect.php";
								 $query="SELECT * FROM users WHERE id=" . $_GET['id'];
								 $result=mysql_query($query);
								 $row=@mysql_fetch_assoc($result);
								 }
								?>
								<form method="post" name="add_client">	
              						<label>Company Name</label> 
								  	<input name="CN" title="Enter Company Name" <?php if (isset($_GET['id'])){ echo "value='" . $row['CN'] . "'"; } ?>  type="text" class="large"> 
                                    
                                    <label>Address</label> 
								  	<input name="address" title="Enter Address" <?php if (isset($_GET['id'])){ echo "value='" . $row['address'] . "'"; } ?>  type="text" class="large">
                                    
                                    <label>City</label> 
								  	<input name="city" title="Enter City" <?php if (isset($_GET['id'])){ echo "value='" . $row['city'] . "'"; } ?>  type="text" class="large">
                                    
                                    <label>State</label> 
								  	<input name="state" title="Enter State" <?php if (isset($_GET['id'])){ echo "value='" . $row['state'] . "'"; } ?>  type="text" class="large">
                                    
                                    <label>Phone. - extension</label> 
								  	<input name="phone" title="Enter Phone" <?php if (isset($_GET['id'])){ echo "value='" . $row['phone'] . "'"; } ?>  type="text" class="large">
                                    
                                    <label>Fax</label> 
								  	<input name="fax" title="Enter Fax" <?php if (isset($_GET['id'])){ echo "value='" . $row['fax'] . "'"; } ?>  type="text" class="large">
                                    
                                    <label>Authorized user 1</label> 
								  	<input name="user1" title="Enter user 1" <?php if (isset($_GET['id'])){ echo "value='" . $row['user1'] . "'"; } ?>  type="text" class="large">
                                    
                                    <label>Email</label> 
								  	<input name="mail1" title="Enter email user 1" <?php if (isset($_GET['id'])){ echo "value='" . $row['mail1'] . "'"; } ?>  type="text" class="large">
                                    
                                    <label>Password</label> 
								  	<input name="pass1" title="Enter email password user 1" type="text" class="large">
                                    
                                    <label>Authorized user 2</label> 
								  	<input name="user2" title="Enter user 2" <?php if (isset($_GET['id'])){ echo "value='" . $row['user2'] . "'"; } ?>  type="text" class="large">
                                    
                                    <label>Email</label> 
								  	<input name="mail2" title="Enter email user 2" <?php if (isset($_GET['id'])){ echo "value='" . $row['mail2'] . "'"; } ?>  type="text" class="large">
                                    
                                    <label>Password</label> 
								  	<input name="pass2" title="Enter email password user 2" type="text" class="large">
                                    
                         				
									<button type="submit" name="add_button" class="button_colour round_all"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span>Submit</span></button>
								</form>
                                 <?php if (isset($_GET['id'])){
								 include "libraries/closecon.php"; }
								?>    
							</div>
                            <?php if (isset($_GET['success'])){ ?>
                            <div align="center" class="large">Client was succesfully inserted</div>
						<?php } ?>
                        </div>
					</div>
				</div>
			</div>
		</div>
<?php 
include 'includes/closing_items.php';

if (isset($_POST['add_button'])){
				 $CN=$_POST['CN'];
				 $address=$_POST['address'];
				 $city=$_POST['city'];
				 $state=$_POST['state'];
				 $phone=$_POST['phone'];
				 $fax=$_POST['fax'];
				 $user1=$_POST['user1'];
				 $mail1=$_POST['mail1'];
				 if ($_POST['pass1']!=""){
				 $pass1=md5($_POST['pass1']);
				 }else{
					 $pass1="";
				 }
				 $user2=$_POST['user2'];
				 $mail2=$_POST['mail2'];
				 	 if ($_POST['pass2']!=""){
				 $pass2=md5($_POST['pass2']);
					 }else{
					 $pass2="";
					 }
				 include "libraries/mysqlconnect.php";
				 if(!(isset($_GET['id']))){
				 $query="INSERT INTO users (CN,address,city,state,phone,fax,user1,mail1,pass1,user2,mail2,pass2) VALUES ('$CN','$address','$city','$state','$phone','$fax','$user1','$mail1','$pass1','$user2','$mail2','$pass2')";
				 }else{
			 
			 
			 $query= "UPDATE users SET CN='$CN', address='$address', city='$city', state='$state', phone='$phone', user1='$user1',  mail1='$mail1', ";
				if ($pass1!=""){
				$query.="pass1='$pass1', ";
				}
				$query.="user2='$user2',mail2='$mail2'";
				if ($pass2!=""){
					$query.=", pass2='$pass2'";
						}
				$query.=" WHERE id=" . $_GET['id'];
				
				
				}
				 
				 mysql_query($query) or die ("There was an error inserting the client in the DB");
				 
				 	echo "<meta http-equiv=refresh content=0;URL=create_new_client.php?success=1>";
				 
				 include "libraries/closecon.php";
				 
				 }




}else{
header("Location:login.php");
}
?>
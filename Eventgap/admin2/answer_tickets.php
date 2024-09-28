<?php 
session_start();
if (isset($_SESSION['username'])){
if (isset($_GET['id'])){
include 'includes/document_head.php'?>
		<div id="wrapper">
			<?php include 'includes/topbar.php'?>		
			<?php include 'includes/sidebar.php'?>
				<div id="main_container" class="main_container container_16 clearfix">
					<?php include 'includes/navigation.php'?>
                                  <?php 
			include "libraries/mysqlconnect.php";
					$query="SELECT * FROM Tickets WHERE id=" . $_GET['id'];
					$result=@mysql_query($query);
					$row=@mysql_fetch_assoc($result);
					if ($row['state']=="Not answered"){
					$query2="SELECT CN FROM users WHERE id=" . $row['idQ'];
						$result2=@mysql_query($query2);
						$row2=@mysql_fetch_assoc($result2);
						
				$query3="SELECT id FROM admins WHERE name='" . $_SESSION['username'] . "'";
				$result3=@mysql_query($query3);
				$row3=@mysql_fetch_assoc($result3);
					
					include "libraries/closecon.php";
				
					?>
                    
					<div class="flat_area grid_16">
						<h2>Answer Ticket #<?php echo $row['id']; ?></h2>
					</div>
                    <div class="box grid_16 round_all">
					<div class="block">
						<p>Company name <strong><a href='create_new_client.php?id=<?php  echo $row['idQ']; ?>'><?php echo $row2['CN']; ?></a></strong></p>
                        <p>Date <strong><?php echo $row['FechaQ'] . " " . $row['HoraQ']; ?></strong></p>
                        <p><strong>Question</strong></p>
                        <p><?php echo $row['TextQ']; ?></p>
                        <form method="post" name="form_ans">
                        <p><strong>Answer</strong></p>
                        <p><textarea id="tiny_input" name="Ans"></textarea></p>
                        <p align="center"><button type="submit" name="buttonfinish" class="button_colour round_all"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span>Send answer</span></button></p>
                        </form>
                        <p><strong><?php if (isset($_GET['error'])){ echo "Ticket couldn't be send"; } if (isset($_GET['success'])){ echo "Ticket was send succesfully!"; } ?></strong></p>
					</div>
                    
                    <?php
					if (isset($_POST['buttonfinish'])){
						if($_POST['Ans']!=""){
					$TextA=$_POST['Ans'];
					$date=date("Y/m/d");
					$time = date("H:i");
					$state="Answered";
					$idA=$row3['id'];
								include "libraries/mysqlconnect.php";
					$query="UPDATE Tickets SET TextA='$TextA', HoraA='$time', FechaA='$date', state='$state', idA=$idA WHERE id={$row['id']}";
					mysql_query($query) or die ("<p>Error enviando</p>");
						include "libraries/closecon.php";
					echo "<meta http-equiv=refresh content=0;URL=view_tickets.php>";
						}else{
						echo "<meta http-equiv=refresh content=0;URL={$_SERVER['PHP_SELF']}?error=1&id={$row['id']}>";
						}
					}
					
					
					?>
                          
				<!--		<tr>
                        
						 	<td>1</td> 
							<td><a href="create_new_client.php">Letmon Agency</a></td> 
							<td>San Andres 1774</td> 
							<td>San Martin</td> 
							<td class="center">Buenos Aires</td> 
							<td class="center">+54 011 45089054</td>
						</tr> 
						<tr class="gradeB">
						  	<td>2</td> 
							<td><a href="create_new_client.php">Letmon Agency</a></td> 
							<td>San Andres 1774</td> 
							<td>San Martin</td> 
							<td class="center">Buenos Aires</td> 
							<td class="center">+54 011 45089054</td>
						</tr> 
						<tr class="gradeC">
						  	<td>3</td> 
							<td><a href="create_new_client.php">Letmon Agency</a></td> 
							<td>San Andres 1774</td> 
							<td>San Martin</td> 
							<td class="center">Buenos Aires</td> 
							<td class="center">+54 011 45089054</td>
						</tr>  -->
				
			</div>
				</div>
			</div>
		</div>
<?php include 'includes/closing_items.php';
					}
}
}else{
header("Location:login.php");
}


?>
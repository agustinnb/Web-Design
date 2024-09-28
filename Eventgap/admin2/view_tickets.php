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
						<h2>Tickets List</h2>
					</div>
                    <div class="box grid_16 round_all">
				<table class="display table"> 
					<thead> 
						<tr>
						  	<th>ID</th> 
                            <th>Questioner</th> 
							<th>Question</th> 
							<th>Answered by</th> 
							<th>State</th> 
							    <th>Delete</th>
						</tr> 
					</thead> 
					<tbody> 
                    <?php 
					include "libraries/mysqlconnect.php";
					$query="SELECT * FROM Tickets ORDER BY id DESC";
					$result=@mysql_query($query);
					while ($row=@mysql_fetch_assoc($result)){
						$query2="SELECT CN FROM users WHERE id=" . $row['idQ'];
						$result2=@mysql_query($query2);
						$row2=@mysql_fetch_assoc($result2);
						
						
					echo "	<tr>
                        
						 	<td>" . $row['id'] . "</td> 
							<td><a href='clients_list.php'>" . $row2['CN'] . "</a></td>
							";
						if ($row['state']=="Not answered"){
								echo "<td><a href='answer_tickets.php?id={$row['id']}'>" . substr($row['TextQ'],0,60) . "..." . "</a></td>";			 } else{
									echo "<td><a href='view_answer.php?id={$row['id']}'>" . substr($row['TextQ'],0,60) . "..." . "</a></td>";	
								} 
							if ($row['idA']==0){
							echo "<td>Anyone</td>";
							}else{
								$query3="SELECT name FROM admins WHERE id=" . $row['idA'];
						$result3=@mysql_query($query3);
						$row3=@mysql_fetch_assoc($result3);
						echo "<td>" . $row3['name'] . "</td>";
							}
					echo "<td>{$row['state']}</td>"; 
					
								echo "<td><a href='delvt.php?id={$row['id']}'>Delete</a></td> 
						</tr> ";
					}
					
					include "libraries/closecon.php";
					
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
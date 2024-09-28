<?php
session_start();
if (isset($_SESSION['username'])){
include 'includes/document_head.php'?>
		<div id="wrapper">
			<?php include 'includes/topbar.php'?>		
			<?php include 'includes/sidebar.php'?>
			<div class="main_container container_16 clearfix">
				<?php include 'includes/navigation.php'?>
                <?php 
						include "libraries/mysqlconnect.php";
						$actu=0;
								$query="SELECT * FROM users";
					$result=mysql_query($query);
								while ($row=@mysql_fetch_assoc($result)){
								
									$dif=explode("-",$row['lastlog']);
									//calculo timestam de las dos fechas
$timestamp1 = mktime(0,0,0,$dif[1],$dif[2],$dif[0]);
$timestamp2 = mktime(4,12,0,date("m"),date("d"),date("Y"));

//resto a una fecha la otra
$segundos_diferencia = $timestamp1 - $timestamp2;
//echo $segundos_diferencia;

//convierto segundos en días
$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

//obtengo el valor absoulto de los días (quito el posible signo negativo)
$dias_diferencia = abs($dias_diferencia);

//quito los decimales a los días de diferencia
$dias_diferencia = floor($dias_diferencia);

if ($dias_diferencia<=30){
$actu++;
}
								
								}
				?>
                	<div class="flat_area grid_16" style="clear:left;">
					<h2>Admin Summary</h2>
				</div>	
				<div class="box grid_8">
					<h2 class="box_head grad_colour">
						Orders
					</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="block">
						<p>Today's Orders <strong>20</strong></p>
                        <p>Today's Pending <strong>12</strong></p>
                        <p>Today's Completed <strong>4</strong></p>
                        <p>Yesterdays Orders <strong>6</strong></p>
                        <p>Yesterdays Completed <strong>2</strong></p>
                        <p>Month to Date Total <strong>0</strong></p>
                        <p>Year to Date Total <strong>50</strong></p>
					</div>
				</div>
                <div class="box grid_8">
					<h2 class="box_head grad_colour">
						Statistics
					</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="block">
						<p>Active Clients <strong><?php echo $actu; ?></strong></p>
                        <p>Today's Pending <strong>12</strong></p>
					</div>
				</div>			
			</div>
            
    <div class="main_container container_16 clearfix">
				<div class="flat_area grid_16" style="clear:left;">
					<h2>Recent Client Activity</h2>
				</div>
                    <div class="box grid_16 round_all">
                            <table class="display table"> 
                                <thead> 
                                    <tr>
                                        <th>Client</th> 
                                        <th>IP Address</th> 
                                        <th>Last Access</th> 
                                    </tr> 
                                </thead> 
                                <tbody> 
                                <?php 
								include "libraries/mysqlconnect.php";
								$query="SELECT * FROM users WHERE ip <> '' ORDER BY lastlog ASC, lltime ASC";
								$result=mysql_query($query);
								while ($row=@mysql_fetch_assoc($result)){
								


									
									
								echo "<tr>
                                <td>{$row['CN']}</td> 
                                <td>{$row['ip']}</td> 
                                <td>{$row['lastlog']} {$row['lltime']}</td>  
                            </tr>"; 
								}
								include "libraries/closecon.php";
								?>
                       
						</tbody> 
					</table>
				</div>
			</div>
        </div>	
<?php include 'includes/closing_items.php';
}else{
header("Location:login.php");
}

?>
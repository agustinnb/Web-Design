<?php session_start(); ?>
<?php if (!(isset($_SESSION['username']))){ ?>
<?php include 'includes/document_head.php'?>

		<div id="login_box" class="round_all clearfix">
        <form method="post" id="login_form">
			<label class="fields"><strong>Username</strong><input type="text" id="username" name="username" class="indent round_all"></label>

			<label class="fields"><strong>Password</strong><input type="password" id="password" name="password" class="indent round_all"></label>
            <?php 
	
			if (isset($_GET['error'])){ 
			
			?>
            <div align="center"><strong>The username or password are incorrect</strong></div>
            <?php } ?>
		<!--	<input class="button_colour round_all" type="submit" value="Login" > -->
           <button type="submit" name="log_but" class="button_colour round_all" ><img width="24" height="24" alt="Locked 2" src="images/icons/small/white/Locked%202.png"><span>Login</span></button>
			<div id="bar" class="round_bottom"> 
				<label><input type="checkbox">Auto-login in future.</label>
                
				<a href="#">Forgot your password?</a>
             
			</div>		
			<a href="#" id="login_logo"><span>Letmon Backend</span></a>
            </form>
		</div>
		<?php include 'includes/template_options.php'?>
		<script type="text/javascript"> 
            var username = new LiveValidation('username');
			username.add( Validate.Presence );
			
            var password = new LiveValidation('password');
			password.add( Validate.Presence );
		</script>  
<?php include 'includes/closing_items.php';

if (isset($_POST['log_but'])){
	include "libraries/mysqlconnect.php";
	$user=strtolower($_POST['username']);
	$query="SELECT * FROM admins WHERE name='$user'";

	$result=mysql_query($query);
	$row=@mysql_fetch_assoc($result);
	if ( ($user==strtolower($row['name'])) && (trim(md5($_POST['password']))==trim($row['pass'])  ) ){
		$ip = $_SERVER['REMOTE_ADDR']; 
		$lastlog = date("Y/m/d");
		$time = date("H:i");
		$query="UPDATE admins SET ip='$ip', lastlog='$lastlog', time='$time' WHERE name='" . $row['name'] . "'";
		
		mysql_query($query);
		include "libraries/closecon.php";
		$_SESSION['username']=$user;
echo "<meta http-equiv=refresh content=0;URL=dashboard.php>";

	}else{
	
	
	echo "<meta http-equiv=refresh content=0;URL=login.php?error=1>";
	}
	
	

}




}else{
//	onClick="location.href='dashboard.php'"
	header("Location:dashboard.php");
}
?>
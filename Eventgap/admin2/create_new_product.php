<?php 
session_start();
if (isset($_SESSION['username'])){
include 'includes/document_head.php'?>

		<div id="wrapper">
			<?php include 'includes/topbar.php'?>		
			<?php include 'includes/sidebar.php'?>
				<div id="main_container" class="main_container container_16 clearfix">
					<?php include 'includes/navigation.php'?>
					    <?php
					if (isset($_GET['id'])){
						include "libraries/mysqlconnect.php";
					$query2="SELECT * FROM products WHERE id=" . $_GET['id'];
					$result2=mysql_query($query2);
					$row2=mysql_fetch_assoc($result2);
					include "libraries/closecon.php";
					}
					?>
					<div class="flat_area grid_16">
						<h2>Create New Product</h2>
						<p>This is where you configure all your products.</p>
					</div>
					<div class="box grid_8 round_all">
						<h2 class="box_head grad_colour">Create New Product</h2>
						<a href="#" class="grabber">&nbsp;</a>
						<a href="#" class="toggle">&nbsp;</a>
						<div class="toggle_container">
							<div class="block">
								<form name="create_products" enctype="multipart/form-data" method="post">	
                                	<label>Item Number</label> 
								  <input name="IN" <?php if (isset($_GET['id'])){ echo "value='" . $row2['itnum'] . "'"; } ?> title="Enter the product name" type="text" class="large"> 
              						<label>Product Name</label> 
								  <input name="PN" <?php if (isset($_GET['id'])){ echo "value='" . $row2['pn'] . "'"; } ?> title="Enter the product name" type="text" class="large"> 
                                    
                                    <label>Please Upload a Picture</label>
									<div class="input_group">
										<input name="pic" type="file">
									</div>
                                    
                               
                                    
                                    <label>Select Category</label>
									<div class="input_group">
										<select id="PC" name="PC">
                                        <?php
										include "libraries/mysqlconnect.php";
										$query="SELECT * FROM categories";
										$result=mysql_query($query) or die ("Error");
										while ($row=@mysql_fetch_assoc($result)){
										?>
                                        	<option value="<?php echo $row['cat']; ?>" <?php if (isset($_GET['id'])){ if($row2['pc']==$row['cat']){ echo "selected='selected'"; } } ?> >
											<?php echo $row['cat']; ?>
											</option>
                                        <?php
										}
										include "libraries/closecon.php";
										?>
								
										</select>
									</div>
							
        <label>Product Description</label> 
									<textarea id="tiny_input" name="PD"><?php if (isset($_GET['id'])){ echo $row2['pd']; } ?></textarea>
                                       
                                  <label>Qty on Hand</label> 
									<input name="QH" <?php if (isset($_GET['id'])){ echo "value='" . $row2['quh'] . "'"; } ?> title="Enter the product name" type="text" class="medium">
                                  <label>Qty on order</label> 
									<input name="QO" <?php if (isset($_GET['id'])){ echo "value='" . $row2['quo'] . "'"; } ?> title="Enter the product name" type="text" class="medium">
                                    
                                  <label>List Pricing</label> 
									<input name="LP" <?php if (isset($_GET['id'])){ echo "value='" . $row2['lp'] . "'"; } ?> title="Enter the product name" type="text" class="medium">
							
									<button name="add_prod_but" type="submit" class="button_colour round_all"><img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/Bended%20Arrow%20Right.png"><span>Submit</span></button>
								</form>
                                <script type="text/javascript">
			new TINY.editor.edit('editor',{
				id:'tiny_input',
				height:200,
				cssclass:'te',
				controlclass:'tecontrol',
				rowclass:'teheader',
				dividerclass:'tedivider',
				controls:['bold','italic','underline','strikethrough','|',
						  'orderedlist','unorderedlist','|','leftalign',
						  'centeralign','rightalign','blockjustify','|','unformat','|','undo','redo','n','image','hr','link','unlink','|','cut','copy','paste','print','|','font','size','style'],
				footer:false,
				fonts:['Arial','Verdana','Georgia','Trebuchet MS'],
				xhtml:true,
				cssfile:'style.css',
				bodyid:'editor',
				footerclass:'tefooter',
				toggle:{text:'source',activetext:'wysiwyg',cssclass:'toggler'},
				resize:{cssclass:'resize'}
			});
			</script>
							</div>
                                    <?php if (isset($_GET['success'])){ ?>
                            <div align="center" class="large">Product was succesfully inserted</div>
						<?php } ?>
						</div>
					</div>
                    <div class="box grid_16 round_all">
					<h2 class="box_head grad_colour round_top">Tiny Editor</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="block no_padding">
						<textarea id="tiny_input"></textarea>					
					</div>
				</div>
				</div>
			</div>
		</div>
        
<?php
if (isset($_POST['add_prod_but'])){

$IN=$_POST['IN'];
$PN=$_POST['PN'];
$PC=$_POST['PC'];
$PD=$_POST['PD'];
$QH=$_POST['QH'];
$QO=$_POST['QO'];
$LP=$_POST['LP'];

if ($_FILES['pic']['tmp_name']!=""){
	
	
$binario_nombre_temporal=$_FILES['pic']['tmp_name'] ;

// leer del archvio temporal .. el binario subido.
// "rb" para Windows .. Linux parece q con "r" sobra ...
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

// Obtener del array FILES (superglobal) los datos del binario .. nombre, tabamo y tipo.
$binario_nombre=$_FILES['pic']['name'];
$binario_peso=$_FILES['pic']['size'];
$binario_tipo=$_FILES['pic']['type'];
}

 include "libraries/mysqlconnect.php";


if (!(isset($_GET['id']))){



if ($_FILES['pic']['tmp_name']!=""){
$query="INSERT INTO products (itnum, pn,archivo_binario,archivo_nombre,archivo_tipo,archivo_peso,pc, pd, quh, quo, lp) VALUES ('$IN','$PN','$binario_contenido','$binario_nombre','$binario_tipo','$binario_peso','$PC','$PD',$QH,$QO,'$LP')";
}else{
$query="INSERT INTO products (itnum, pn, pc, pd, quh, quo, lp) VALUES ('$IN', '$PN', '$PC', '$PD', $QH, $QO, '$LP')";

}
}else{
if ($_FILES['pic']['tmp_name']!=""){
$query="UPDATE products SET itnum='$IN', pn='$PN', archivo_binario='$binario_contenido', archivo_nombre='$binario_nombre', archivo_tipo='$binario_tipo', archivo_peso='$binario_peso', pc='$PC', pd='$PD', quh='$QH', quo='$QO', lp='$LP' WHERE id=" . $_GET['id'];
}else{
	$query="UPDATE products SET itnum='$IN', pn='$PN', pc='$PC', pd='$PD', quh='$QH', quo='$QO', lp='$LP' WHERE id=" . $_GET['id'];


}



}
mysql_query($query) or die ("Error inserting in the DB $query");


include "libraries/closecon.php";
 	echo "<meta http-equiv=refresh content=0;URL=create_new_product.php?success=1>";
}



include 'includes/closing_items.php';

}else{
header("Location:login.php");
}
?>
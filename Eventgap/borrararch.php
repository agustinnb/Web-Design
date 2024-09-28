<?php @unlink($_GET['tabla']); 
 echo "<script type='text/javascript'>parent.location.href='mostrar.php?id=".$_GET['id']."&mos=".$_GET['mos']."';</script>";
?>
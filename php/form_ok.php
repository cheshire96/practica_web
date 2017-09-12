<?php
$_POST['titulo']='OK';
include "header.php";
if(isset($_SESSION['userid'])):

?>

<h2><span class="glyphicon glyphicon-saved" aria-hidden="true">  Los datos se guardaron exitosamente</h2>

<a href="../php/mostrar.php" class="btn btn-link btn-md"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver</a>
			
	<?php
else:
	$_POST['cont']=0;
	header('location: ../class/c_ingresar.php');
	die(); 
endif;

		include "footer.php";
		?>

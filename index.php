<?php require("class/clientes.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Practica WebII</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.css" rel="stylesheet">

    
  </head>
  <body>
	  <?php include 'php/nav_bar.php';
if(!isset($_SESSION['userid'])):	  
?>
    <div class="container">
	    <div class="panel panel-default">
	      <div class="panel-body">

			<form role="form" method="post" action="class/c_index.php">
				<div>
					<h1>Inicio</h1>
					<button type="submit" name="login" value=0 class="btn btn-success"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Ingresar</button>
				</div>
			</form>
		 
    </div> 
    </div>	
	    
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
	  $('#ghatable').dataTable();
	});
    </script>
  </body>
</html> 

<?php 
else:
	$_POST['cont']=0;
	header('location: php/mostrar.php');
	die();
endif;	  
?>

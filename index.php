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
    <div class="container">
	    <div class="panel panel-default">
	      <div class="panel-body">

			<form role="form" method="post" action="class/c_index.php">
				<div>
					<h1>Clientes </h1>
					<button type="submit" name="nuevo" value="nuevo" class="btn btn-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Nuevo</button>
				</div>
			</form>
			
			
			
			
	<table id="ghatable" class="display table table-bordered table-stripe" cellspacing="0" width="100%">
     <thead>
          <tr>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Nacionalidad</th>
                <th>Activo</th>
                <th>Acciones</th>
          </tr>
     </thead>
     <tbody>
          <?php
          $objCliente = new Cliente();
          $clientes = $objCliente->clientes();
          if(sizeof($clientes) > 0){
               foreach ($clientes as $cliente){
                    ?>
                    <tr>
                         <td><?php echo $cliente['apellido'] ?></td>
                         <td><?php echo $cliente['nombre'] ?></td>
                         <td><?php echo $objCliente->calcularEdad($cliente['fecha_nac']) ?></td>
                         <td><?php echo $cliente['nacionalidad'] ?></td>
                         <td><?php echo $cliente['activo'] ?></td>
                         <td>
							<form role="form" method="post" action="class/c_index.php">
				
								<button type="submit" name="modificar" value=<?php echo $cliente['id']; ?> class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Modificar</button>
								<button type="submit" onclick="return confirm('Desea eliminar al cliente <?php echo $cliente['apellido']." ".$cliente['nombre']?>')" name="eliminar" value=<?php echo $cliente['id']; ?> class="btn btn-danger"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Eliminar</button>
							</form>
						</td>
                    </tr>
                    <?php
               }
          }
          ?>
     </tbody>
</table>
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

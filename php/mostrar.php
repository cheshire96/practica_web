<?php 
$_POST['titulo']='Clientes';
require("../class/clientes.php");
include '../php/header.php';
if(isset($_SESSION['userid'])):
?>
<div class="panel-body">
			
<form role="form" method="post" action="../class/c_mostrar.php">
				<div align="left"><h1>Clientes </h1>
				<div align="right">
					<button type="submit" name="nuevo" value="nuevo" class="btn btn-info"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo</button>
				</div>
				</div>
				
			</form>
				</div>
			
	    <div class="panel panel-default">
	      <div class="panel-body">
			
			
			
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
							<form role="form" method="post" action="../class/c_mostrar.php">
				
								<button type="submit" name="modificar" value=<?php echo $cliente['id']; ?> class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar</button>
								<button type="submit" onclick="return confirm('Desea eliminar al cliente <?php echo $cliente['apellido']." ".$cliente['nombre']?>')" name="eliminar" value=<?php echo $cliente['id']; ?> class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</button>
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
	    	<?php
else:
	
	$_POST['cont']=0;
	header('location: ../class/c_ingresar.php');
	die(); 
endif;
		include "footer.php";
	?>

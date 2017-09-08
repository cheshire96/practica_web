<?php 

include "header.php"; 
	
?>
<div class="panel panel-default">
	<div class="panel-body">
			<form role="form" method="post" action="../class/prueba.php">

				<div class="form-group">
					<label for="apellido">Apellido</label>
					<input type="text" class="form-control" name="apellido" id="apellido" required>
				</div>

                <div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" name="nombre" id="nombre"required>
				</div>
				

                <div class="form-group">
					<label for="fecha_nac">Fecha Nacimiento</label>
					
					<input type="date" class="form-control" name="fecha_nac" id="fecha_nac" required>
				</div>
                <div class="form-group">
					<label for="nacionalidad">Nacionalidad</label>
					<select class="form-control" name="nacionalidad" id="nacionalidad">
						<?php
						foreach ($_GET['nacionalidades'] as $k =>$nacionalidad):
						?>
							<option value="<?php echo $k; ?>"><?php echo $nacionalidad; ?></option>
						<?php
						endforeach;
						?>
					</select>
				</div>
            
				<div class="form-group">
					<label for="activo">Activo</label>
					<input type="checkbox" name="activo" value=1> 
				</div>
			
			<a href="../index.php" class="btn btn-link btn-md"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver</a>
	
			<button type="submit" name="enviar" class="btn btn-info">Enviar</button>

			
		</form>

<?php include "footer.php"; ?>

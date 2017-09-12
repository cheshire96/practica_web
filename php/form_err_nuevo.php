<?php
//FORMULARIO CON LOS ERRORES
$_POST['titulo']='Nuevo Cliente';
include "header.php";

if(isset($_SESSION['userid'])):

?>

<div class="panel panel-default">
	<div class="panel-body">
		<form role="form" method="post" action="../class/nuevo.php">
			
			<fieldset> <legend>Nuevo Cliente</legend>
				<?php 
				$tiene_error = $this->tieneError('apellido') ? "has-error" : "form-group";
				?>
				<div class="<?php echo $tiene_error;?>">
					<label for="apellido">Apellido</label>
					<input type="text" class="form-control" name="apellido" id="apellido" value=<?php echo $this->valores['apellido']; ?> required>
					
				</div>

				<?php echo '<strong class="text-danger">'.$this->getError('apellido').'</strong>'; 
				$tiene_error = $this->tieneError('nombre') ? "has-error" : "form-group";
				?>
				<div class="<?php echo $tiene_error;?>">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" name="nombre" id="nombre" value=<?php echo $this->valores['nombre']; ?> required>
				</div>
				
				<?php 
				echo '<strong class="text-danger">'.$this->getError('nombre').'</strong>';
				$tiene_error = $this->tieneError('fecha de nacimiento') ? "has-error" : "form-group";
				?>
				<div class="<?php echo $tiene_error;?>">
					<label for="fecha_nac">Fecha Nacimiento</label>
					<input type="date" class="form-control" name="fecha_nac" id="fecha_nac" value=<?php echo $this->valores['fecha_nac']; ?> required>
				</div>
									
				<?php 
				echo '<strong class="text-danger">'.$this->getError('fecha de nacimiento').'</strong>';
				$tiene_error = $this->tieneError('nacionalidad') ? "has-error" : "form-group";
				?>
				<div class="<?php echo $tiene_error;?>">
					<label for="nacionalidad">Nacionalidad</label>
					<select class="form-control" name="nacionalidad" id="nacionalidad">
					<?php foreach($_POST['nacionalidades'] as $k =>$nacionalidad):?>
						<option value="<?php echo $k;?>" <?php echo $this->getSelected($this->valores['nacionalidad'], $k);?>><?php echo $nacionalidad;?></option> 
					<?php endforeach;?>
					</select>
				</div>
					
				<?php echo '<strong class="text-danger">'.$this->getError('nacionalidad').'</strong>';
				$tiene_error = $this->tieneError('activo') ? "has-error" : "form-group";
				?>
				<div class="<?php echo $tiene_error;?>">
					<label for="activo">Activo</label>
					<input type="checkbox" <?php echo $this->getChecked('activo');?> name="activo" value=1>
				</div>
				<?php echo '<strong class="text-danger">'.$this->getError('activo').'</strong>';?>

				<a href="../php/mostrar.php" class="btn btn-link btn-md"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver</a>
					
				<button type="submit" name="cont" value=1 class="btn btn-info">Enviar</button>
			</fieldset>
		</form>
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

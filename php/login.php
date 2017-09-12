<?php
$_POST['titulo']='Ingresar';
include "header.php";
?>
<h1>Ingresar</h1>
<div>
	<form action="../class/c_ingresar.php" method="POST" class="login">
		<div class="control-group">
			<?php 
			$tiene_error = $this->tieneError('usuario') ? "has-error" : "form-group";
			$error = $this->tieneError('usuario') ? "has-error" : "form-group";
			echo '<strong class="text-danger">'.$this->getError('us_pass').'</strong>';
			?>
            <div class="<?php echo $tiene_error;?>">
				<label for="usuario">Usuario</label>
				<?php if(isset($this->valores['usuario'])):?>
				<input type="text" name="usuario" value="<?php echo $this->valores['usuario']; ?>"/>
				<?php else:?>
				<input type="text" name="usuario"/>
				<?php endif;?>
            </div>
				<?php echo '<strong class="text-danger">'.$this->getError('usuario').'</strong>';
			
			$tiene_error = $this->tieneError('contrasenia') ? "has-error" : "form-group";
			?>
            <div class="<?php echo $tiene_error;?>">
				<label for="pass">Contrase&ntilde;a</label>
				<input type="password" name="contrasenia"/>
            </div>
            <?php echo '<strong class="text-danger">'.$this->getError('contrasenia').'</strong>';?>
            <div>
				<button type="submit" name="login" value=1 class="btn btn-success"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Ingresar</button>
			</div>
		</div>
	</form>
</div>

	<?php
		include "footer.php";
	?>

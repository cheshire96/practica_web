<?php

session_start();
if(isset($_SESSION['userid'])):

?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="../php/mostrar.php">Clientes</a>
    </div>
    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav  navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['usuario']?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><form class="navbar-form navbar-center" role="form" method="post" action="../class/c_ingresar.php">
				<div>
					<button type="submit" name="logout" value="logout" class="btn btn-link"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Logout</button>
				</div>
			</form></li>
           
          </ul>
        </li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php else: ?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    
    <div class="navbar-header">
      <a class="navbar-brand" href="../index.php">Inicio</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav  navbar-right">
        
            <li><form class="navbar-form navbar-center" role="form" method="post" action="../class/c_ingresar.php">
				<div>
					<button type="submit" name="login" value=0 class="btn btn-success"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>  Ingresar  </button>
				</div>
			</form></li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php endif;?>

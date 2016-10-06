<?php
	session_start();
?>

<div class="container">
	<nav class="nav-main mega-menu">
		<ul class="nav nav-pills nav-main" id="mainMenu">
			<?php if ( !empty($_SESSION['correo']) && $_SESSION['correo_validado'] == 0 ) : ?>
			<li>
				<a href="usuario" class="acorreo">Aún no validas tu correo</a>
			</li>
			<?php endif; ?>
			<li>
				<a href="inicio">Inicio</a>
			</li>
			<li>
				<a href="que_gano_yo">¿Qué gano yo?</a>
			</li>
			<li>
				<a href="planes">Planes</a>
			</li>
			<?php if ( empty($_SESSION['correo']) ) : ?>
                <li>
                    <a href="ingreso"><i class="fa fa-user"></i> Ingresar</a>
                </li>
			<?php else : ?>
				<?php if($_SESSION['correo_validado'] == 1 || $_SESSION['mailchimp_suscrito'] == 1) : ?>
					<li>
						<a href="recomendaciones">Recomendaciones</a>
					</li>
				<?php endif; ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['username']; ?> <i class="fa fa-angle-down"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="usuario"><i class="fa fa-user fa-fw"></i> Mis datos</a></li>
						<li><a href="cuenta"><i class="fa fa-suitcase fa-fw"></i> Mi cuenta</a></li>
						<li><a href="#" onclick="document.forms['logoutForm'].submit(); return false;"><i class="fa fa-power-off fa-fw"></i> Salir</a></li>
						<form id="logoutForm" action="login-processor.php" method="post">
							<input type="hidden" value="logout" name="action" />
						</form>
					</ul>
				</li>
			<?php endif; ?>
		</ul>
	</nav>
</div>

<?php // if (isset($_SESSION['username'])) : ?>
<?php // else : ?>
<?php // endif; ?>

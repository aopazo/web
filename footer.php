<?php

	session_start();

?>

<script src="https://platform.twitter.com/widgets.js"></script>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12">
			<ul class="list icons list-unstyled">
				<li><i class="fa fa-home fa-fw"></i> <a href="inicio">Inicio</a></li>
				<li><i class="fa fa-shopping-cart fa-fw"></i> <a href="planes">Planes</a></li>
				<li><i class="fa fa-user fa-fw"></i> <a href="ingreso">Ingreso</a></li>
			<?php if ( empty($_SESSION['correo']) ) : ;?>
				<li><i class="fa fa-trophy fa-fw"></i> <a href="que_gano_yo">¿Qué gano yo?</a></li>
			<?php else : ?>
				<li><i class="fa fa-pencil fa-fw"></i> <a href="registro">Registro</a></li>
				<li><i class="fa fa-user fa-fw"></i> <a href="usuario">Mis datos</a></li>
				<li><i class="fa fa-suitcase fa-fw"></i> <a href="cuenta">Mi cuenta</a></li>
			<?php endif; ?>
			</ul>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<ul class="list icons list-unstyled">
			<?php if ( empty($_SESSION['correo']) ) : ;?>
			<?php else : ?>
				<li><i class="fa fa-trophy fa-fw"></i> <a href="que_gano_yo">¿Qué gano yo?</a></li>
				<?php if($_SESSION['correo_validado'] == 1 || $_SESSION['mailchimp_suscrito'] == 1) : ?>
					<li><i class="fa fa-lightbulb-o fa-fw"></i> <a href="recomendaciones">Recomendaciones</a></li>
				<?php endif; ?>
			<?php endif; ?>
				<li><i class="fa fa-shield fa-fw"></i> <a href="politica_de_privacidad">Política de privacidad</a></li>
				<li><i class="fa fa-file-text-o fa-fw"></i> <a href="terminos_y_condiciones">Términos y condiciones</a></li>
				<li><i class="fa fa-comments-o fa-fw"></i> <a href="preguntas_frecuentes">Preguntas frecuentes</a></li>
				<li><i class="fa fa-envelope fa-fw"></i> <a href="contactanos">Contacto</a></li>
			</ul>
		</div>
		<div class="col-md-4 col-sm-12 col-xs-12">
			<h4 class="short">Síguenos</h4>
			<div class="social-icons push-top">
				<ul class="social-icons">
					<li class="facebook"><a href="http://www.facebook.com/AtempusCL" target="_blank" data-placement="bottom" data-tooltip title="Facebook">Facebook</a></li>
					<li class="twitter"><a href="https://twitter.com/intent/follow?screen_name=AtempusCL"target="_blank" data-placement="bottom" data-tooltip title="Twitter">Twitter</a></li>
					<li class="linkedin"><a href="https://www.linkedin.com/company/Atempus" target="_blank" data-placement="bottom" data-tooltip title="Linkedin">Linkedin</a></li>
				</ul>								
			</div>
		</div>
	</div>
</div>
<div class="footer-copyright">
	<div class="container">
		<div class="row">
			<div class="col-md-1">
				<a href="inicio" class="logo">
					<img width="67" height="32" alt="Logo Atempus" class="img-responsive" src="custom/img_custom/logo-footer-atempus.png">
				</a>
			</div>
			<div class="col-md-4">
				<p>© Atempus 2012-<?php echo date('Y'); ?>. Todos los derechas reservados.</p>
			</div>
		</div>
	</div>
</div>

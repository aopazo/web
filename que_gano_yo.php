<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>Simulacion - AFP | Atempus</title>		
		<meta name="keywords" content="Atempus Pensiones Fondos Ahorro AFP" />
		<meta name="description" content="Atempus - pensión bajo control">
		<meta name="author" content="www.atempus.cl">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/bootstrap.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css">
		<link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.min.css" media="screen">
		<link rel="stylesheet" href="vendor/owlcarousel/owl.theme.default.min.css" media="screen">
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" media="screen">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="custom/css/theme.css">
		<link rel="stylesheet" href="custom/css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">
		<link rel="stylesheet" href="css/theme-animate.css">

		<!-- Favicon -->
		<link rel="icon" href="custom/img_custom/logo-ae-3.png">
		
		<!-- Current Page CSS -->
		<link rel="stylesheet" href="vendor/rs-plugin/css/settings.css" media="screen">
		<link rel="stylesheet" href="vendor/circle-flip-slideshow/css/component.css" media="screen">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="custom/css/skins/default.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="custom/css/custom.css">

		<!-- Esta pagina -->
		<link rel="stylesheet" href="custom/css/queganoyo.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.js"></script>

		<!--[if IE]>
			<link rel="stylesheet" href="css/ie.css">
		<![endif]-->

		<!--[if lte IE 8]>
			<script src="vendor/respond/respond.js"></script>
			<script src="vendor/excanvas/excanvas.js"></script>
		<![endif]-->

	</head>
	<body>

		<div class="body" id="contenido" style="visibility: hidden">
			<header id="header">
				<div id="header-logo" class="container">
					<div class="logo">
						<a href="inicio">
							<img alt="Atempus" width="180" height="90" data-sticky-width="90" data-sticky-height="45" src="custom/img_custom/logo-ae-1.png">
						</a>
					</div>
					<ul class="social-icons">
						<li class="facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook">Facebook</a></li>
						<li class="twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter">Twitter</a></li>
						<li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin">Linkedin</a></li>
					</ul>
					<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<div class="navbar-collapse nav-main-collapse collapse" id="header-navegacion"></div>
			</header>

			<div role="main" class="main">
			
				<section class="page-top">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="inicio">Inicio</a></li>
									<li class="active">¿Qué gano yo?</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1><span id="nombreseccion">¿Qué gano yo?</span></h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
										
							<h3>Simulación</h3>

							<div class="row">
								<div class="col-md-12">
									<p class="lead">
										Imaginemos que tienes $<input type="number" min="0" value="8000000" step="100000" style="width:125px" data-max="999999999" data-min="1" class="form-control form-control-inlinetext mb-md" name="ahorro" id="ahorro" required="" aria-required="true" aria-invalid="false">
										ahorrados en el fondo
										<select class="form-control form-control-inlinetext mb-md" id="fondo">
											<option>A</option><option>B</option><option>C</option><option>D</option><option>E</option>
										</select>
										de
										<select class="form-control form-control-inlinetext mb-md" id="afp">
											<option>AFP Capital</option><option>AFP Cuprum</option><option>AFP Habitat</option><option>AFP Modelo</option><option>AFP Planvital</option><option>AFP Provida</option>
										</select>
										y cotizas mensualmente $<input type="number" min="0" value="50000" step="5000" style="width:90px" data-max="999999" data-min="0" class="form-control form-control-inlinetext mb-md" name="cotizacion" id="cotizacion" required="" aria-required="true" aria-invalid="false">.
									</p>
									<div class="row">
										<div class="col-md-6">
										<!--
											<p class="lead">
												<span id="texto-inicial">Si</span> hubieses contado con un Plan Premium hace 
												<select class="form-control form-control-inlinetext mb-md" id="historia">
													<option>2</option><option>3</option><option>4</option>
												</select> años, tendrías ahorrado al rededor de <span id="proyeccion-n"></span>.
											</p>
											-->
											<p class="lead">
												Hace <span id="historia">4</span> años tenías ahorrado en torno a <span id="ahorro-inicial"></span>.
												Con nuestro Plan Premium tendrías ahorrado al rededor de <span id="proyeccion-n"></span> en vez de <span id="ahorro-final-afp">$8.000.000</span>.
											</p>
										</div>
										<div class="col-md-6">
											<div class="text-center">
												<span id="leyenda-afp-n">AFP Capital</span>: 
												<span id="leyenda-n"></span>
											</div>
											
											<div id="chartjs-tooltip-n"></div>

											<div align="center">
												<div class="canvas-holder" style="max-width: 500px; height: 100%; width: 100%;">
													<canvas id="simulacion-n"></canvas>
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-6">
											<p class="lead">
												Ahora supongamos que tienes <select class="form-control form-control-inlinetext mb-md" id="edad">
													<option>15</option><option>16</option><option>17</option><option>18</option><option>19</option>
													<option>20</option><option>21</option><option>22</option><option>23</option><option>24</option>
													<option>25</option><option>26</option><option>27</option><option>28</option><option>29</option>
													<option>30</option><option>31</option><option>32</option><option>33</option><option>34</option>
													<option>35</option><option>36</option><option>37</option><option>38</option><option>39</option>
													<option selected>40</option><option>41</option><option>42</option><option>43</option><option>44</option>
													<option>45</option><option>46</option><option>47</option><option>48</option><option>49</option>
													<option>50</option><option>51</option><option>52</option><option>53</option><option>54</option>
													<option>55</option><option>56</option><option>57</option><option>58</option><option>59</option>
													<option>60</option><option>61</option><option>62</option><option>63</option><option>64</option>
												</select>
												años y que te vas a jubilar a los <select class="form-control form-control-inlinetext mb-md" id="edad-jubilacion">
													<option>55</option><option>56</option><option>57</option><option>58</option><option>59</option>
													<option selected>60</option><option>61</option><option>62</option><option>63</option><option>64</option>
													<option>65</option>
												</select>. Contratando ahora un Plan Premium tu jubilación se podrían ver incrementada en un <span id="proyeccion-jubilacion"></span>. 
												Esto se podría dar si sigues cotizando <span id="cotizacion-actual">$50.000</span> mensuales y estas rentabilidades se repitiesen en el futuro.
											</p>
										</div>
										<div class="col-md-6">
											<div class="text-center">
												<span class="chartjs-tooltip-key" style="background-color:rgba(48,157,161,1)"></span><span> Con Atempus </span><span class="chartjs-tooltip-key" style="background-color:rgba(223,14,40,1)"></span><span> Sin Atempus</span>
											</div>
											
											<div id="chartjs-tooltip-extrapolacion"></div>
											
											<div align="center">
												<div class="canvas-holder" style="max-width: 500px; height: 100%; width: 100%;">
													<canvas id="extrapolacion-n"></canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>	
						<div class="col-md-10 col-md-offset-1">
										
							<h3>Modelo</h3>

							<div class="row">
								<div class="col-md-12">
									<p class="lead">
										Hemos desarrollado un indicador financiero que detecta cambios de tendencia de los mercados bursátiles.
										Mediante herramientas matemáticas, estadísticas y financieras se mide la fuerza con la cual el mercado cambia de dirección.
										Si esta señal es suficientemente fuerte, se genera una alerta o recomendación de cambio al fondo.
									</p>
								</div>
							</div>
						</div>
							
					</div>
				</div>
				
			</div>

			<footer class="short" id="footer"></footer>
		</div>

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.js"></script>
		<script src="vendor/jquery.appear/jquery.appear.js"></script>
		<script src="vendor/jquery.easing/jquery.easing.js"></script>
		<script src="vendor/jquery-cookie/jquery-cookie.js"></script>
		<script src="vendor/bootstrap/bootstrap.js"></script>
		<script src="vendor/common/common.js"></script>
		<script src="custom/vendor/jquery.validation/jquery.validation.js"></script>
		<script src="vendor/jquery.stellar/jquery.stellar.js"></script>
		<script src="vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="vendor/jquery.gmap/jquery.gmap.js"></script>
		<script src="vendor/isotope/jquery.isotope.js"></script>
		<script src="vendor/owlcarousel/owl.carousel.js"></script>
		<script src="vendor/jflickrfeed/jflickrfeed.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="vendor/vide/vide.js"></script>
		<script src="custom/vendor/chartjs/Chart.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="custom/js/theme.js"></script>
		
		<!-- Specific Page Vendor and Views -->
		<script src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
		<script src="vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
		<script src="js/views/view.home.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>
				
		<!-- Theme Custom -->
		<script src="custom/js/custom.js"></script>
		
		<!-- Esta pagina -->
		<script src="custom/js/queganoyo.js"></script>
		
	</body>
</html>

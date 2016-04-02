<?php 
	// Inialize session
	session_start();
	require_once("connection.php");
	require_once("functions.php");

    $correo = $_SESSION['correo'];
	$result = mysql_query("SELECT * FROM $table WHERE correo = '".$correo."'");
	// if sale mal la consulta :(
	$userdata = mysql_fetch_array($result);
    if ($userdata['tipo_plan']=="Expirado"){ $plan="Expirado"; $puede_renovar="FALSE"; }
    if ($userdata['tipo_plan']=="Gratis"){ $plan="Gratis"; $puede_renovar="FALSE"; }
    if ($userdata['tipo_plan']=="12000"){ $plan="Premium Anual"; $puede_renovar="TRUE"; }
    if ($userdata['tipo_plan']=="20400"){ $plan="Premium BiAnual"; $puede_renovar="TRUE"; }

    $planes_anteriores = explode("//", $userdata['planes_anteriores']);
    $sizeof_planes_anteriores = sizeof($planes_anteriores) - 1;
echo $planes_anteriores[0].$sizeof_planes_anteriores;
////        <td data-title="Plan">Anual Premium</td>
//        <td data-title="Suscripción">05/08/2014</td>
//        <td data-title="Inicio">05/08/2014</td>
//        <td data-title="Vencimiento">05/08/2015</td>
//        <td data-title="Estado">Vigente</td>
//        <td data-title="Contrato"><a href="http://www.atempus.cl/contratos/Contrato1Y12000HCo.pdf" target="_blank" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-file-pdf-o" style="color:red"></i></a></td>

    // implementar despliegue de errores
	$errorMessage = "";
	if(isset($_REQUEST['errorMessage'])) {
            $displayErrors = "block";
            $errorMessage = safe($_REQUEST['errorMessage']);
            echo "<br />TEST: ".$errorMessage;
        }
	else $displayErrors = "none";

    
?>

<!DOCTYPE html>
<html>
    <head>

            <!-- Basic -->
            <meta charset="utf-8">
            <title>Cuenta - AFP | Atempus</title>		
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

            <!-- Skin CSS -->
            <link rel="stylesheet" href="custom/css/skins/default.css">

            <!-- Theme Custom CSS -->
            <link rel="stylesheet" href="custom/css/custom.css">

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
                                    <li class="active">Mi Cuenta</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h1><span id="nombreseccion">Mi Cuenta</span></h1>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="container">

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">	

                            <div class="box-content">
                                <h4 class="mb-none">Datos de tu cuenta</h4>
                                <p><b>Plan actual: &nbsp;</b><?php echo $plan."&nbsp;&nbsp;"; ?>
                                    <?php if ($puede_renovar == "TRUE") : ?> <!-- debe ir directo a pagar el mismo plan que ya tiene -->
                                        <a href="planes" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-repeat"></i> renueva tu plan</a>
                                    <?php endif; ?>
                                    <?php if ($plan == "12000") : ?>
                                        <a href="planes" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-rocket"></i> mejora tu plan</a>
                                    <?php endif; ?>
                                    <?php if ($plan == "Gratis") : ?>
                                        <a href="planes" type="button" class="btn btn-borders btn-default btn-xs"><i class="fa fa-rocket"></i> contrata tu plan</a></p>
                                    <?php endif; ?>
                                <br /><br />

                                <h4 class="mb-none">Información histórica</h4>

                                <div id="no-more-tables">
                                    <table class="col-md-12 table table-striped table-center table-condensed cf">
                                        <thead>
                                            <tr>
                                                <th>Plan</th>
                                                <th>Suscripción</th>
                                                <th>Inicio de vigencia</th>
                                                <th>Vencimiento</th>
                                                <th>Estado</th>
                                                <th>Contrato</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php for ($i = 0; $i < $sizeof_planes_anteriores; $i++){
        $row = explode("/", $planes_anteriores[$i]);
        $tplan = $row[0];
        $tsuscripcion = $row[1];
        $tinicio = $row[2];
        $tvencimiento = $row[3];
        $testado = $row[4];
        $tcontrato = $row[5];
        echo "<tr>";
            echo "<td data-title=\"Plan\">$tplan</td>";
            echo "<td data-title=\"Suscripción\">$tsuscripcion</td>";
            echo "<td data-title=\"Inicio\">$tinicio</td>";
            echo "<td data-title=\"Vencimiento\">$tvencimiento</td>";
            echo "<td data-title=\"Estado\">$testado</td>";
            echo "<td data-title=\"Contrato\"><a href=\"http://www.atempus.cl/contratos/$tcontrato\" target=\"_blank\" type=\"button\" class=\"btn btn-borders btn-default btn-xs\"><i class=\"fa fa-file-pdf-o\" style=\"color:red\"></i></a></td>";
        echo "</tr>";

    }
?>
                                        </tbody>
                                    </table>
                                </div>								
                            </div>
                        </div>
                    </div>
              </div>
            </div>

            <!-- agregando manejo de errores -->
            <div class="modal fade" id="ModalGenerico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalTitle"></h4>
                        </div>
                        <div id="myModalBody" class="modal-body"></div>
                        <div class="modal-footer">
                            <a href="#" id="myModalFooter" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-up"></i> Entendido</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fin manejo de errores -->

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

        <!-- Theme Base, Components and Settings -->
        <script src="custom/js/theme.js"></script>

        <!-- Specific Page Vendor and Views -->
        <script src="js/views/view.contact.js"></script>

        <!-- Theme Initialization Files -->
        <script src="js/theme.init.js"></script>

        <!-- Theme Custom -->
        <script src="custom/js/custom.js"></script>


    </body>
</html>
<?php
 // Mas manejo de errores
	if(isset($_REQUEST['errorMessage'])) {
            if ($_REQUEST['errorMessage'] != "") {
		echo "<script languaje=’javascript’>"
                    . "$('#myModalTitle').html('Notificación');"
                    . "$('#myModalBody').html('".$_REQUEST['errorMessage']."');"
                    . "$(document).ready(MostrarModal('#ModalGenerico'));"
                    . "</script>";
            }
	}

?>
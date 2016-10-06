<?php

if (isset($_REQUEST["dias"])) {
	$dias = $_REQUEST["dias"];
}
else {
	$dias = 0;
	error_log(print_r("content-alerta-msd:: Alerta accedida sin dias a vencimiento", TRUE), 0); 	// dejamos un mensaje en log de errores
}

if (isset($_REQUEST["plan"])) {
	$plan = $_REQUEST["plan"];
	
	if ($plan != "Expirado" && $plan != "Gratis" && $plan != "12000" && $plan != "20400") {
		$plan = "Gratis";
		error_log(print_r("content-alerta-msd:: Alerta accedida con plan erroneo", TRUE), 0); 	// dejamos un mensaje en log de errores
	}
}
else {
	$plan = "Expirado";
	error_log(print_r("content-alerta-msd:: Alerta accedida sin plan", TRUE), 0); 	// dejamos un mensaje en log de errores
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <!-- Facebook sharing information tags -->
        <meta property="og:title" content="*|MC:SUBJECT|*">
        
        <title>*|MC:SUBJECT|*</title>
		
	<style type="text/css">
		#outlook a{
			padding:0;
		}
		body{
			width:100% !important;
		}
		.ReadMsgBody{
			width:100%;
		}
		.ExternalClass{
			width:100%;
		}
		body{
			-webkit-text-size-adjust:none;
		}
		body{
			margin:0;
			padding:0;
		}
		img{
			border:0;
			height:auto;
			line-height:100%;
			outline:none;
			text-decoration:none;
		}
		table td{
			border-collapse:collapse;
		}
		#backgroundTable{
			height:100% !important;
			margin:0;
			padding:0;
			width:100% !important;
		}
	/*
	@tab Page
	@section background color
	@tip Set the background color for your email. You may want to choose one that matches your company's branding.
	@theme page
	*/
		body,#backgroundTable{
			/*@editable*/background-color:#FAFAFA;
		}
	/*
	@tab Page
	@section email border
	@tip Set the border for your email.
	*/
		#templateContainer{
			/*@editable*/border:1px solid #DDDDDD;
		}
	/*
	@tab Page
	@section heading 1
	@tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
	@style heading 1
	*/
		h1,.h1{
			/*@editable*/color:#202020;
			display:block;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:34px;
			/*@editable*/font-weight:bold;
			/*@editable*/line-height:100%;
			margin-top:0;
			margin-right:0;
			margin-bottom:10px;
			margin-left:0;
			/*@editable*/text-align:left;
		}
	/*
	@tab Page
	@section heading 2
	@tip Set the styling for all second-level headings in your emails.
	@style heading 2
	*/
		h2,.h2{
			/*@editable*/color:#202020;
			display:block;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:30px;
			/*@editable*/font-weight:bold;
			/*@editable*/line-height:100%;
			margin-top:0;
			margin-right:0;
			margin-bottom:10px;
			margin-left:0;
			/*@editable*/text-align:left;
		}
	/*
	@tab Page
	@section heading 3
	@tip Set the styling for all third-level headings in your emails.
	@style heading 3
	*/
		h3,.h3{
			/*@editable*/color:#202020;
			display:block;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:26px;
			/*@editable*/font-weight:bold;
			/*@editable*/line-height:100%;
			margin-top:0;
			margin-right:0;
			margin-bottom:10px;
			margin-left:0;
			/*@editable*/text-align:left;
		}
	/*
	@tab Page
	@section heading 4
	@tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
	@style heading 4
	*/
		h4,.h4{
			/*@editable*/color:#202020;
			display:block;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:22px;
			/*@editable*/font-weight:bold;
			/*@editable*/line-height:100%;
			margin-top:0;
			margin-right:0;
			margin-bottom:10px;
			margin-left:0;
			/*@editable*/text-align:left;
		}
	/*
	@tab Header
	@section preheader style
	@tip Set the background color for your email's preheader area.
	@theme page
	*/
		#templatePreheader{
			/*@editable*/background-color:#FAFAFA;
		}
	/*
	@tab Header
	@section preheader text
	@tip Set the styling for your email's preheader text. Choose a size and color that is easy to read.
	*/
		.preheaderContent div{
			/*@editable*/color:#505050;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:10px;
			/*@editable*/line-height:100%;
			/*@editable*/text-align:left;
		}
	/*
	@tab Header
	@section preheader link
	@tip Set the styling for your email's preheader links. Choose a color that helps them stand out from your text.
	*/
		.preheaderContent div a:link,.preheaderContent div a:visited,.preheaderContent div a .yshortcuts{
			/*@editable*/color:#336699;
			/*@editable*/font-weight:normal;
			/*@editable*/text-decoration:underline;
		}
	/*
	@tab Header
	@section header style
	@tip Set the background color and border for your email's header area.
	@theme header
	*/
		#templateHeader{
			/*@editable*/background-color:#FFFFFF;
			/*@editable*/border-bottom:0;
		}
	/*
	@tab Header
	@section header text
	@tip Set the styling for your email's header text. Choose a size and color that is easy to read.
	*/
		.headerContent{
			/*@editable*/color:#202020;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:34px;
			/*@editable*/font-weight:bold;
			/*@editable*/line-height:100%;
			/*@editable*/padding:0;
			/*@editable*/text-align:center;
			/*@editable*/vertical-align:middle;
		}
	/*
	@tab Header
	@section header link
	@tip Set the styling for your email's header links. Choose a color that helps them stand out from your text.
	*/
		.headerContent a:link,.headerContent a:visited,.headerContent a .yshortcuts{
			/*@editable*/color:#336699;
			/*@editable*/font-weight:normal;
			/*@editable*/text-decoration:underline;
		}
		#headerImage{
			height:auto;
			max-width:600px;
		}
	/*
	@tab Body
	@section body style
	@tip Set the background color for your email's body area.
	*/
		#templateContainer,.bodyContent{
			/*@editable*/background-color:#FFFFFF;
		}
	/*
	@tab Body
	@section body text
	@tip Set the styling for your email's main content text. Choose a size and color that is easy to read.
	@theme main
	*/
		.bodyContent div{
			/*@editable*/color:#505050;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:14px;
			/*@editable*/line-height:150%;
			/*@editable*/text-align:left;
		}
	/*
	@tab Body
	@section body link
	@tip Set the styling for your email's main content links. Choose a color that helps them stand out from your text.
	*/
		.bodyContent div a:link,.bodyContent div a:visited,.bodyContent div a .yshortcuts{
			/*@editable*/color:#336699;
			/*@editable*/font-weight:normal;
			/*@editable*/text-decoration:underline;
		}
		.bodyContent img{
			display:inline;
			height:auto;
		}
	/*
	@tab Columns
	@section left column text
	@tip Set the styling for your email's left column text. Choose a size and color that is easy to read.
	*/
		.leftColumnContent{
			/*@editable*/background-color:#FFFFFF;
		}
	/*
	@tab Columns
	@section left column text
	@tip Set the styling for your email's left column text. Choose a size and color that is easy to read.
	*/
		.leftColumnContent div{
			/*@editable*/color:#505050;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:14px;
			/*@editable*/line-height:150%;
			/*@editable*/text-align:left;
		}
	/*
	@tab Columns
	@section left column link
	@tip Set the styling for your email's left column links. Choose a color that helps them stand out from your text.
	*/
		.leftColumnContent div a:link,.leftColumnContent div a:visited,.leftColumnContent div a .yshortcuts{
			/*@editable*/color:#336699;
			/*@editable*/font-weight:normal;
			/*@editable*/text-decoration:underline;
		}
		.leftColumnContent img{
			display:inline;
			height:auto;
		}
	/*
	@tab Columns
	@section right column text
	@tip Set the styling for your email's right column text. Choose a size and color that is easy to read.
	*/
		.rightColumnContent{
			/*@editable*/background-color:#FFFFFF;
		}
	/*
	@tab Columns
	@section right column text
	@tip Set the styling for your email's right column text. Choose a size and color that is easy to read.
	*/
		.rightColumnContent div{
			/*@editable*/color:#505050;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:14px;
			/*@editable*/line-height:150%;
			/*@editable*/text-align:left;
		}
	/*
	@tab Columns
	@section right column link
	@tip Set the styling for your email's right column links. Choose a color that helps them stand out from your text.
	*/
		.rightColumnContent div a:link,.rightColumnContent div a:visited,.rightColumnContent div a .yshortcuts{
			/*@editable*/color:#336699;
			/*@editable*/font-weight:normal;
			/*@editable*/text-decoration:underline;
		}
		.rightColumnContent img{
			display:inline;
			height:auto;
		}
	/*
	@tab Footer
	@section footer style
	@tip Set the background color and top border for your email's footer area.
	@theme footer
	*/
		#templateFooter{
			/*@editable*/background-color:#FFFFFF;
			/*@editable*/border-top:0;
		}
	/*
	@tab Footer
	@section footer text
	@tip Set the styling for your email's footer text. Choose a size and color that is easy to read.
	@theme footer
	*/
		.footerContent div{
			/*@editable*/color:#707070;
			/*@editable*/font-family:Arial;
			/*@editable*/font-size:12px;
			/*@editable*/line-height:125%;
			/*@editable*/text-align:left;
		}
	/*
	@tab Footer
	@section footer link
	@tip Set the styling for your email's footer links. Choose a color that helps them stand out from your text.
	*/
		.footerContent div a:link,.footerContent div a:visited,.footerContent div a .yshortcuts{
			/*@editable*/color:#336699;
			/*@editable*/font-weight:normal;
			/*@editable*/text-decoration:underline;
		}
		.footerContent img{
			display:inline;
		}
	/*
	@tab Footer
	@section social bar style
	@tip Set the background color and border for your email's footer social bar.
	@theme footer
	*/
		#social{
			/*@editable*/background-color:#FAFAFA;
			/*@editable*/border:0;
		}
	/*
	@tab Footer
	@section social bar style
	@tip Set the background color and border for your email's footer social bar.
	*/
		#social div{
			/*@editable*/text-align:center;
		}
	/*
	@tab Footer
	@section utility bar style
	@tip Set the background color and border for your email's footer utility bar.
	@theme footer
	*/
		#utility{
			/*@editable*/background-color:#FFFFFF;
			/*@editable*/border:0;
		}
	/*
	@tab Footer
	@section utility bar style
	@tip Set the background color and border for your email's footer utility bar.
	*/
		#utility div{
			/*@editable*/text-align:center;
		}
		#monkeyRewards img{
			max-width:190px;
		}
</style></head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	<center>
        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
            	<tr>
                	<td align="center" valign="top">
                        <!-- // Begin Template Preheader \\ -->
                        <table border="0" cellpadding="10" cellspacing="0" width="600" id="templatePreheader">
                            <tr>
                                <td valign="top" class="preheaderContent">
                                
                                	<!-- // Begin Module: Standard Preheader \ -->
                                    
                                	<!-- // End Module: Standard Preheader \ -->
                                
                                </td>
                            </tr>
                        </table>
                        <!-- // End Template Preheader \\ -->
                    	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- // Begin Template Header \\ -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader">
                                        <tr>
                                            <td class="headerContent">
                                            
                                            	<!-- // Begin Module: Standard Header Image \\ -->
												<a href="http://www.atempus.cl" target="_blank">
                                            	<img src="https://gallery.mailchimp.com/eaa74877a94dc487be01bef89/images/f92da840-97a6-441a-83db-3ab2167144a7.png" alt="" border="0" style="margin: 0; padding: 0;" mc:edit="header_image">
                                            	</a>
												<!-- // End Module: Standard Header Image \\ -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Header \\ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- // Begin Template Body \\ -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
                                    	<tr>
                                        	<td colspan="3" valign="top" class="bodyContent">
                                            
                                                <!-- // Begin Module: Standard Content \\ -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top">
                                                            <div mc:edit="std_content00">
																<div style="text-align: justify;">
																	<span style="font-size:17px">
																		<span style="line-height:21px">
																			<?php 
																				if ($dias == 0) {
																					echo "Tu suscripci&oacute;n ha terminado.";
																				} else {
																					echo "Tu suscripci&oacute;n expirar&aacute; en " . $dias . " d&iacute;as.";
																				}			?>
																																		
																			<?php 
																			if ($plan == "Gratis" || $plan == "Expirado") {
																					echo "Suscr&iacute;bete ";
																				} elseif ($plan == "12000" || $plan == "20400") {
																					echo "Renu&eacute;vala ";
																				}			?>
																			ahora contratando un <a href="http://www.atempus.cl/planes" target="_self">Plan Premium</a></span><span style="line-height:21px">. 
																			Gracias por el apoyo y esperamos tenerte de vuelta muy pronto.
															
																		</span>
																	</span>
																</div>
</div>
														</td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Content \\ -->
                                                <!-- // Begin Module: Arrow \\ -->
                                          <div align="center">
                                             <table align="center" border="0" cellpadding="10" cellspacing="0" width="100%">
           
		<tr>
			<td align="center" width="100%">
                  <table>
                     <tr>
            			<td align="center">
            				<div mc:edit="flech"><strong><span style="font-size:80px">
                            <a href="http://www.atempus.cl/planes" target="_blank">
                            <img align="none" height="281" src="https://gallery.mailchimp.com/eaa74877a94dc487be01bef89/images/39003fae-3c93-4a75-aa18-701aba397ca2.png" style="width: 450px; height: 281px; margin: 0px;" width="450">
                            </a>
                            </span></strong></div>
                    	</td>
                    </tr>
                 </table>
            </td>
		</tr>
                                                    </table>
                         
                                               </div>
                                               <!-- // End Module: Arrow \\ -->
                                            </td>
                                        </tr>
                                    	
                                    </table>
                                    <!-- // End Template Body \\ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- // Begin Template Footer \\ -->
                                	<table border="0" cellpadding="10" cellspacing="0" width="600" id="templateFooter">
                                    	<tr>
                                        	<td valign="top" class="footerContent">
                                            
                                                <!-- // Begin Module: Standard Footer \\ -->
                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td colspan="2" valign="middle" id="social">
                                                            <div mc:edit="std_social"><div align="center">
<table align="center" style="font-size: 12px;">
	<tbody>
		<tr>
			<td align="center" width="160"><a href="http://twitter.com/intent/tweet?url=http://www.atempus.cl&amp;text=Recomendaci&oacute;n de fondos!! Suscr&iacute;banse!!&amp;via=AtempusCL&amp;related=yarrcat" target="_blank"><img align="none" alt="Twitter" height="22" src="https://gallery.mailchimp.com/56e3feb41300931f15a7b2c98/images/twitter0622a0.jpg" style="height: 22px; line-height: 12px; width: 58px;" width="58"></a></td>
			<td align="center" width="160"><a href="http://us7.campaign-archive.com/social-proxy/facebook-like?u=56e3feb41300931f15a7b2c98&amp;id=87e94a567f&amp;url=http%3A%2F%2Fwww.atempus.cl&amp;title=http%3A%2F%2Fwww.atempus.cl&amp;e=[UNIQID]" target="_blank"><img align="none" alt="Me gusta" height="22" src="https://gallery.mailchimp.com/56e3feb41300931f15a7b2c98/images/me_gusta.gif" style="height: 22px; line-height: 12px; width: 74px;" width="74"></a></td>
			<td align="center" width="160"><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://www.atempus.cl&amp;title=Recomendaci%C3%B3n%20de%20fondos!!&amp;summary=Suscr%C3%ADbanse!!&amp;source=Atempus" target="_blank"><img align="none" alt="LinkedIn" height="22" src="https://gallery.mailchimp.com/56e3feb41300931f15a7b2c98/images/descarga.jpg" style="width: 69px; height: 22px;" width="69"></a></td>
		</tr>
	</tbody>
</table>
</div>
</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top" width="100%">
                                                            <div mc:edit="std_footer"><em>&copy; <?php echo date("Y"); ?> Atempus, Todos los derechos reservados</em><em>.</em><br>
&nbsp;
<div>
<table align="center">
	<tbody>
		<tr>
			<td align="center" width="70"><a href="http://twitter.com/AtempusCL" style="text-align: center; background-color: rgb(250, 250, 250);" target="_blank"><img align="none" height="31" src="https://gallery.mailchimp.com/56e3feb41300931f15a7b2c98/images/images_6_.jpg" style="height: 31px; line-height: 12px; width: 31px;" width="31"></a></td>
			<td align="center" width="70"><a href="http://facebook.com/AtempusCL" style="text-align: center; background-color: rgb(250, 250, 250);" target="_blank"><img align="none" height="31" src="https://gallery.mailchimp.com/56e3feb41300931f15a7b2c98/images/icon_facebook.jpg" style="height: 31px; line-height: 12px; width: 31px;" width="31"></a></td>
			<td align="center" width="70"><a href="mailto:contacto@atempus.cl" target="_self"><img align="none" height="31" src="https://gallery.mailchimp.com/56e3feb41300931f15a7b2c98/images/icon_email.1.png" style="height: 31px; line-height: 12px; text-align: center; background-color: rgb(250, 250, 250); width: 31px;" width="31"></a></td>
			<td align="center" width="70"><a href="http://www.atempus.cl" target="_blank"><img align="none" height="31" src="https://gallery.mailchimp.com/56e3feb41300931f15a7b2c98/images/web_icon.jpg" style="height: 31px; line-height: 12px; text-align: center; background-color: rgb(250, 250, 250); width: 31px;" width="31"></a></td>
			<td align="center" width="70"><a href="http://www.atempus.cl/planes" target="_blank"><img align="none" height="31" src="https://gallery.mailchimp.com/56e3feb41300931f15a7b2c98/images/rss.png" style="height: 31px; line-height: 12px; text-align: center; background-color: rgb(250, 250, 250); width: 31px;" width="31"></a></td>
		</tr>
		<tr>
			<td align="center" valign="top" width="70"><a href="http://twitter.com/AtempusCL" target="_blank">s&iacute;guenos</a></td>
			<td align="center" valign="top" width="70"><a href="http://facebook.com/AtempusCL" target="_blank">s&iacute;guenos</a></td>
			<td align="center" valign="top" width="70"><a href="mailto:contacto@atempus.cl" target="_blank">cont&aacute;ctanos</a></td>
			<td align="center" valign="top" width="70"><a href="http://www.atempus.cl" target="_blank">vis&iacute;tanos</a></td>
			<td align="center" valign="top" width="70"><a href="http://www.atempus.cl/planes" target="_blank">suscr&iacute;bete</a></td>
		</tr>
	</tbody>
</table>
</div>
</div>
                                                        </td>
                                                        <td valign="top" width="190" id="monkeyRewards">
                                                            <div mc:edit="monkeyrewards"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" valign="middle" id="utility">
                                                            <div mc:edit="std_utility"><div style="text-align: justify;">
	<span style="text-align: justify;">Recuerda que este correo es una recomendaci&oacute;n y que las consecuencias de los cambios de fondos que realices son de tu exclusiva responsabilidad.</span></div>
<br>
<a href="http://www.atempus.cl/politica_de_privacidad" target="_blank">Pol&iacute;tica de privacidad</a>&nbsp;|&nbsp;<a href="http://atempus.us7.list-manage.com/unsubscribe?u=eaa74877a94dc487be01bef89&id=1a9463286c&e=48c3204874&c=097869b4c1" target="_blank">Eliminar suscripci&oacute;n</a></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Footer \\ -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Footer \\ -->
                                </td>
                            </tr>
                        </table>
                        <br>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>

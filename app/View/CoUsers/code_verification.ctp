						 <?
						    $foto_perfil=$this->webroot.'img/invitacion.jpg';
						 ?>
                        
                        

    <div class="lock-wrapper">
        <div class="lock-box text-center">
            <div class="lock-name">Código de Invitación</div>
				
			<img class="topnav_img" width="110px" height="110px" src="<? echo  $foto_perfil; ?>" />
                
            <div class="lock-pwd">
                <form role="form" class="form-inline" action="code_verification" method="post">
                    <div class="form-group">
                        <input type="hidden" name="data[CoUser][evento]" class="form-control lock-input" value="<? echo $evento['Evento']['id'];?>">
						<input type="text" name="data[CoUser][code]" class="form-control lock-input ispassword" placeholder="Clave.." id="CoUserPassword" value="">
                        <button class="btn btn-lock" type="submit">
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </form>

            </div>
        </div>
        
       <div id="nota">
	   <div role="alert" class="alert alert-warning">
	   Este evento requiere de un Código de Invitación para registrase, y no esta abierto al público en general. Su código de invitación se debe encontrar en la parte posterior de la tarjeta que le hicimos llegar, o bien en su correo electrónico personal.
    </div>

	   
	   </div>
    </div>

   

		
    
    <script>
	document.getElementById("CoUserPassword").focus();
	
		$(document).ready(function()
	{

    // Call Prevue.js para mostrar y ocultar el password
	$('.preview-password').prevue();
		
	background1="<? echo $this->webroot."img/backgrounds/color-splash.jpg"; ?>";

	// Duration is the amount of time in between slides,
	// and fade is value that determines how quickly the next image will fade in
	$.backstretch([background1], {duration: 3000, fade: 750});
	
		
	});		


    </script>

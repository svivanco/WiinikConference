   						 <?
						 //Checar imagen de perfil exista, extrañamente usando $this->webroot no funciona..
						 $foto_perfil='../webroot/usuarios/'.$userData['id'].'/'.$userData['id'].'_foto.jpg';
						 
						  if(file_exists($foto_perfil))
						  {
  						    $foto_perfil=$this->webroot.'usuarios/'.$userData['id'].'/'.$userData['id'].'_foto.jpg';
						  }
						  else
						    $foto_perfil=$this->webroot.'img/foto_perfil.jpg';
						 ?>
                        
                        

    <div class="lock-wrapper">
        <div class="lock-box text-center">
            <div class="lock-name"><?php echo $userData['name']; ?></div>
				
			<img class="topnav_img" width="110px" height="110px" src="<? echo  $foto_perfil; ?>" />
                
            <div class="lock-pwd">
                <form role="form" class="form-inline" action="lock" method="post">
                    <div class="form-group">
                        <input type="hidden" name="data[CoUser][login]" class="form-control lock-input" value="<?php echo $userData['username']; ?>">                        <input type="password" name="data[CoUser][password]" class="form-control lock-input ispassword" placeholder="Contraseña" id="CoUserPassword" value="">
                        <button class="btn btn-lock" type="submit">
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
                <a href="javascript:loginRedir();" id="otherUser" on>Iniciar con otro usuario?</a>
            </div>
        </div>
        
       <div id="time"></div>
    </div>
    
    <script>
        function startTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('time').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){startTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
		
		document.getElementById("CoUserPassword").focus();

	$(document).ready(function()
	{

    // Call Prevue.js para mostrar y ocultar el password
	$('.preview-password').prevue();
		
	background1="<? echo $this->webroot."img/backgrounds/bg1.jpg"; ?>";
	background2="<? echo $this->webroot."img/backgrounds/bg2.jpg"; ?>";
	background3="<? echo $this->webroot."img/backgrounds/bg3.jpg"; ?>";		

	// Duration is the amount of time in between slides,
	// and fade is value that determines how quickly the next image will fade in
	$.backstretch([background1
	, background2
	, background3
	], {duration: 3000, fade: 750});
	
		
	});		

    </script>

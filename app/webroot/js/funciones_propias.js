function createPass()
{
	//Mayor seguridad un password aleatorio
	//var randomstring = Math.random().toString(36).slice(-8);
	document.getElementById('CoUserPassword').value=document.getElementById('CoUserMaterno').value;
}


function createLogin()
{
	part1=document.getElementById('CoUserNombre').value;
	part1=part1.charAt(0);		
	part2=document.getElementById('CoUserPaterno').value;	
	
	// Return today's date and time
	var currentTime = new Date()
	
	// returns the month (from 0 to 11)
	//var month = currentTime.getMonth() + 1
	
	// returns the day of the month (from 1 to 31)
	var day = currentTime.getDate()

	document.getElementById('CoUserLogin').value=part1+part2+day;	
}

function createCURP()
{
	//part1=document.getElementById('UserDataCoUserId').value;
	//alert(part1);
	
	/*
	part1=part1.charAt(0);		
	part2=document.getElementById('CoUserPaterno').value;	
	
	// Return today's date and time
	var currentTime = new Date()
	
	// returns the month (from 0 to 11)
	//var month = currentTime.getMonth() + 1
	
	// returns the day of the month (from 1 to 31)
	var day = currentTime.getDate()

	document.getElementById('CoUserLogin').value=part1+part2+day;	
	*/
}


/**
 * Create cookie with javascript
 *
 * @param {string} name cookie name
 * @param {string} value cookie value
 * @param {int} days2expire
 * @param {string} path
 */
function create_cookie(name, value, days2expire, path) 
{
  var date = new Date();
  date.setTime(date.getTime() + (days2expire * 24 * 60 * 60 * 1000));
  var expires = date.toUTCString();
  document.cookie = name + '=' + value + ';' +
                   'expires=' + expires + ';' +
                   'path=' + path + ';';
}

function delete_cookie(name) 
{
  var date = new Date();
  date.setTime(date.getTime());
  var expires = date.toUTCString();
  document.cookie = name + '=;' +
                   'expires=' + expires + ';' +
                   'path=/;';
}

<!-- Borramos la Cookie del usuario desde de la Vista Lock, para permitir mostrar la vista de login-->
function loginRedir()
{

		  delete_cookie('empleado');
		  window.location = "../CoUsers/login";

}




//NProgress Youtube style
/*

 $(document).ready(
				function() {
								NProgress.start();				
						   }
				  );


 $(document).load(
				function() {
					NProgress.done();
						   }
				  );
*/





    <!-- Convierte todos los atributos title en tooltips -->	
       $(document).ready(function() 
        {
        $(document).tooltip();
       
	
		 $('.form-group :checkbox').bootstrapToggle({
			  on: 'Si',
			  off: 'No'
			});		

/*	    $('.form-group :checkbox').iphoneStyle
          (
                {
                  checkedLabel: 'Si',
                  uncheckedLabel: 'No'
                }
          );			
*/		  
		  
       });	




    <!-- Cancelamos para todos los anchor el efecto de ir o subir hacia un determinado punto.. -->
	var anchor = document.querySelectorAll('button');
    [].forEach.call(anchor, function(anchor)
	{
      var open = false;
      anchor.onclick = function(event)
	  {
        event.preventDefault();
        if(!open){
          this.classList.add('close');
          open = true;
        }
        else
		{
          this.classList.remove('close');
          open = false;
        }
      }
    }); 



  <!-- Menu Sidebar Bootstrap -->
        $(function () 
		{
            $('#side-menu').metisMenu({
              toggle: false
            });
        });


  <!-- Crea el Scroll Fino y Elegante -->
	 
	   $(document).ready(
					function() 
					{
							//$('#overlay').hide();		
							//Se mejoró al ponerlo vía CSS
							
							$('#search').click(function(event) 
							{
										$('#overlay').addClass('masked');	
										$('#overlay').fadeIn();			
							});
							
							
							$('#overlay').click(function(event) 
							{
										$('#overlay').removeClass('masked');
										$('#overlay').hide();									   
							});
	
							//$("html").niceScroll();
							//Sidebar style scroll
							//$("#sidebar-wrapper").niceScroll('#side-menu');	
							
							
							
						<!-- Autohide Sidebar Toggle-->
						   $("#menu-toggle").click(function(e) 
						   {
							  //e.preventDefault();
							  $("#wrapper").toggleClass("toggled");
							  create_cookie('sidebar', 'toggle', 1, '/');		
							  
							  var toggle = !($("#wrapper").hasClass('toggled'));
							  
						   });
							
					}
		);
						
    
	
	
//Marca el tiempo restante de sesión..
function countdown() 
{
	//Minutos y segundos para expirar
	minutos=480;
	segundos=0;
	
	//Tiempo limite para expirar, expresado en segundos
	maximo=(60*minutos)+segundos;
	//Contador de tiempo
    time = 0;	
	//Minutos antes de alertar del fin de sesión
	minalert= 5;
	//Segundo exacto en el que mostrará alerta
	alerta=maximo-(60*minalert);
	
	
    int = setInterval(function() 
	{
		time++;
		
		//Tiempo restante
		restante=maximo-time;	
		//Convertimos segundos a minutos y segundos
		restante=segtomin(restante);
				
		//Incrementamos la barra de progreso
        $('.session_progress').css("width",Math.floor((100 * time) / maximo) + '%');
		
		
        if (time - 1 == maximo) 
		{
			//Paramos la función limpiando el intervalo
            clearInterval(int);
			//alert("Su sesión ha expirado")
			//Redirigimos a la pantalla de Lock, myBaseUrl es creado en layouts->default como una variable Javascript
			window.location = myBaseUrl+'/co_users/logout';       
		 }
		else
		{
	        if (time - 1 == alerta) 
			{
				//alert('En menos de '+ minalert +' minutos expirará tu sesión.')
			    $('#mensajeSesion').html('En menos de '+ minalert +' minutos expirará tu sesión.');
				$('#Sesion').modal({
									  keyboard: true
									})
				
			}
				
			//Actualizamos el contador 
		   $('#tip').html(restante);
				
		}
		
	   
    }, 1000);
}

  $(document).ready(function() 
  {
	countdown();
  });	


function segtomin(time)
{
	var minutes = Math.floor( time / 60 );
	var seconds = time % 60;
 
	//Anteponiendo un 0 a los minutos si son menos de 10
	minutes = minutes < 10 ? '0' + minutes : minutes;
	 
	//Anteponiendo un 0 a los segundos si son menos de 10
	seconds = seconds < 10 ? '0' + seconds : seconds;
	 
	var result = minutes + 'm' + ":" + seconds + 's' ;  // 161:30
	
	return result;
	
}


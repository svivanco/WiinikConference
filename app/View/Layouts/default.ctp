<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
 <title>
	<?php echo $title_for_layout; ?>
	</title>
 		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <?php
        echo $this->Html->meta('icon');
		//Bootstrap 3.2
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('bootstrap-theme');
  		//Estilos para el Iphone Control Yes/No
        echo $this->Html->css('bootstrap-toggle.min');		
		//CK Editor Styles
		echo $this->Html->css('contents');
		//Estilos propios en general		
	    echo $this->Html->css('estilos');	
		//Estilos para componentes avanzados Jquery
	    echo $this->Html->css('cupertino/jquery-ui-1.10.4.custom');		
		//TimeLine Estilos
		echo $this->Html->css('timeline');
   		//<!-- Custom CSS Sidebar-->
		echo $this->Html->css('simple-sidebar');
		//Collapsable Menu Sidebar
		echo $this->Html->css('metisMenu.min');		
		//Iconos por Font Awesome
        echo $this->Html->css('font-awesome.min');
		//Iconos Premium Glyphicon
	    echo $this->Html->css('glyphicon_fullsets');	
		//Youtube style top line progress load
        echo $this->Html->css('nprogress');
		//echo $this->Html->css('jquery.mCustomScrollbar');		

		
		//***** SECCIÓN DE CSS COMPRIMIDOS EN PRODUCCIÓN*****/
		//HABILITAR CUANDO YA SE ENCUENTRE ESTABLE EL SISTEMA Y EN PRODUCCIÓN
		//echo $this->AssetCompress->css('all'); 
        
        echo $this->fetch('meta');
        echo $this->fetch('css');
		
		
		//***** SECCIÓN DE CSS Y JAVASCRIPT COMPRIMIDOS EN PRODUCCIÓN*****/
	

		//***** SECCIÓN JAVASCRIPT EN PRODUCCIÓN*****/
   	    //Libreria principal, JQuery V11
	    echo $this->Html->script('jquery.min');
	
		//Linea de Tiempo		
		echo $this->Html->script('storyjs-embed'); 

		//JS para el editor web CK Editor
		echo $this->Html->script('ckeditor/ckeditor');

		//Libreria JS para el uso de accordion, tabs y otros componentes de bootstrap
        echo $this->Html->script('bootstrap');
	
		//Libreria para la interfaz de Jquery, autocomplete, DatePicker,Tabs, etc...
        echo $this->Html->script('jquery-ui-1.10.4.custom.min');
				
		//Librería que convierte los checkbox a tipo slide->iphone
        echo $this->Html->script('bootstrap-toggle.min');
		//JS de Funciones generales
		echo $this->Html->script('funciones_propias');
	
		//Bootstrap Collapsable menu
		echo $this->Html->script('jquery.metisMenu.min'); 

		// echo $this->AssetCompress->script('all'); 	
		
		//Youtube style top line progress load
        //echo $this->Html->script('nprogress');
		
		//Password togle visivility
        echo $this->Html->script('jquery.prevue.min');
		
		//www.higcharts.com Graficas, sólo en las vistas usadas se agrega para aligerar el peso de carga de la app, dashboard.cpt
		//echo $this->Html->script('highcharts'); 

		//Beautiful Scroll
		echo $this->Html->script('jquery.nicescroll.min');		
		
		echo $this->fetch('script');			
        ?>
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

 <script type="text/javascript">
	var myBaseUrl = '<?php echo $this->webroot; ?>';
 </script>

 <!-- 
<link type="text/css" href="/sic/cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8">
<script type="text/javascript" src="/sic/cometchat/cometchatjs.php" charset="utf-8"></script> 
 -->
    </head>
    <body class="bodysystem">
        <header role="banner" class="navbar navbar-inverse navbar-fixed-top">
            <div class="logo">

                <?php
                echo $this->Html->image('LogoSistema.png');
                ?>
                </div>	   

<?php
   //Sección del sidebar, se elimina la sección usando javascript, ya que había un lag
   if(isset($_COOKIE['sidebar']))
   {
        $sidebar=filter_var($_COOKIE['sidebar'], FILTER_VALIDATE_BOOLEAN);
  	 
		  if($sidebar)
		  {
			  	echo '<div id="wrapper" class="">';
		  }
		  else
		  {
			  	echo '<div id="wrapper" class="toggled">';
		  }
		}
		else
		{
		//Si es la primera vez y no existe la cookie, mostramos el panel
		echo '<div id="wrapper" class="">';
		}
 ?>

            
                <nav role="navigation" class="collapse navbar-collapse">
                    <?php
                    echo $menuApp;
                    ?>
                    <ul class="nav navbar-nav navbar-right">
					<li class="dropdown"> <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<?php echo $this->Session->read('Auth.User.nombre'); ?>
						<b class="caret"></b> </a>
                            <ul class="dropdown-menu">
                            
                                <?php
                                if(Configure::read('authType') != 'ldap')
                                {
                                    ?>
                                    <li>
                                        <?php
                                        echo $this->Html->link(
                                                                '<i class="glyphicons glyphicons-user"></i>Ver Perfil',
                                                                array(
                                                                        'controller'=>'co_users',
                                                                        'action'=>'view',$this->Session->read('Auth.User.id')
                                                                    ),
                                                                array(
                                                                        'escape'=>false
                                                                    ));
                                        ?>
                                    </li>
                                    <li>
                                        <?php
                                        echo $this->Html->link(
                                                                '<i class="glyphicons glyphicons-keys"></i>Cambiar Contraseña',
                                                                array(
                                                                        'controller'=>'co_users',
                                                                        'action'=>'cambio_contrasena',$this->Session->read('Auth.User.id')
                                                                    ),
                                                                array(
                                                                        'escape'=>false
                                                           ));
                                        ?>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                    	<a href="JavaScript:openTicket();">
                                        <i class="glyphicons glyphicons-bug"></i>
		                                    Reportar Bug
                                    	</a>
                                   </li>
                                   
                                    <li>
                                    	<a href="#">
                                        <i class="glyphicons glyphicons-cogwheel"></i>
		                                    Configuración
                                    	</a>
                                   </li>
                                   
                                    <?php
                                }
                                ?>
                                <li>
                                    <?php
                                    echo $this->Html->link('<i class="glyphicons glyphicons-lock"></i> Cerrar Sesión', 
                                                            array(
                                                                    'controller'=>'co_users',
                                                                    'action'=>'logout'
                                                                ),array( 'escape'=>false)
                                                        );
                                    ?>
                                </li>
                            </ul>
                        </li>
                    <!-- Sessión bar-->
                    <div class="session_expire">
						<div class="session-tip"  id="tip" style="opacity: 1; visibility: visible; left: -61px;">
						</div>
						<div class="session_progress">
						</div>
                    </div>
                    <!-- Fin Session bar-->

                    </ul>
                </nav>
        </header>
        <div class="content">
            
            <div class="row">
                <div class="col-md-12 well">
                    <?php echo $this->Session->flash(); ?>
                    <div class="row">
                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <?php echo $this->element('sql_dump'); ?>
                </div>

      <!-- sql_dump end -->

            
            </div>
    <!--Contenido Fin (page-content-wrapper) -->
  </div>
 <!-- Fin Wrapper Contenedor Principal (Header, Sidebar, Contenido)-->

<script type="text/javascript">

    <!-- Llama a una ventana Modal para Tickets Rápidos -->
        function openTicket()
        {
			//Creamos cookie global con URl desde donse se llamo el iframe
			create_cookie("linkticket", window.location.href, 1, "/") ;
			
            $(".contentTicket").append('<iframe width="100%" height="550px" frameborder="0" src="<? echo $this->base.'/Tickets/add/';?>"> </iframe>');
            $('#Tickets').modal('show');	
        }
    
    

	   
	  function cookie_sidebar()
	  {
		 //Lee la Cookie, si es true significa que estaba visible
		 <?
		 if (isset($_COOKIE['sidebar']))
		 {
		 ?>		 
			 var cookie_sidebar = <? echo $_COOKIE['sidebar']; ?>;		 
		 <?			 
		 }
		 else
		 {
		 ?>
			 var cookie_sidebar = true;
		 <?
		 }
		 ?>

		 /*
		 //Ocultaba o mostraba el sidebar, vía javascript
		  if(cookie_sidebar)
		  {
		        $("#wrapper").addClass("");
				//alert("muestra");
		  }
		  else
		  {
		  		$("#wrapper").addClass("toggled");
				//alert("oculta");
		  }
		*/

	  }
    
    
	
	//Recuerda si se oculto o mostro el sidebar, para mantener la configuración
	cookie_sidebar();	

</script>
<script type="text/javascript">
function ajax_search()
{
	<?	
 		 $ajax_search= $this->Ajax->remoteFunction( 
					array( 
						'url' => array('controller' => 'CoUsers', 'action' => 'ajax_usuarios'), 
						'update' => 'resultados_ajax',                        
						'data'=>'({findtext: document.getElementById(\'search\').value})',
						'type'=>'GET',
						'indicator'=>'progress_prog',
						) 
				);
	?>

	if(jQuery("#search").val().length >= 1)
		{
		<?	
		  echo $ajax_search;
		?>
		}

}
</script> 

<!--Scripts para el Nicescroll--> 
<script type="text/javascript">
	jQuery("#sidebar-wrapper").mouseover(function() {
		$("#sidebar-wrapper").getNiceScroll().resize();
  });	


	 jQuery(document).ready(function() 
	 {  
		jQuery("#sidebar-wrapper").niceScroll({
			cursorcolor:"#3695D5",
			horizrailenabled: false,
			cursorborder: "none",
			cursorborderradius: "0",
			});
	 });
</script>

    </body>
</html>
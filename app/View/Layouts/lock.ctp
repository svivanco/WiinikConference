<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
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
		//Estilos para los iconos premium glyphicon
	    echo $this->Html->css('glyphicon_fullsets');	
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

		//echo $this->AssetCompress->script('all'); 

		//Youtube style top line progress load
        //echo $this->Html->script('nprogress');
		//Password togle visivility
        echo $this->Html->script('jquery.prevue.min');
		
		//Background changer plugin
        echo $this->Html->script('jquery.backstretch.min');
		
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
    </head>
		<body class="lock-screen" onload="startTime()">
        <div class="contenido">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $this->Session->flash(); ?>
                    <div class="row">
                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
        </div>
 

 
    </body>
</html>
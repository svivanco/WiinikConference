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
        echo $this->Html->css('style');		
		//CK Editor Styles
		echo $this->Html->css('contents');
		//Estilos propios para el estado de cuenta y en general		
	    echo $this->Html->css('estilos');	
		//Estilos para los iconos premium glyphicon
	    echo $this->Html->css('glyphicon_fullsets');	
		//Estilos para componentes avanzados Jquery
	    echo $this->Html->css('cupertino/jquery-ui-1.10.4.custom');		
		//Iconos por Font Awesome
        echo $this->Html->css('font-awesome.min');
		//Iconos Premium Glyphicon
	    echo $this->Html->css('glyphicon_fullsets');	
		//Youtube style top line progress load

		
		//Libreria principal, JQuery V11
        echo $this->Html->script(array('jquery.min'));

		
		//***** SECCIÓN DE CSS COMPRIMIDOS EN PRODUCCIÓN*****/
		//HABILITAR CUANDO YA SE ENCUENTRE ESTABLE EL SISTEMA Y EN PRODUCCIÓN
		//echo $this->AssetCompress->css('all'); 
		
		
        
        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header role="banner" class="navbar navbar-default navbar-fixed-top">
         <?php
                echo $this->Html->image('LogoSistema1.png');
                ?>
        </header>
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
<?

		//***** SECCIÓN DE CSS Y JAVASCRIPT COMPRIMIDOS EN PRODUCCIÓN*****/
		//echo $this->AssetCompress->script('all'); 


		//***** SECCIÓN JAVASCRIPT EN PRODUCCIÓN*****/
		//Libreria JS para el uso de accordion, tabs y otros componentes de bootstrap
        echo $this->Html->script('bootstrap');
		//Libreria para la interfaz de Jquery, autocomplete, DatePicker,Tabs, etc...
        echo $this->Html->script('jquery-ui-1.10.4.custom.min');
		//Librería que convierte los checkbox a tipo slide->iphone
        echo $this->Html->script('iphone-style-checkboxes');
		//JS de Funciones generales
		echo $this->Html->script('funciones_propias');

		//Password togle visivility
        echo $this->Html->script('jquery.prevue');

		//Background changer plugin
        echo $this->Html->script('jquery.backstretch.min');
		
		
		echo $this->fetch('script');
        ?>    

 
    </body>
</html>
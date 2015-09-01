<?
        echo $this->Html->script(array('jquery.knob'));		
?>
 <!--[if IE]><script type="text/javascript" src="excanvas.js"></script><![endif]-->
 
<script type="text/javascript">
var statSend = false;
function checkSubmit() 
{   
    if (!statSend) 
    {
        statSend = true;
        document.getElementById('btnGuardar').disabled = true;
        return true;
    } 
    else 
    {
        alert("El formulario ya se esta enviando...");
        return false;
    }
}
</script>
<div class="col-md-12">

<div class="col-md-6">

 <div class="col-md-12">
            <h2>Confirmación de Asistencias</h2>
            <?php 
                echo $this->Form->create('Buscador',array(
                            'url' => array('controller' => 'CoUsers', 'action' => 'asistencia'),
                            'type' => 'POST' 
                        ));
                echo '<div class="buscador">
                <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>';
                echo $this->Form->input('usuario', array('label' => false,'class' => 'form-control','placeholder'=>'Ingrese ID de Empleado','width'=>'200px'));        		
                echo '</div></div>';		
                $options = array('label' => 'Check', 'class' => 'btn btn-primary', 'div' => true);
                echo $this->Form->end($options);
            ?>
</div><!-- md12-->    

<? 	if(isset($coUser) and empty($coUser)==false)
	{
?>		
            <div class="col-md-7 well">
               <h1>Último Usuario</h1>            
                <div id="mi_foto">
                
                <!-- Foto del Perfil -->
	                <div class="user-heading round">
   						 <?
						 $usuario_id=$coUser['CoUser']['id'];
						 //Checar imagen de perfil exista, extrañamente usando $this->webroot no funciona..
						 $foto_perfil='../webroot/usuarios/'.$usuario_id.'/'.$usuario_id.'_foto.jpg';
						 
						  if(file_exists($foto_perfil))
						  {
  						    $foto_perfil=$this->webroot.'usuarios/'.$usuario_id.'/'.$usuario_id.'_foto.jpg';
						  }
						  else
						    $foto_perfil=$this->webroot.'img/foto_perfil.jpg';
						 ?>
                            
						<a href="<? echo $this->webroot;?>co_users/view/<? echo $usuario_id;?>"><img class="topnav_img" width="200px" height="200px" src="<? echo  $foto_perfil; ?>" /></a>
                   </div>                        
                <!-- Fin Foto del Perfil -->
                
                </div> 
            </div>    <!-- md7 usuario foto-->      
            
            
		    <div class="col-md-5">
	                <div id="usuario">
                        <h3><? echo $coUser['CoUser']['nombre_completo'] ?></h3>
                    </div>
                    
                    <div id="tipousuario">
                    	<b>Grupo:</b><br>
                        <? echo $coUser['CoGroup']['nombre'] ?>
                    </div>
                    <div id="tipousuario">
                    	<b>Cargo:</b><br>
                        <? echo $coUser['Cargo']['nombre'] ?>
                    </div>
                    <div id="tipousuario">
                    	<b>Entidad:</b><br>
                        <? echo $coUser['Entidade']['nombre'] ?>
                    </div>
                    <div id="tipousuario">
                    	<b>Correo:</b><br>
                        <? echo $coUser['CoUser']['email'] ?>
                    </div>
            </div>    <!-- md5 usuario-->        

	<?
	} //Fin del IF Usuario 
	?>

</div><!-- md6 primera col-->    


<div class="col-md-6">
    <h1>Hora Sistema</h1>
    <input class="knob hour" data-min="0" data-max="24" data-bgColor="#EEE" data-fgColor="#EC7539"  data-width="180" data-height="180" data-thickness=".3">
    <input class="knob minute" data-min="0" data-max="60" data-bgColor="#EEE" data-fgColor="#3688E0" data-width="180" data-height="180" data-thickness=".3">
    <input class="knob second" data-min="0" data-max="60" data-bgColor="#EEE" data-fgColor="#76AE15" data-width="180" data-height="180" data-thickness=".3">
</div><!--  md6 segunda col-->    
	
</div><!-- md12 principal-->    


<script type="text/javascript">

var text_input = document.getElementById('BuscadorUsuario');

text_input.focus();

text_input.onblur = function ()
{
    setTimeout(function () {
        text_input.focus();
    });
};
</script>

<script>
/*
$(document).ready(function()
{
	$('#fancyClock').tzineClock();
});
*/
</script>

<script>
$(function() {
    $(".second").knob({
			/*
				draw: function () 
				{
			         $(this.i).val(this.cv+'%');					 
					  //Puts a percent after values				  
			    },
			*/
			});
    $(".minute").knob();
    $(".hour").knob();		
});
</script>


<script>
        function clock() 
		{
            var $s = $(".second"),
                $m = $(".minute"),
                $h = $(".hour");
                d = new Date(),
                s = d.getSeconds() + "Seg",
                m = d.getMinutes() + "Min",
                h = d.getHours();
            $s.val(s).trigger("change");
            $m.val(m).trigger("change");
            $h.val(h).trigger("change");
            setTimeout("clock()", 1000);
        }
        clock();
</script>




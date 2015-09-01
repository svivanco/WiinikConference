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
<?
if (isset($evento['Evento']['show_infoevent_form']))
{
	
	
}
?>

<div class="col-md-8">
	<h3>
		<?php echo __('Registro de Usuarios'); ?>: <? echo $evento['Evento']['nombre']; ?>
	</h3>
	<?php echo $this->Form->create('CoUser',array('onsubmit'=>'return checkSubmit();','role'=>'form','class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Informaci&oacute;n</legend>
	</fieldset>
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Datos Generales </a>
				</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				<div class="panel-body">
					<?
		echo $this->Form->input('evento_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group'),'readonly'=>'readonly'));
		echo $this->Form->input('co_group_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group'),'readonly'=>'readonly'));
		//echo $this->Form->input('avatar',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		//echo $this->Form->input('cargo_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('titulo_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('nombre',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('paterno',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('materno',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('fecha_nacimiento',array('id'=>'fecha','type' => 'text','between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('email',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('celular',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('tel',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
?>
				</div>
			</div>
		</div>
<? 
	if ($evento['Evento']['datos_direccion'])
	{
?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingTwo">
				<h4 class="panel-title">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> Ubicación Geográfica </a>
				</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
				<div class="panel-body">
					<?
		echo $this->Form->input('institucion',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('pais',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('entidade_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('municipio_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('colonia',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('direccion',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('numero',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('cpostal',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));

?>
				</div>
			</div>
		</div>
		<?
	}//Fin if datos_direccion
?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingThree">
				<h4 class="panel-title">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree"> Hospedaje & Transporte </a>
				</h4>
			</div>
			<div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
				<div class="panel-body">
					<?
	if ($evento['Evento']['datos_transportacion'])
	{
		echo $this->Form->input('medio_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
	}
	
		echo $this->Form->input('hotele_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
					?>
				</div>
			</div>
		</div>
		
		


		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingFour">
				<h4 class="panel-title">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"> Datos de Acceso </a>
				</h4>
			</div>
			<div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
				<div class="panel-body">
					<?		
						echo $this->Form->input('login',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
					?>
					Su nombre de usuario le proporcionara la opción de actualizar sus datos, ya sea que cambie su hotel, medio de transporte o algun error en su información personal.
					<?		
						echo $this->Form->input('password',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
					?>
					Ingrese una contraseña fácil de recordar, debe contener por lo menos cinco (5) caracteres.
				</div>
			</div>
		</div>
	</div>
	
	
	<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary','id'=>'btnGuardar'));
	echo $this->Form->end(); ?>
</div>

<? if ($evento['Evento']['show_infoevent_form'])
	{
?>

		<div class="col-md-4 well2">
		<h2> <? echo $evento['Evento']['nombre']; ?></h2>
		<? echo $evento['Evento']['descripcion']; ?>
		<br />
		<? echo $evento['Evento']['fecha_inicio'];?>
		
		<br /><i class="fa fa-home"></i> <? echo $evento['Evento']['lugar']; ?>
		<br /><i class="fa fa-envelope"></i> <? echo $evento['Evento']['contacto_correo']; ?>
		<br /><i class="fa fa-phone"></i> <? echo $evento['Evento']['contacto_telefono']; ?>
		</div>
<?
	}
?>

<script type="text/javascript"> 
$('#fecha').datepicker
({
											   changeMonth:true,
										       dateFormat:"yy-mm-dd",
											   changeYear:true,
											   minDate: "-80Y",
										      maxDate: "-18Y",											   
										       yearRange: "c-80:c+10",
											   todayHighlight: true

});
</script> 

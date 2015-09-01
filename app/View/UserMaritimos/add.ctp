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
<div class="col-md-10">
    <h3>
        <?php echo __('Nuevo User Maritimo'); ?>    </h3>
    <?php echo $this->Form->create('UserMaritimo',array('onsubmit'=>'return checkSubmit();','role'=>'form','class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Informaci&oacute;n</legend>
	<?php
		echo $this->Form->input('co_user_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group'),'readonly'=>'readonly'));
		echo $this->Form->input('barco',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('fecha_llegada',array('id'=>'fecha','type' => 'text','between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('fecha_salida',array('id'=>'fecha2','type' => 'text','between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
	?>
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary','id'=>'btnGuardar'));

echo $this->Form->end(); ?>
</div>

<script type="text/javascript"> 
$('#fecha').datepicker
({
											   changeMonth:true,
										       dateFormat:"yy-mm-dd",
											   changeYear:true,
											   todayHighlight: true

});

$('#fecha2').datepicker
({
											   changeMonth:true,
										       dateFormat:"yy-mm-dd",
											   changeYear:true,
											   todayHighlight: true

});
</script> 

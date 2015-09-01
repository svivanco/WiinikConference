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
<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">

        <li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $this->Form->value('UserAcompanante.id')),array('class'=>'btn glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $this->Form->value('UserAcompanante.id'))); ?></li>
        <li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class'=>'btn glyphicon glyphicon-list')); ?></li>
            </ul>
</div>
<div class="col-md-10">
    <h3>
        <?php echo __('Editar User Acompanante'); ?>    </h3>
    <?php echo $this->Form->create('UserAcompanante',array('onsubmit'=>'return checkSubmit();','role'=>'form','class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Informaci&oacute;n</legend>
	<?php
		echo $this->Form->input('id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('co_user_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('relacion_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('user_sexo_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('nombre',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('paterno',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('materno',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('edad',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
	?>
	</fieldset>
<?php echo $this->Form->submit('Actualizar',array('class'=>'btn btn-primary','id'=>'btnGuardar'));

echo $this->Form->end(); ?>
</div>

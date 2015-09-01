<?
		//Libreria principal, multiselec
        echo $this->Html->script(array('jquery.multiple.select'));
		echo $this->Html->css('multiple-select');
?>
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

        <li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class'=>'btn glyphicon glyphicon-list')); ?></li>
            </ul>
</div>
<div class="col-md-10">
    <h3>
        <?php echo __('Nuevo Municipio'); ?>    </h3>
    <?php echo $this->Form->create('Municipio',array('onsubmit'=>'return checkSubmit();','role'=>'form','class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Informaci&oacute;n</legend>
	<?php
		echo $this->Form->input('entidade_id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('clave',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('nombre',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('Area',array('between'=>'<div class="col-sm-8">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group2')));
		
		echo $this->Form->input('orden',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
	?>
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary','id'=>'btnGuardar'));

echo $this->Form->end(); ?>
</div>


 <script>
  $("#AreaArea").multipleSelect(
  {
     filter: true
  }
  );
 </script>
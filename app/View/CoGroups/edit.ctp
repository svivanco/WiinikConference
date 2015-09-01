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
<div class="col-md-2 well">
    <h3>Acciones</h3>
    <ul class="nav">

        <li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $this->Form->value('CoGroup.id')), null, __('Realmente desea eliminar el registro con Id %s?', $this->Form->value('CoGroup.id'))); ?></li>
        <li><?php echo $this->Html->link('Listado', array('action' => 'index')); ?></li>
            </ul>
</div>
<div class="col-md-10">
    <h3>
        <?php echo __('Editar Co Group'); ?>    </h3>
    <?php echo $this->Form->create('CoGroup',array('onsubmit'=>'return checkSubmit();','role'=>'form','class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Informaci&oacute;n</legend>
	<?php
		echo $this->Form->input('id',array('between'=>'<div class="col-md-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('nombre',array('between'=>'<div class="col-md-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('pagina_inicio',array('between'=>'<div class="col-md-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('activo',array('before'=>'<div class="col-sm-offset-2 col-sm-10"><div class="checkbox"><label>','after'=>'Activo</label></div></div>','label'=>false,'div'=>array('class'=>'form-group')));
		
	?>
	</fieldset>

<div class="row">
<div class="col-md-5">
    <?
		echo $this->Form->input('CoMenu',array('between'=>'<div class="col-md-8">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group2')));
	?>
</div>   
<div class="col-md-5">
    <?
		echo $this->Form->input('CoPermission',array('between'=>'<div class="col-md-8">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group2')));
	?>
</div>   
</div>
    
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />    
<?php echo $this->Form->submit('Actualizar',array('class'=>'btn btn-primary','id'=>'btnGuardar'));

echo $this->Form->end(); ?>
</div>


 <script>
  $("#CoMenuCoMenu").multipleSelect(
  {
		    filter: true,
            isOpen: true,
            keepOpen: true  }
  );


  $("#CoPermissionCoPermission").multipleSelect(
  {
		    filter: true,
            isOpen: true,
            keepOpen: true  }
  );

 </script>
<?
		//Libreria principal, ColorPicker
	    echo $this->Html->css('colpick');		
        echo $this->Html->script(array('colpick'));

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

        <li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $this->Form->value('EventCatego.id')),array('class'=>'btn glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $this->Form->value('EventCatego.id'))); ?></li>
        <li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class'=>'btn glyphicon glyphicon-list')); ?></li>
            </ul>
</div>
<div class="col-md-10">
    <h3>
        <?php echo __('Editar Event Catego'); ?>    </h3>
    <?php echo $this->Form->create('EventCatego',array('onsubmit'=>'return checkSubmit();','role'=>'form','class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Informaci&oacute;n</legend>
	<?php
		echo $this->Form->input('id',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('categoria',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('backcolor',array('id'=>'picker','between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('textcolor',array('id'=>'picker2','between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
	?>
	</fieldset>
<?php echo $this->Form->submit('Actualizar',array('class'=>'btn btn-primary','id'=>'btnGuardar'));

echo $this->Form->end(); ?>
</div>



<script>
$('#picker').colpick(
{
	layout:'hex',
	submit:0,
	colorScheme:'dark',
	onChange:function(hsb,hex,rgb,el,bySetColor) 
	{
		$(el).css('border-color','#'+hex);
		// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
		if(!bySetColor) $(el).val(hex);
	}
}).keyup(function()
{
	$(this).colpickSetColor(this.value);
});



$('#picker2').colpick(
{
	layout:'hex',
	submit:0,
	colorScheme:'dark',
	onChange:function(hsb,hex,rgb,el,bySetColor) 
	{
		$(el).css('border-color','#'+hex);
		// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
		if(!bySetColor) $(el).val(hex);
	}
}).keyup(function()
{
	$(this).colpickSetColor(this.value);
});



</script>

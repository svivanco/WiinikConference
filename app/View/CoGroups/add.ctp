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

        <li><?php echo $this->Html->link('Listado', array('action' => 'index')); ?></li>
            </ul>
</div>
<div class="col-md-10">
    <h3>
        <?php echo __('Nuevo Grupop'); ?>    </h3>
    <?php echo $this->Form->create('CoGroup',array('onsubmit'=>'return checkSubmit();','role'=>'form','class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Informaci&oacute;n</legend>
	<?php
		echo $this->Form->input('nombre',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('pagina_inicio',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		echo $this->Form->input('activo',array('before'=>'<div class="col-sm-offset-2 col-sm-10"><div class="checkbox"><label>','after'=>'Activo</label></div></div>','label'=>false,'div'=>array('class'=>'form-group')));
		echo $this->Form->input('CoMenu',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group2')));
		
		
		/*
		echo '
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			<div class="col-sm-4">
		
		<select id="CoMenuCoMenu" multiple="multiple" class="form-control" name="data[CoMenu][CoMenu][]" style="display: none;">';

		$firstTime=0;		
		
		foreach($coMenus as $menu_id => $menu)
		{
			
			if(substr($menu,0,1)=="+")
			{
				if($firstTime==0)
				{
					$firstTime=1;
					echo  '<optgroup label="'.$menu.' (Seleccionar Submenus)">';		
					echo '<option value="'.$menu_id.'">'.$menu.'</option>';	
				}
				else
				{
					echo '</optgroup>';		
					echo  '<optgroup label="'.$menu.' (Seleccionar Submenus)">';		
					echo '<option value="'.$menu_id.'">'.$menu.'</option>';	
					$firstTime=0;
				}
			}
			else
			{
				echo '<option value="'.$menu_id.'">'.$menu.'</option>';
			}
			
		}
		'</select>
			</div></div>
		</div>';
		*/
		
		echo $this->Form->input('CoPermission',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
	?>
	</fieldset>
<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary','id'=>'btnGuardar'));

echo $this->Form->end(); ?>
</div>

 <script>
  $("#CoMenuCoMenu").multipleSelect(
  {
     filter: true
  }
  );
 </script>
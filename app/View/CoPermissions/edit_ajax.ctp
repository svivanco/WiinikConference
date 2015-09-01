
<div id="DivAcciones"></div>

<div class="col-md-12">
    <?php 
	echo $this->Form->create('CoPermission',array('role'=>'form','class'=>'form-horizontal')); 
   
	?>
	<fieldset>

	<?php
		echo $this->Form->input('nombre',array('between'=>'<div class="col-sm-4">','after'=>'</div>','class'=>'form-control','label'=>false,'div'=>array('class'=>'form-group'),'readonly'=>'readonly'));
	
		echo $this->Form->input('CoGroup',array('between'=>'<div class="col-md-10">','after'=>'</div>','class'=>'form-control','label'=>false,'div'=>array('class'=>'form-group')));
	
		echo $this->Form->input('id',array('between'=>'<div class="col-md-8">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
		//echo $this->Form->input('activo',array('between'=>'<div class="col-md-8">','after'=>'</div>','class'=>'form-control','label'=>array('class'=>'control-label col-sm-2'),'div'=>array('class'=>'form-group')));
	?>
	</fieldset>
<?php 

        echo $this->Ajax->submit('Actualizar',array('url'=>array('controller'=>'co_permissions','action'=>'save_ajax'),'update'=>'DivAcciones','complete'=>'','class'=>'btn btn-primary','div'=>false));
//echo $this->Form->submit('Actualizar',array('class'=>'btn btn-primary','id'=>'btnGuardar'));

echo $this->Form->end(); ?>
</div>


 <script>
 
  
$('#CoGroupCoGroup').multiSelect({
  selectableHeader: "<div class='alert alert-danger'><span class='orange glyphicons remove_2'></span>Sin Permisos</div>",
  selectionHeader: "<div class='alert alert-info'><span class='ok glyphicons ok_2'></span>Con Permisos</div>",
});
 </script>
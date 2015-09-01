<?

	//Libreria principal, multiselec
    echo $this->Html->script(array('jquery.multiple.select'));
	echo $this->Html->css('multiple-select');
		
	//Libreria principal para selects con buscador
    echo $this->Html->script(array('select2.min'));
	echo $this->Html->css('select2');
	
?>

<div class="col-md-2 well">
    <h3>Acciones</h3>
    <ul class="nav">

        <li><?php echo $this->Html->link('Listado', array('action' => 'index')); ?></li>
            </ul>
</div>
<div class="col-md-10">
    <h1>Agregar Permiso de Aplicaci&oacute;n</h1>
    <fieldset>
        <legend>Seleccione un Controlador...</legend>
        <?php
        echo $this->Form->create('CoPermission',array('role'=>'form','class'=>'form-inline'));
        echo $this->Form->input('controller_id',array('between'=>'<div class="col-sm-8">','after'=>'</div>','class'=>'form-control','label'=>false,'div'=>array('class'=>'form-group2')));
        echo $this->Ajax->submit('Cargar acciones',array('url'=>array('controller'=>'co_permissions','action'=>'get_actions'),'update'=>'DivAcciones','complete'=>'convert_combobox()','class'=>'btn btn-primary','div'=>false));
        echo $this->Form->end();
        ?>
    </fieldset>
    <div id="DivAcciones"></div>
</div>

 <script>
  $("#CoPermissionControllerId").select2(); 
  
  function convert_combobox()
  {
	  
	   $('#CoGroupCoGroup').multipleSelect({
		    filter: true,
            isOpen: true,
            keepOpen: true
        });
  }
	
 </script>
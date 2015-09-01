<div class="col-md-12">
	<h1>Permisos</h1>
	<div class="text-right">
        <div class="btn-group">
            <?php 
            echo $this->Html->link('Nuevo', array('action' => 'add'),array('class'=>'btn btn-default')); 
            echo $this->Html->link('Nuevo desde Aplicacion', array('action' => 'add_from_controller'),array('class'=>'btn btn-default')); 
            echo $this->Html->link('Cargar todos los existentes', array('action' => 'add_all'),array('class'=>'btn btn-default')); 
            echo $this->Html->link('Asignar por Controlador', array('action' => 'panel'),array('class'=>'btn btn-default')); 

            ?>
        </div>        
    </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('nombre'); ?></th>
                    <th><?php echo $this->Paginator->sort('descripcion'); ?></th>
                    <th><?php echo $this->Paginator->sort('activo'); ?></th>
                    <th><?php echo $this->Paginator->sort('created','Fecha de creaci&oacute;n',array('escape'=>false)); ?></th>
                    <th><?php echo $this->Paginator->sort('modified','Ultima modificaci&oacute;n',array('escape'=>false)); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($coPermissions as $coPermission): ?>
	<tr>
		<td><?php echo h($coPermission['CoPermission']['id']); ?>&nbsp;</td>
		<td><?php echo h($coPermission['CoPermission']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($coPermission['CoPermission']['descripcion']); ?>&nbsp;</td>
		<td><?php echo ($coPermission['CoPermission']['activo'])?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>"; ?>&nbsp;</td>
		<td><?php echo h($coPermission['CoPermission']['created']); ?>&nbsp;</td>
		<td><?php echo h($coPermission['CoPermission']['modified']); ?>&nbsp;</td>
		<td>
			<div class='btn-group'>
				<?php echo $this->Html->link('Ver', array('action' => 'view', $coPermission['CoPermission']['id']),array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link('Editar', array('action' => 'edit', $coPermission['CoPermission']['id']),array('class'=>'btn btn-default')); ?>
				<?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $coPermission['CoPermission']['id']), array('class'=>'btn btn-default'), __('Realmente desea eliminar el registro con Id %s?', $coPermission['CoPermission']['id'])); ?>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagina {:page} de {:pages}, mostrando {:current} registros de un total de {:count}, empezando en registro {:start}, terminado en {:end}')
	));
	?>	</p>
	<ul class="pagination">
	<?php
		echo $this->Paginator->first('<span>Inicio</span>',array('tag'=>'li','escape'=>false),null,array('tag'=>'li','class'=>'disabled','escape'=>false));
		echo $this->Paginator->prev('<span>Anterior</span>', array('tag'=>'li','escape'=>false), null, array('tag'=>'li','class' => 'disabled','escape'=>false));
		echo $this->Paginator->numbers(array('separator' => '','escape'=>false,'tag'=>'li','currentClass'=>'active','currentTag'=>'span'));
		echo $this->Paginator->next('<span>Siguiente</span>', array('tag'=>'li','escape'=>false), null, array('tag'=>'li','class' => 'disabled','escape'=>false));
		echo $this->Paginator->last('<span>Final</span>',array('tag'=>'li','escape'=>false),null,array('tag'=>'li','class'=>'disabled','escape'=>false));
	?>
	</ul>
</div>

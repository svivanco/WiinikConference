<div class="col-md-12">
	<h1>Grupos</h1>
	<div class="text-right">
        <?php echo $this->Html->link('Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary')); ?>        </div>
    <table class="table table-bordered">
	<thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('pagina_inicio'); ?></th>
            <th><?php echo $this->Paginator->sort('activo'); ?></th>
            <th><?php echo $this->Paginator->sort('created','Fecha de creaci&oacute;n',array('escape'=>false)); ?></th>
            <th><?php echo $this->Paginator->sort('modified','Ultima modificaci&oacute;n',array('escape'=>false)); ?></th>
            <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($coGroups as $coGroup): ?>
	<tr>
		<td><?php echo h($coGroup['CoGroup']['id']); ?>&nbsp;</td>
		<td><?php echo h($coGroup['CoGroup']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($coGroup['CoGroup']['pagina_inicio']); ?>&nbsp;</td>
		<td><?php echo ($coGroup['CoGroup']['activo'])?'<span class="label label-success">SI</span>':'<span class="label label-danger">NO</span>'; ?>&nbsp;</td>
		<td><?php echo h($coGroup['CoGroup']['created']); ?>&nbsp;</td>
		<td><?php echo h($coGroup['CoGroup']['modified']); ?>&nbsp;</td>
		<td>
			<div class='btn-group'>
				<?php echo $this->Html->link('Ver', array('action' => 'view', $coGroup['CoGroup']['id']),array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link('Editar', array('action' => 'edit', $coGroup['CoGroup']['id']),array('class'=>'btn btn-default')); ?>
				<?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $coGroup['CoGroup']['id']), array('class'=>'btn btn-default'), __('Realmente desea eliminar el registro con Id %s?', $coGroup['CoGroup']['id'])); ?>
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

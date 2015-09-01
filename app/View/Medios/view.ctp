<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $medio['Medio']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $medio['Medio']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $medio['Medio']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Medio</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($medio['Medio']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($medio['Medio']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Habilitado'); ?></dt>
		<dd>
			<?php echo h($medio['Medio']['habilitado']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
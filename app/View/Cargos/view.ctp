<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i> Editar', array('action' => 'edit', $cargo['Cargo']['id']),array('class' => 'submenu-item','escape'=>false)); ?> </li>
		<li><?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> Eliminar', array('action' => 'delete', $cargo['Cargo']['id']),array('class' => 'submenu-item','escape'=>false), __('Are you sure you want to delete # %s?', $cargo['Cargo']['id'])); ?> </li>
		<li><?php echo $this->Html->link('<i class="glyphicon glyphicon-list"></i>Listado', array('action' => 'index'),array('class' => 'submenu-item','escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Nuevo', array('action' => 'add'),array('class' =>'submenu-item','escape'=>false)); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Cargo</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cargo['Cargo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($cargo['Cargo']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Habilitado'); ?></dt>
		<dd>
			<?php echo h($cargo['Cargo']['habilitado']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
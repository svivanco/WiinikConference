<div class="col-md-2 well">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $coPermission['CoPermission']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $coPermission['CoPermission']['id']), null, __('Are you sure you want to delete # %s?', $coPermission['CoPermission']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Co Permission</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($coPermission['CoPermission']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($coPermission['CoPermission']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripcion'); ?></dt>
		<dd>
			<?php echo h($coPermission['CoPermission']['descripcion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activo'); ?></dt>
		<dd>
			<?php echo h($coPermission['CoPermission']['activo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($coPermission['CoPermission']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($coPermission['CoPermission']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
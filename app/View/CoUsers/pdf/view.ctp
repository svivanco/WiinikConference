<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $coUser['CoUser']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $coUser['CoUser']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $coUser['CoUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Co User</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Co Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['CoGroup']['nombre'], array('controller' => 'co_groups', 'action' => 'view', $coUser['CoGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paterno'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['paterno']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Materno'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['materno']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Login'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activo'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['activo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ultimo Acceso'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['ultimo_acceso']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $patrocinadore['Patrocinadore']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $patrocinadore['Patrocinadore']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $patrocinadore['Patrocinadore']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Patrocinadore</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($patrocinadore['Patrocinadore']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($patrocinadore['Evento']['nombre'], array('controller' => 'eventos', 'action' => 'view', $patrocinadore['Evento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($patrocinadore['Patrocinadore']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Web Url'); ?></dt>
		<dd>
			<?php echo h($patrocinadore['Patrocinadore']['web_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Documento'); ?></dt>
		<dd>
			<?php echo h($patrocinadore['Patrocinadore']['documento']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo'); ?></dt>
		<dd>
			<?php echo h($patrocinadore['Patrocinadore']['tipo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Size'); ?></dt>
		<dd>
			<?php echo h($patrocinadore['Patrocinadore']['size']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ruta'); ?></dt>
		<dd>
			<?php echo h($patrocinadore['Patrocinadore']['ruta']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($patrocinadore['Patrocinadore']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($patrocinadore['Patrocinadore']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
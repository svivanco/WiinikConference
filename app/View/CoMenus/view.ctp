<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $coMenu['CoMenu']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $coMenu['CoMenu']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $coMenu['CoMenu']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Co Menu</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($coMenu['CoMenu']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Co Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coMenu['CoMenu']['nombre'], array('controller' => 'co_menus', 'action' => 'view', $coMenu['CoMenu']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Posicion'); ?></dt>
		<dd>
			<?php echo h($coMenu['CoMenu']['posicion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($coMenu['CoMenu']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Destino'); ?></dt>
		<dd>
			<?php echo h($coMenu['CoMenu']['destino']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Info Tooltip'); ?></dt>
		<dd>
			<?php echo h($coMenu['CoMenu']['info_tooltip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Icono'); ?></dt>
		<dd>
			<?php echo h($coMenu['CoMenu']['icono']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activo'); ?></dt>
		<dd>
			<?php echo h($coMenu['CoMenu']['activo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($coMenu['CoMenu']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($coMenu['CoMenu']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
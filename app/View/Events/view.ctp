<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $event['Event']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $event['Event']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Event</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($event['Event']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($event['Evento']['nombre'], array('controller' => 'eventos', 'action' => 'view', $event['Evento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Catego'); ?></dt>
		<dd>
			<?php echo $this->Html->link($event['EventCatego']['categoria'], array('controller' => 'event_categos', 'action' => 'view', $event['EventCatego']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ubicacione'); ?></dt>
		<dd>
			<?php echo $this->Html->link($event['Ubicacione']['id'], array('controller' => 'ubicaciones', 'action' => 'view', $event['Ubicacione']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Co User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($event['CoUser']['nombre'], array('controller' => 'co_users', 'action' => 'view', $event['CoUser']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($event['Event']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripcion'); ?></dt>
		<dd>
			<?php echo h($event['Event']['descripcion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Allday'); ?></dt>
		<dd>
			<?php echo h($event['Event']['allday']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start'); ?></dt>
		<dd>
			<?php echo h($event['Event']['start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End'); ?></dt>
		<dd>
			<?php echo h($event['Event']['end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Realizado'); ?></dt>
		<dd>
			<?php echo h($event['Event']['realizado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($event['Event']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($event['Event']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
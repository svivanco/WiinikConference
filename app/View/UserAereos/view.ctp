<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $userAereo['UserAereo']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $userAereo['UserAereo']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $userAereo['UserAereo']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de User Aereo</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userAereo['UserAereo']['id']); ?>
		</dd>
		<dt><?php echo __('Co User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userAereo['CoUser']['nombre'], array('controller' => 'co_users', 'action' => 'view', $userAereo['CoUser']['id'])); ?>
		</dd>
		<dt><?php echo __('Aeropuerto'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userAereo['Aeropuerto']['nombre'], array('controller' => 'aeropuertos', 'action' => 'view', $userAereo['Aeropuerto']['id'])); ?>
		</dd>
		<dt><?php echo __('Aerolinea'); ?></dt>
		<dd>
			<?php echo h($userAereo['UserAereo']['aerolinea']); ?>
		</dd>
		<dt><?php echo __('Fecha Llegada'); ?></dt>
		<dd>
			<?php echo h($userAereo['UserAereo']['fecha_llegada']); ?>
		</dd>
		<dt><?php echo __('No Vuelo'); ?></dt>
		<dd>
			<?php echo h($userAereo['UserAereo']['no_vuelo']); ?>
		</dd>
		<dt><?php echo __('Fecha Salida'); ?></dt>
		<dd>
			<?php echo h($userAereo['UserAereo']['fecha_salida']); ?>
		</dd>
	</dl>
        </div>
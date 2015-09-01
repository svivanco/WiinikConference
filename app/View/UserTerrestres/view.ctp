<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $userTerrestre['UserTerrestre']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $userTerrestre['UserTerrestre']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $userTerrestre['UserTerrestre']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de User Terrestre</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userTerrestre['UserTerrestre']['id']); ?>
		</dd>
		<dt><?php echo __('Co User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userTerrestre['CoUser']['nombre'], array('controller' => 'co_users', 'action' => 'view', $userTerrestre['CoUser']['id'])); ?>
		</dd>
		<dt><?php echo __('Vehiculo'); ?></dt>
		<dd>
			<?php echo h($userTerrestre['UserTerrestre']['vehiculo']); ?>
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($userTerrestre['UserTerrestre']['color']); ?>
		</dd>
		<dt><?php echo __('Placas'); ?></dt>
		<dd>
			<?php echo h($userTerrestre['UserTerrestre']['placas']); ?>
		</dd>
		<dt><?php echo __('Fecha Llegada'); ?></dt>
		<dd>
			<?php echo h($userTerrestre['UserTerrestre']['fecha_llegada']); ?>
		</dd>
		<dt><?php echo __('Fecha Salida'); ?></dt>
		<dd>
			<?php echo h($userTerrestre['UserTerrestre']['fecha_salida']); ?>
		</dd>
	</dl>
        </div>
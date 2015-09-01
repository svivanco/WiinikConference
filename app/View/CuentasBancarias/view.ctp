<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $cuentasBancaria['CuentasBancaria']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $cuentasBancaria['CuentasBancaria']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $cuentasBancaria['CuentasBancaria']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Cuentas Bancaria</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cuentasBancaria['CuentasBancaria']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cuentasBancaria['Evento']['id'], array('controller' => 'eventos', 'action' => 'view', $cuentasBancaria['Evento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Banco'); ?></dt>
		<dd>
			<?php echo h($cuentasBancaria['CuentasBancaria']['banco']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cuenta'); ?></dt>
		<dd>
			<?php echo h($cuentasBancaria['CuentasBancaria']['cuenta']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ClaveInterbancaria'); ?></dt>
		<dd>
			<?php echo h($cuentasBancaria['CuentasBancaria']['claveInterbancaria']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripcion'); ?></dt>
		<dd>
			<?php echo h($cuentasBancaria['CuentasBancaria']['descripcion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($cuentasBancaria['CuentasBancaria']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($cuentasBancaria['CuentasBancaria']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
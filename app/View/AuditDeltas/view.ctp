<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $auditDelta['AuditDelta']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $auditDelta['AuditDelta']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>

    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Audit Delta</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($auditDelta['AuditDelta']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Audit'); ?></dt>
		<dd>
			<?php echo $this->Html->link($auditDelta['Audit']['id'], array('controller' => 'audits', 'action' => 'view', $auditDelta['Audit']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Property Name'); ?></dt>
		<dd>
			<?php echo h($auditDelta['AuditDelta']['property_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Old Value'); ?></dt>
		<dd>
			<?php echo h($auditDelta['AuditDelta']['old_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('New Value'); ?></dt>
		<dd>
			<?php echo h($auditDelta['AuditDelta']['new_value']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
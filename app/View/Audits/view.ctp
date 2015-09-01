<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $audit['Audit']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $audit['Audit']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $audit['Audit']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Audit</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['event']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entity Id'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['entity_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Json Object'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['json_object']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Source Id'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['source_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ip'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['ip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('BrowserOS'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['browserOS']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OS'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['OS']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('URL Referrer'); ?></dt>
		<dd>
			<?php echo h($audit['Audit']['URL_referrer']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
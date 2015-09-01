<div class="col-md-2 well">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $coGroup['CoGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $coGroup['CoGroup']['id']), null, __('Are you sure you want to delete # %s?', $coGroup['CoGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Co Group</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($coGroup['CoGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($coGroup['CoGroup']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pagina Inicio'); ?></dt>
		<dd>
			<?php echo h($coGroup['CoGroup']['pagina_inicio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activo'); ?></dt>
		<dd>
			<?php echo h($coGroup['CoGroup']['activo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($coGroup['CoGroup']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($coGroup['CoGroup']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $tipoAdjunto['TipoAdjunto']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $tipoAdjunto['TipoAdjunto']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $tipoAdjunto['TipoAdjunto']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Tipo Adjunto</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tipoAdjunto['TipoAdjunto']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Co Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tipoAdjunto['CoGroup']['nombre'], array('controller' => 'co_groups', 'action' => 'view', $tipoAdjunto['CoGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo'); ?></dt>
		<dd>
			<?php echo h($tipoAdjunto['TipoAdjunto']['tipo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tipoAdjunto['TipoAdjunto']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tipoAdjunto['TipoAdjunto']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
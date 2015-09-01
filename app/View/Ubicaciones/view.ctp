<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $ubicacione['Ubicacione']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $ubicacione['Ubicacione']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $ubicacione['Ubicacione']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Ubicacione</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ubicacione['Ubicacione']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ubicacione['Evento']['nombre'], array('controller' => 'eventos', 'action' => 'view', $ubicacione['Evento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre Lugar'); ?></dt>
		<dd>
			<?php echo h($ubicacione['Ubicacione']['nombre_lugar']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Direccion'); ?></dt>
		<dd>
			<?php echo h($ubicacione['Ubicacione']['direccion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitud'); ?></dt>
		<dd>
			<?php echo h($ubicacione['Ubicacione']['latitud']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Longitud'); ?></dt>
		<dd>
			<?php echo h($ubicacione['Ubicacione']['longitud']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Streetview Link'); ?></dt>
		<dd>
			<?php echo h($ubicacione['Ubicacione']['streetview_link']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
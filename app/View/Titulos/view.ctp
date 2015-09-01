<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $titulo['Titulo']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $titulo['Titulo']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $titulo['Titulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Titulo</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($titulo['Titulo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Titulo'); ?></dt>
		<dd>
			<?php echo h($titulo['Titulo']['titulo']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
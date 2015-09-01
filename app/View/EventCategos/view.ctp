<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $eventCatego['EventCatego']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $eventCatego['EventCatego']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $eventCatego['EventCatego']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Event Catego</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($eventCatego['EventCatego']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Categoria'); ?></dt>
		<dd>
			<?php echo h($eventCatego['EventCatego']['categoria']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Backcolor'); ?></dt>
		<dd>
			<?php echo h($eventCatego['EventCatego']['backcolor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Textcolor'); ?></dt>
		<dd>
			<?php echo h($eventCatego['EventCatego']['textcolor']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
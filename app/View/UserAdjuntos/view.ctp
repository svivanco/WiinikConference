<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $userAdjunto['UserAdjunto']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $userAdjunto['UserAdjunto']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $userAdjunto['UserAdjunto']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de User Adjunto</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userAdjunto['UserAdjunto']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Co User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userAdjunto['CoUser']['nombre'], array('controller' => 'co_users', 'action' => 'view', $userAdjunto['CoUser']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo Adjunto'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userAdjunto['TipoAdjunto']['tipo'], array('controller' => 'tipo_adjuntos', 'action' => 'view', $userAdjunto['TipoAdjunto']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Documento'); ?></dt>
		<dd>
			<?php echo h($userAdjunto['UserAdjunto']['documento']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo'); ?></dt>
		<dd>
			<?php echo h($userAdjunto['UserAdjunto']['tipo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Size'); ?></dt>
		<dd>
			<?php echo h($userAdjunto['UserAdjunto']['size']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ruta'); ?></dt>
		<dd>
			<?php echo h($userAdjunto['UserAdjunto']['ruta']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userAdjunto['UserAdjunto']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($userAdjunto['UserAdjunto']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
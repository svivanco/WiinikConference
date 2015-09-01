<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $userAcompanante['UserAcompanante']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $userAcompanante['UserAcompanante']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $userAcompanante['UserAcompanante']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de User Acompanante</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userAcompanante['UserAcompanante']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Co User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userAcompanante['CoUser']['nombre'], array('controller' => 'co_users', 'action' => 'view', $userAcompanante['CoUser']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Relacion'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userAcompanante['Relacion']['relacion_parentesco'], array('controller' => 'relacions', 'action' => 'view', $userAcompanante['Relacion']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Sexo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userAcompanante['UserSexo']['id'], array('controller' => 'user_sexos', 'action' => 'view', $userAcompanante['UserSexo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($userAcompanante['UserAcompanante']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paterno'); ?></dt>
		<dd>
			<?php echo h($userAcompanante['UserAcompanante']['paterno']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Materno'); ?></dt>
		<dd>
			<?php echo h($userAcompanante['UserAcompanante']['materno']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Edad'); ?></dt>
		<dd>
			<?php echo h($userAcompanante['UserAcompanante']['edad']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userAcompanante['UserAcompanante']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($userAcompanante['UserAcompanante']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
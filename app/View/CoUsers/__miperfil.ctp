<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('<i class="glyphicon glyphicon-edit"></i> Editar', array('action' => 'edit', $coUser['CoUser']['id']),array('class' => 'submenu-item','escape'=>false)); ?> </li>
		<li><?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> Eliminar', array('action' => 'delete', $coUser['CoUser']['id']),array('class' => 'submenu-item','escape'=>false), __('Are you sure you want to delete # %s?', $coUser['CoUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link('<i class="glyphicon glyphicon-list"></i> Listado', array('action' => 'index'),array('class' => 'submenu-item','escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Nuevo', array('action' => 'add'),array('class' =>'submenu-item','escape'=>false)); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Co User</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Evento']['nombre'], array('controller' => 'eventos', 'action' => 'view', $coUser['Evento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Co Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['CoGroup']['nombre'], array('controller' => 'co_groups', 'action' => 'view', $coUser['CoGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Avatar'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['avatar']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Titulo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Titulo']['titulo'], array('controller' => 'titulos', 'action' => 'view', $coUser['Titulo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paterno'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['paterno']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Materno'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['materno']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Nacimiento'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['fecha_nacimiento']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Celular'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['celular']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tel'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['tel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Institucion'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['institucion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cargo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Cargo']['nombre'], array('controller' => 'cargos', 'action' => 'view', $coUser['Cargo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Login'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Medio'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Medio']['nombre'], array('controller' => 'medios', 'action' => 'view', $coUser['Medio']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hotele'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Hotele']['nombre'], array('controller' => 'hoteles', 'action' => 'view', $coUser['Hotele']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pais'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['pais']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entidade'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Entidade']['nombre'], array('controller' => 'entidades', 'action' => 'view', $coUser['Entidade']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Municipio'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Municipio']['nombre'], array('controller' => 'municipios', 'action' => 'view', $coUser['Municipio']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Colonia'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['colonia']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Direccion'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['direccion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numero'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['numero']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cpostal'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['cpostal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activo'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['activo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ultimo Acceso'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['ultimo_acceso']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Asistio'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['asistio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
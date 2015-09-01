<div class="col-md-2 well2">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $evento['Evento']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $evento['Evento']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $evento['Evento']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index'),array('class' => 'glyphicon glyphicon-list')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add'),array('class' => 'glyphicon glyphicon-plus')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Evento</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['id']); ?>
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['nombre']); ?>
		</dd>
		<dt><?php echo __('Descripcion'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['descripcion']); ?>
		</dd>
		<dt><?php echo __('Fecha Inicio'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['fecha_inicio']); ?>
		</dd>
		<dt><?php echo __('Fecha Fin'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['fecha_fin']); ?>
		</dd>
		<dt><?php echo __('Cupos'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['cupos']); ?>
		</dd>
		<dt><?php echo __('Lugar'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['lugar']); ?>
		</dd>
		<dt><?php echo __('Contacto Telefono'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['contacto_telefono']); ?>
		</dd>
		<dt><?php echo __('Contacto Correo'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['contacto_correo']); ?>
		</dd>
		<dt><?php echo __('Contacto Direccion'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['contacto_direccion']); ?>
		</dd>
		<dt><?php echo __('Requerir Codigo'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['requerir_codigo']); ?>
		</dd>
		<dt><?php echo __('Codigo'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['codigo']); ?>
		</dd>
		<dt><?php echo __('Permitir Adjuntos'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['permitir_adjuntos']); ?>
		</dd>
		<dt><?php echo __('Permitir Acompanantes'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['permitir_acompanantes']); ?>
		</dd>
		<dt><?php echo __('Requerir Captcha'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['requerir_captcha']); ?>
		</dd>
		<dt><?php echo __('Datos Transportacion'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['datos_transportacion']); ?>
		</dd>
		<dt><?php echo __('Datos Direccion'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['datos_direccion']); ?>
		</dd>
		<dt><?php echo __('Datos Medicos'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['datos_medicos']); ?>
		</dd>
		<dt><?php echo __('Alertar Inscripcion Correo'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['alertar_inscripcion_correo']); ?>
		</dd>
		<dt><?php echo __('Requerir Pago'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['requerir_pago']); ?>
		</dd>
		<dt><?php echo __('Costo Inscripcion'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['costo_inscripcion']); ?>
		</dd>
		<dt><?php echo __('Admin Correos Notificar'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['admin_correos_notificar']); ?>
		</dd>
		<dt><?php echo __('Activar Modulo Agenda'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['activar_modulo_agenda']); ?>
		</dd>
		<dt><?php echo __('Publicado'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['publicado']); ?>
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['created']); ?>
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['modified']); ?>
		</dd>
		<dt><?php echo __('Url Site'); ?></dt>
		<dd>
			<?php echo h($evento['Evento']['url_site']); ?>
		</dd>
	</dl>
        </div>
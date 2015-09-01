<div class="col-md-2 well">
    <h3>Acciones</h3>
    <ul class="nav">
		<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $coConfiguracione['CoConfiguracione']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $coConfiguracione['CoConfiguracione']['id']), null, __('Are you sure you want to delete # %s?', $coConfiguracione['CoConfiguracione']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Listado', array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('Nuevo', array('action' => 'add')); ?> </li>
    </ul>
</div>
<div class="col-md-10">
    <h3>Informaci&oacute;n de Co Configuracione</h3>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($coConfiguracione['CoConfiguracione']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Debug'); ?></dt>
		<dd>
			<?php echo h($coConfiguracione['CoConfiguracione']['debug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AuthType'); ?></dt>
		<dd>
			<?php echo h($coConfiguracione['CoConfiguracione']['authType']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SendMails'); ?></dt>
		<dd>
			<?php echo h($coConfiguracione['CoConfiguracione']['sendMails']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Folder Uploads'); ?></dt>
		<dd>
			<?php echo h($coConfiguracione['CoConfiguracione']['folder_uploads']); ?>
			&nbsp;
		</dd>
	</dl>
        </div>
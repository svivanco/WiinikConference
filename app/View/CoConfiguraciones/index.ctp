<div class="col-md-12">
	<h1>Co Configuraciones</h1>
	<div class="text-right">
        <?php echo $this->Html->link('Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary')); ?>        </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('debug'); ?></th>
                    <th><?php echo $this->Paginator->sort('authType'); ?></th>
                    <th><?php echo $this->Paginator->sort('sendMails'); ?></th>
                    <th><?php echo $this->Paginator->sort('folder_uploads'); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($coConfiguraciones as $coConfiguracione): ?>
	<tr>
		<td><?php echo h($coConfiguracione['CoConfiguracione']['id']); ?>&nbsp;</td>
		<td><?php echo h($coConfiguracione['CoConfiguracione']['debug']); ?>&nbsp;</td>
		<td><?php echo h($coConfiguracione['CoConfiguracione']['authType']); ?>&nbsp;</td>
		<td><?php echo h($coConfiguracione['CoConfiguracione']['sendMails']); ?>&nbsp;</td>
		<td><?php echo h($coConfiguracione['CoConfiguracione']['folder_uploads']); ?>&nbsp;</td>
		<td>
			<div class='btn-group'>
				<?php echo $this->Html->link('Ver', array('action' => 'view', $coConfiguracione['CoConfiguracione']['id']),array('class'=>'btn btn-default')); ?>
				<?php echo $this->Html->link('Editar', array('action' => 'edit', $coConfiguracione['CoConfiguracione']['id']),array('class'=>'btn btn-default')); ?>
				<?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $coConfiguracione['CoConfiguracione']['id']), array('class'=>'btn btn-default'), __('Realmente desea eliminar el registro con Id %s?', $coConfiguracione['CoConfiguracione']['id'])); ?>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Pagina {:page} de {:pages}, mostrando {:current} registros de un total de {:count}, empezando en registro {:start}, terminado en {:end}')
	));
	?>	</p>
	<ul class="pagination">
	<?php
		echo $this->Paginator->first('<span>Inicio</span>',array('tag'=>'li','escape'=>false),null,array('tag'=>'li','class'=>'disabled','escape'=>false));
		echo $this->Paginator->prev('<span>Anterior</span>', array('tag'=>'li','escape'=>false), null, array('tag'=>'li','class' => 'disabled','escape'=>false));
		echo $this->Paginator->numbers(array('separator' => '','escape'=>false,'tag'=>'li','currentClass'=>'active','currentTag'=>'span'));
		echo $this->Paginator->next('<span>Siguiente</span>', array('tag'=>'li','escape'=>false), null, array('tag'=>'li','class' => 'disabled','escape'=>false));
		echo $this->Paginator->last('<span>Final</span>',array('tag'=>'li','escape'=>false),null,array('tag'=>'li','class'=>'disabled','escape'=>false));
	?>
	</ul>
</div>

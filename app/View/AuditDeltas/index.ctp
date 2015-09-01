<div class="col-md-12">
	<h1>Detalles de la Operación</h1>
	<div class="text-right">

</div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('audit_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('Campo'); ?></th>
                    <th><?php echo $this->Paginator->sort('Valor Anterior'); ?></th>
                    <th><?php echo $this->Paginator->sort('Nuevo Valor'); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($auditDeltas as $auditDelta): ?>
	<tr>
		<td><?php echo h($auditDelta['AuditDelta']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($auditDelta['Audit']['id'], array('controller' => 'audits', 'action' => 'view', $auditDelta['Audit']['id'])); ?>
		</td>
		<td><?php echo h($auditDelta['AuditDelta']['property_name']); ?>&nbsp;</td>
		<td><?php echo h($auditDelta['AuditDelta']['old_value']); ?>&nbsp;</td>
		<td><?php echo h($auditDelta['AuditDelta']['new_value']); ?>&nbsp;</td>
		<td>
			<div class='botones'><div class='btn-group'>
				<?php echo $this->Html->link('', array('action' => 'view', $auditDelta['AuditDelta']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
				<?php echo $this->Form->postLink('', array('action' => 'delete', $auditDelta['AuditDelta']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $auditDelta['AuditDelta']['id'])); ?>
			</div></div>
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

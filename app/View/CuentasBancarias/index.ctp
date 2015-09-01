<div class="col-md-12">
	<h1>Cuentas Bancarias</h1>
	<div class="text-right">
        <?php echo $this->Html->link('Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>        </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('evento_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('banco'); ?></th>
                    <th><?php echo $this->Paginator->sort('cuenta'); ?></th>
                    <th><?php echo $this->Paginator->sort('claveInterbancaria'); ?></th>
                    <th><?php echo $this->Paginator->sort('descripcion'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($cuentasBancarias as $cuentasBancaria): ?>
	<tr>
		<td><?php echo h($cuentasBancaria['CuentasBancaria']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cuentasBancaria['Evento']['id'], array('controller' => 'eventos', 'action' => 'view', $cuentasBancaria['Evento']['id'])); ?>
		</td>
		<td><?php echo h($cuentasBancaria['CuentasBancaria']['banco']); ?>&nbsp;</td>
		<td><?php echo h($cuentasBancaria['CuentasBancaria']['cuenta']); ?>&nbsp;</td>
		<td><?php echo h($cuentasBancaria['CuentasBancaria']['claveInterbancaria']); ?>&nbsp;</td>
		<td><?php echo h($cuentasBancaria['CuentasBancaria']['descripcion']); ?>&nbsp;</td>
		<td><?php echo h($cuentasBancaria['CuentasBancaria']['created']); ?>&nbsp;</td>
		<td><?php echo h($cuentasBancaria['CuentasBancaria']['modified']); ?>&nbsp;</td>
		<td>
			<div class='botones'><div class='btn-group'>
				<?php echo $this->Html->link('', array('action' => 'view', $cuentasBancaria['CuentasBancaria']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
				<?php echo $this->Html->link('', array('action' => 'edit', $cuentasBancaria['CuentasBancaria']['id']),array('class'=>'btn btn-default glyphicon glyphicon-edit')); ?>
				<?php echo $this->Form->postLink('', array('action' => 'delete', $cuentasBancaria['CuentasBancaria']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $cuentasBancaria['CuentasBancaria']['id'])); ?>
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

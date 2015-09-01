<div class="col-md-12">
	<h1>Ubicaciones</h1>
	<div class="text-right">
        <?php echo $this->Html->link('Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>        </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('evento_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('nombre_lugar'); ?></th>
                    <th><?php echo $this->Paginator->sort('direccion'); ?></th>
                    <th><?php echo $this->Paginator->sort('latitud'); ?></th>
                    <th><?php echo $this->Paginator->sort('longitud'); ?></th>
                    <th><?php echo $this->Paginator->sort('streetview_link'); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($ubicaciones as $ubicacione): ?>
	<tr>
		<td><?php echo h($ubicacione['Ubicacione']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ubicacione['Evento']['nombre'], array('controller' => 'eventos', 'action' => 'view', $ubicacione['Evento']['id'])); ?>
		</td>
		<td><?php echo h($ubicacione['Ubicacione']['nombre_lugar']); ?>&nbsp;</td>
		<td><?php echo h($ubicacione['Ubicacione']['direccion']); ?>&nbsp;</td>
		<td><?php echo h($ubicacione['Ubicacione']['latitud']); ?>&nbsp;</td>
		<td><?php echo h($ubicacione['Ubicacione']['longitud']); ?>&nbsp;</td>
		<td><?php echo h($ubicacione['Ubicacione']['streetview_link']); ?>&nbsp;</td>
		<td>
			<div class='botones'><div class='btn-group'>
				<?php echo $this->Html->link('', array('action' => 'view', $ubicacione['Ubicacione']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
				<?php echo $this->Html->link('', array('action' => 'edit', $ubicacione['Ubicacione']['id']),array('class'=>'btn btn-default glyphicon glyphicon-edit')); ?>
				<?php echo $this->Form->postLink('', array('action' => 'delete', $ubicacione['Ubicacione']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $ubicacione['Ubicacione']['id'])); ?>
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

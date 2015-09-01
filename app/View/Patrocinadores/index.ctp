<div class="col-md-12">
	<h1>Patrocinadores</h1>
	<div class="text-right">
        <?php echo $this->Html->link('Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>        </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('evento_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('nombre'); ?></th>
                    <th><?php echo $this->Paginator->sort('web_url'); ?></th>
                    <th><?php echo $this->Paginator->sort('documento'); ?></th>
                    <th><?php echo $this->Paginator->sort('tipo'); ?></th>
                    <th><?php echo $this->Paginator->sort('size'); ?></th>
                    <th><?php echo $this->Paginator->sort('ruta'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($patrocinadores as $patrocinadore): ?>
	<tr>
		<td><?php echo h($patrocinadore['Patrocinadore']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($patrocinadore['Evento']['nombre'], array('controller' => 'eventos', 'action' => 'view', $patrocinadore['Evento']['id'])); ?>
		</td>
		<td><?php echo h($patrocinadore['Patrocinadore']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($patrocinadore['Patrocinadore']['web_url']); ?>&nbsp;</td>
		<td><?php echo h($patrocinadore['Patrocinadore']['documento']); ?>&nbsp;</td>
		<td><?php echo h($patrocinadore['Patrocinadore']['tipo']); ?>&nbsp;</td>
		<td><?php echo h($patrocinadore['Patrocinadore']['size']); ?>&nbsp;</td>
		<td><?php echo h($patrocinadore['Patrocinadore']['ruta']); ?>&nbsp;</td>
		<td><?php echo h($patrocinadore['Patrocinadore']['created']); ?>&nbsp;</td>
		<td><?php echo h($patrocinadore['Patrocinadore']['modified']); ?>&nbsp;</td>
		<td>
			<div class='botones'><div class='btn-group'>
				<?php echo $this->Html->link('', array('action' => 'view', $patrocinadore['Patrocinadore']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
				<?php echo $this->Html->link('', array('action' => 'edit', $patrocinadore['Patrocinadore']['id']),array('class'=>'btn btn-default glyphicon glyphicon-edit')); ?>
				<?php echo $this->Form->postLink('', array('action' => 'delete', $patrocinadore['Patrocinadore']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $patrocinadore['Patrocinadore']['id'])); ?>
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

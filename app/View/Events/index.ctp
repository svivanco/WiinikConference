<div class="col-md-12">
	<h1>Events</h1>
	<div class="text-right">
        <?php echo $this->Html->link('Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>        </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('evento_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('event_catego_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('ubicacione_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('co_user_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('title'); ?></th>
                    <th><?php echo $this->Paginator->sort('descripcion'); ?></th>
                    <th><?php echo $this->Paginator->sort('allday'); ?></th>
                    <th><?php echo $this->Paginator->sort('start'); ?></th>
                    <th><?php echo $this->Paginator->sort('end'); ?></th>
                    <th><?php echo $this->Paginator->sort('realizado'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($events as $event): ?>
	<tr>
		<td><?php echo h($event['Event']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($event['Evento']['nombre'], array('controller' => 'eventos', 'action' => 'view', $event['Evento']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($event['EventCatego']['categoria'], array('controller' => 'event_categos', 'action' => 'view', $event['EventCatego']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($event['Ubicacione']['id'], array('controller' => 'ubicaciones', 'action' => 'view', $event['Ubicacione']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($event['CoUser']['nombre'], array('controller' => 'co_users', 'action' => 'view', $event['CoUser']['id'])); ?>
		</td>
		<td><?php echo h($event['Event']['title']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['descripcion']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['allday']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['start']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['end']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['realizado']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['created']); ?>&nbsp;</td>
		<td><?php echo h($event['Event']['modified']); ?>&nbsp;</td>
		<td>
			<div class='botones'><div class='btn-group'>
				<?php echo $this->Html->link('', array('action' => 'view', $event['Event']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
				<?php echo $this->Html->link('', array('action' => 'edit', $event['Event']['id']),array('class'=>'btn btn-default glyphicon glyphicon-edit')); ?>
				<?php echo $this->Form->postLink('', array('action' => 'delete', $event['Event']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $event['Event']['id'])); ?>
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

<div class="col-md-12">
	<h1>User Adjuntos</h1>
	<div class="text-right">
        <?php echo $this->Html->link('Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>        </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('co_user_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('tipo_adjunto_id'); ?></th>
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
	<?php foreach ($userAdjuntos as $userAdjunto): ?>
	<tr>
		<td><?php echo h($userAdjunto['UserAdjunto']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userAdjunto['CoUser']['nombre'], array('controller' => 'co_users', 'action' => 'view', $userAdjunto['CoUser']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userAdjunto['TipoAdjunto']['tipo'], array('controller' => 'tipo_adjuntos', 'action' => 'view', $userAdjunto['TipoAdjunto']['id'])); ?>
		</td>
		<td><?php echo h($userAdjunto['UserAdjunto']['documento']); ?>&nbsp;</td>
		<td><?php echo h($userAdjunto['UserAdjunto']['tipo']); ?>&nbsp;</td>
		<td><?php echo h($userAdjunto['UserAdjunto']['size']); ?>&nbsp;</td>
		<td><?php echo h($userAdjunto['UserAdjunto']['ruta']); ?>&nbsp;</td>
		<td><?php echo h($userAdjunto['UserAdjunto']['created']); ?>&nbsp;</td>
		<td><?php echo h($userAdjunto['UserAdjunto']['modified']); ?>&nbsp;</td>
		<td>
			<div class='botones'><div class='btn-group'>
				<?php echo $this->Html->link('', array('action' => 'view', $userAdjunto['UserAdjunto']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
				<?php echo $this->Html->link('', array('action' => 'edit', $userAdjunto['UserAdjunto']['id']),array('class'=>'btn btn-default glyphicon glyphicon-edit')); ?>
				<?php echo $this->Form->postLink('', array('action' => 'delete', $userAdjunto['UserAdjunto']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $userAdjunto['UserAdjunto']['id'])); ?>
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

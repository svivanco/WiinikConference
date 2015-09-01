<div class="col-md-12">
	<h1>User Aereos</h1>
	<div class="text-right">
        <?php echo $this->Html->link('Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>        </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('co_user_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('aeropuerto_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('aerolinea'); ?></th>
                    <th><?php echo $this->Paginator->sort('fecha_llegada'); ?></th>
                    <th><?php echo $this->Paginator->sort('no_vuelo'); ?></th>
                    <th><?php echo $this->Paginator->sort('fecha_salida'); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($userAereos as $userAereo): ?>
	<tr>
		<td><?php echo h($userAereo['UserAereo']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userAereo['CoUser']['nombre'], array('controller' => 'co_users', 'action' => 'view', $userAereo['CoUser']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userAereo['Aeropuerto']['nombre'], array('controller' => 'aeropuertos', 'action' => 'view', $userAereo['Aeropuerto']['id'])); ?>
		</td>
		<td><?php echo h($userAereo['UserAereo']['aerolinea']); ?>&nbsp;</td>
		<td><?php echo h($userAereo['UserAereo']['fecha_llegada']); ?>&nbsp;</td>
		<td><?php echo h($userAereo['UserAereo']['no_vuelo']); ?>&nbsp;</td>
		<td><?php echo h($userAereo['UserAereo']['fecha_salida']); ?>&nbsp;</td>
		<td>
			<div class='botones'><div class='btn-group'>
				<?php echo $this->Html->link('', array('action' => 'view', $userAereo['UserAereo']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
				<?php echo $this->Html->link('', array('action' => 'edit', $userAereo['UserAereo']['id']),array('class'=>'btn btn-default glyphicon glyphicon-edit')); ?>
				<?php echo $this->Form->postLink('', array('action' => 'delete', $userAereo['UserAereo']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $userAereo['UserAereo']['id'])); ?>
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

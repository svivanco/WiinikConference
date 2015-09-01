<div class="col-md-12">
	<h1>User Acompanantes</h1>
	<div class="text-right">
        <?php echo $this->Html->link('Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>        </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('co_user_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('relacion_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('user_sexo_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('nombre'); ?></th>
                    <th><?php echo $this->Paginator->sort('paterno'); ?></th>
                    <th><?php echo $this->Paginator->sort('materno'); ?></th>
                    <th><?php echo $this->Paginator->sort('edad'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($userAcompanantes as $userAcompanante): ?>
	<tr>
		<td><?php echo h($userAcompanante['UserAcompanante']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userAcompanante['CoUser']['nombre'], array('controller' => 'co_users', 'action' => 'view', $userAcompanante['CoUser']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userAcompanante['Relacion']['relacion_parentesco'], array('controller' => 'relacions', 'action' => 'view', $userAcompanante['Relacion']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userAcompanante['UserSexo']['id'], array('controller' => 'user_sexos', 'action' => 'view', $userAcompanante['UserSexo']['id'])); ?>
		</td>
		<td><?php echo h($userAcompanante['UserAcompanante']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($userAcompanante['UserAcompanante']['paterno']); ?>&nbsp;</td>
		<td><?php echo h($userAcompanante['UserAcompanante']['materno']); ?>&nbsp;</td>
		<td><?php echo h($userAcompanante['UserAcompanante']['edad']); ?>&nbsp;</td>
		<td><?php echo h($userAcompanante['UserAcompanante']['created']); ?>&nbsp;</td>
		<td><?php echo h($userAcompanante['UserAcompanante']['modified']); ?>&nbsp;</td>
		<td>
			<div class='botones'><div class='btn-group'>
				<?php echo $this->Html->link('', array('action' => 'view', $userAcompanante['UserAcompanante']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
				<?php echo $this->Html->link('', array('action' => 'edit', $userAcompanante['UserAcompanante']['id']),array('class'=>'btn btn-default glyphicon glyphicon-edit')); ?>
				<?php echo $this->Form->postLink('', array('action' => 'delete', $userAcompanante['UserAcompanante']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $userAcompanante['UserAcompanante']['id'])); ?>
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

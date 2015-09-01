<div class="col-md-12">
	<h1>Co Users</h1>
	<div class="text-right">
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary','escape'=>false)); ?>        </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('evento_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('co_group_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('avatar'); ?></th>
                    <th><?php echo $this->Paginator->sort('titulo_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('nombre'); ?></th>
                    <th><?php echo $this->Paginator->sort('paterno'); ?></th>
                    <th><?php echo $this->Paginator->sort('materno'); ?></th>
                    <th><?php echo $this->Paginator->sort('fecha_nacimiento'); ?></th>
                    <th><?php echo $this->Paginator->sort('email'); ?></th>
                    <th><?php echo $this->Paginator->sort('celular'); ?></th>
                    <th><?php echo $this->Paginator->sort('tel'); ?></th>
                    <th><?php echo $this->Paginator->sort('institucion'); ?></th>
                    <th><?php echo $this->Paginator->sort('cargo_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('login'); ?></th>
                    <th><?php echo $this->Paginator->sort('password'); ?></th>
                    <th><?php echo $this->Paginator->sort('medio_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('hotele_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('pais'); ?></th>
                    <th><?php echo $this->Paginator->sort('entidade_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('municipio_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('colonia'); ?></th>
                    <th><?php echo $this->Paginator->sort('direccion'); ?></th>
                    <th><?php echo $this->Paginator->sort('numero'); ?></th>
                    <th><?php echo $this->Paginator->sort('cpostal'); ?></th>
                    <th><?php echo $this->Paginator->sort('activo'); ?></th>
                    <th><?php echo $this->Paginator->sort('ultimo_acceso'); ?></th>
                    <th><?php echo $this->Paginator->sort('asistio'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($coUsers as $coUser): ?>
	<tr>
		<td><?php echo h($coUser['CoUser']['id']); ?></td>
		<td>
			<?php echo $this->Html->link($coUser['Evento']['nombre'], array('controller' => 'eventos', 'action' => 'view', $coUser['Evento']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($coUser['CoGroup']['nombre'], array('controller' => 'co_groups', 'action' => 'view', $coUser['CoGroup']['id'])); ?>
		</td>
		<td><?php echo h($coUser['CoUser']['avatar']); ?></td>
		<td>
			<?php echo $this->Html->link($coUser['Titulo']['titulo'], array('controller' => 'titulos', 'action' => 'view', $coUser['Titulo']['id'])); ?>
		</td>
		<td><?php echo h($coUser['CoUser']['nombre']); ?></td>
		<td><?php echo h($coUser['CoUser']['paterno']); ?></td>
		<td><?php echo h($coUser['CoUser']['materno']); ?></td>
		<td><?php echo h($coUser['CoUser']['fecha_nacimiento']); ?></td>
		<td><?php echo h($coUser['CoUser']['email']); ?></td>
		<td><?php echo h($coUser['CoUser']['celular']); ?></td>
		<td><?php echo h($coUser['CoUser']['tel']); ?></td>
		<td><?php echo h($coUser['CoUser']['institucion']); ?></td>
		<td>
			<?php echo $this->Html->link($coUser['Cargo']['nombre'], array('controller' => 'cargos', 'action' => 'view', $coUser['Cargo']['id'])); ?>
		</td>
		<td><?php echo h($coUser['CoUser']['login']); ?></td>
		<td><?php echo h($coUser['CoUser']['password']); ?></td>
		<td>
			<?php echo $this->Html->link($coUser['Medio']['nombre'], array('controller' => 'medios', 'action' => 'view', $coUser['Medio']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($coUser['Hotele']['nombre'], array('controller' => 'hoteles', 'action' => 'view', $coUser['Hotele']['id'])); ?>
		</td>
		<td><?php echo h($coUser['CoUser']['pais']); ?></td>
		<td>
			<?php echo $this->Html->link($coUser['Entidade']['nombre'], array('controller' => 'entidades', 'action' => 'view', $coUser['Entidade']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($coUser['Municipio']['nombre'], array('controller' => 'municipios', 'action' => 'view', $coUser['Municipio']['id'])); ?>
		</td>
		<td><?php echo h($coUser['CoUser']['colonia']); ?></td>
		<td><?php echo h($coUser['CoUser']['direccion']); ?></td>
		<td><?php echo h($coUser['CoUser']['numero']); ?></td>
		<td><?php echo h($coUser['CoUser']['cpostal']); ?></td>
		<td><?php echo h($coUser['CoUser']['activo']); ?></td>
		<td><?php echo h($coUser['CoUser']['ultimo_acceso']); ?></td>
		<td><?php echo h($coUser['CoUser']['asistio']); ?></td>
		<td><?php echo h($coUser['CoUser']['created']); ?></td>
		<td><?php echo h($coUser['CoUser']['modified']); ?></td>
		<td>
			<div class='botones'><div class='btn-group'>
				<?php echo $this->Html->link('', array('action' => 'view', $coUser['CoUser']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
				<?php echo $this->Html->link('', array('action' => 'edit', $coUser['CoUser']['id']),array('class'=>'btn btn-default glyphicon glyphicon-edit')); ?>
				<?php echo $this->Form->postLink('', array('action' => 'delete', $coUser['CoUser']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $coUser['CoUser']['id'])); ?>
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

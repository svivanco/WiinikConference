<?
//Sección para la busqueda y páginado
$urlParams = $this->params['url'];
unset($urlParams['url']);
$this->Paginator->options(array('url' => array('?' => http_build_query($urlParams))));
?>


<div class="col-md-12">
	<h1>Co Menus</h1>


        <div class="container-fluid">
            <h4>Buscador</h4>
            <?php 
                echo $this->Form->create('Buscador',array(
                            'url' => array('controller' => 'CoMenus', 'action' => 'index'),
                            'type' => 'GET' 
                        ));
                echo '<div class="buscador">
                <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>';
                echo $this->Form->input('search_text', array('label' => false,'class' => 'form-control','placeholder'=>'Filtrar','width'=>'200px'));        		
                echo '</div></div>';		
                $options = array('label' => 'Buscar', 'class' => 'btn btn-primary', 'div' => true);
                echo '</div>';
                echo $this->Form->end($options);
            ?>
        </div>



	<div class="text-right">
        <?php echo $this->Html->link('Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>        </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('Padre'); ?></th>                            
                    <th><?php echo $this->Paginator->sort('co_menu_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('posicion'); ?></th>
                    <th><?php echo $this->Paginator->sort('nombre'); ?></th>
                    <th><?php echo $this->Paginator->sort('destino'); ?></th>
                    <th><?php echo $this->Paginator->sort('info_tooltip'); ?></th>
                    <th><?php echo $this->Paginator->sort('icono'); ?></th>
                    <th><?php echo $this->Paginator->sort('activo'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($coMenus as $coMenu): ?>
	<tr>
		<td><?php echo h($coMenu['CoMenu']['id']); ?></td>
		<td><?php echo h($coMenu['MenuPadre']['nombre']); ?></td>
		<td>
			<?php echo $this->Html->link($coMenu['CoMenu']['nombre'], array('controller' => 'co_menus', 'action' => 'view', $coMenu['CoMenu']['id'])); ?>
		</td>
		<td><?php echo h($coMenu['CoMenu']['posicion']); ?></td>
		<td><?php echo h($coMenu['CoMenu']['nombre']); ?></td>
		<td><?php echo h($coMenu['CoMenu']['destino']); ?></td>
		<td><?php echo h($coMenu['CoMenu']['info_tooltip']); ?></td>
		<td><?php echo h($coMenu['CoMenu']['icono']); ?></td>
		<td><?php echo h($coMenu['CoMenu']['activo']); ?></td>
		<td><?php echo h($coMenu['CoMenu']['created']); ?></td>
		<td><?php echo h($coMenu['CoMenu']['modified']); ?></td>
		<td>
			<div class='botones'><div class='btn-group'>
				<?php echo $this->Html->link('', array('action' => 'view', $coMenu['CoMenu']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
				<?php echo $this->Html->link('', array('action' => 'edit', $coMenu['CoMenu']['id']),array('class'=>'btn btn-default glyphicon glyphicon-edit')); ?>
				<?php echo $this->Form->postLink('', array('action' => 'delete', $coMenu['CoMenu']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $coMenu['CoMenu']['id'])); ?>
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

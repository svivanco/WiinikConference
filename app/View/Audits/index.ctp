<?
//Sección para la busqueda y páginado
$urlParams = $this->params['url'];
unset($urlParams['url']);
$this->Paginator->options(array('url' => array('?' => http_build_query($urlParams))));
?>

<div class="col-md-12">
	<h1>Log de Eventos (Auditoría de Registros)</h1>
    
        <div class="container-fluid">
            <h4>Buscador</h4>
            <?php 
                echo $this->Form->create('Buscador',array(
                            'url' => array('controller' => 'Audits', 'action' => 'index'),
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
	
    </div>
    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('event'); ?></th>
                    <th><?php echo $this->Paginator->sort('model'); ?></th>
                    <th><?php echo $this->Paginator->sort('Informacion'); ?></th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($audits as $audit): ?>
	<tr>
		<td><?php echo h($audit['Audit']['id']); ?>
        			<div class='botones'><div class='btn-group'>
			<?php echo $this->Html->link('', array('action' => 'view', $audit['Audit']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
			<?php echo $this->Html->link('', array('controller' => 'AuditDeltas','action' => 'index', $audit['Audit']['id']),array('class'=>'btn btn-default glyphicon glyphicon-th-list')); ?>            

				<?php echo $this->Form->postLink('', array('action' => 'delete', $audit['Audit']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $audit['Audit']['id'])); ?>
			</div></div>

        </td>
		<td><?php echo h($audit['Audit']['event']); ?>&nbsp;</td>
		<td>
		<?php 
		echo h($audit['Audit']['model']); 
		echo "<br>ID:".h($audit['Audit']['entity_id']); 
		?>&nbsp;</td>

		<td>
		<?php 
		
		echo "<br><b>Empleado:</b>".h($audit['Audit']['description']); 
		echo "<br><b>ID:</b>".h($audit['Audit']['source_id']);

		
		echo "<br><br><b>Cambios:</b>".$audit['Audit']['json_object']; 
		
		
		echo "<br><br><b>Fecha:</b>".h($audit['Audit']['created']); 
		echo "<br><b>IP:</b>".h($audit['Audit']['ip']); 
		echo "<br><b>Navegador:</b>".h($audit['Audit']['browserOS']); 
		echo "<br><b>S.O:</b>".h($audit['Audit']['OS']); 
		echo "<br><b>URL:</b>".h($audit['Audit']['URL_referrer']); 

		?>&nbsp;</td>
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

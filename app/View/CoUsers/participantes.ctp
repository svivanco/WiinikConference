<?
//Sección para la busqueda y páginado
$urlParams = $this->params['url'];
unset($urlParams['url']);
$this->Paginator->options(array('url' => array('?' => http_build_query($urlParams))));
?>



<div class="col-md-12">
    <!--
    <div class="searchwrapper_before">
    </div>
    -->
    
    <div class="searchwrapper">
        <div class="col-md-2">
            <h1>Usuarios Registrados</h1>
            
            
                <!-- Submenu de Filtros con Busquedas Avanzadas-->
    <div class="text-left">
            <div class="btn-group">
              <button aria-expanded="false" data-toggle="dropdown" class="btn btn-danger dropdown-toggle" type="button">
                <span class="glyphicons glyphicons-filter"></span>
                <span class="sr-only">Filtros Avanzados</span>
                <span class="caret"></span>
              </button>
             </div>
    </div>
    <br />
    <!-- Fin Submenu de Filtros -->
            
            
        </div><!-- col-md-2 -->
        
        <div class="col-md-7">
            <div class="container-fluid">
                <h4>Buscador</h4>
                <?php 
                    echo $this->Form->create('Buscador',array(
                                'url' => array('controller' => 'CoUsers', 'action' => 'participantes'),
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
            </div><!-- container-fluid -->
            
            <div class="col-md-2">
               <div class="">
                    <?php echo $this->Html->link('Nuevo Usuario', array('controller' => 'CoUsers','action' => 'registro'),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>       
                </div>
            </div><!-- col-md-2 -->
         </div><!-- col-md-8 -->
    </div> <!--Fin searchwrapper -->


</div> <!--Fin col-md-12 -->


    <div class="searchwrapper_after col-md-12">
    </div> <!--Fin searchwrapper_after -->


<div class="row">

    <table class="table table-bordered">
	<thead>
        <tr>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('nombre'); ?></th>
                    <th><?php echo $this->Paginator->sort('contacto'); ?></th>
                    <th><?php echo $this->Paginator->sort('cargo_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('login'); ?></th>
                    <th><?php echo $this->Paginator->sort('medio_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('hotele_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('entidade_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('asistio'); ?></th>
                    <th><?php echo $this->Paginator->sort('acceso'); ?></th>
                    <th class="actions">Acciones</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($coUsers as $coUser): ?>
	<tr>
		<td><?php echo h($coUser['CoUser']['id']); ?></td>
		<td><?php echo $coUser['Titulo']['titulo'] ?> <?php echo h($coUser['CoUser']['nombre']); ?> <?php echo h($coUser['CoUser']['paterno']); ?> <?php echo h($coUser['CoUser']['materno']); ?></td>
		<td>
		<?php echo h($coUser['CoUser']['email']); ?><br />
		<?php echo h($coUser['CoUser']['celular']); ?><br />
		<?php echo h($coUser['CoUser']['tel']); ?>
		</td>
		<td>
			<?php echo $this->Html->link($coUser['Cargo']['nombre'], array('controller' => 'cargos', 'action' => 'view', $coUser['Cargo']['id'])); ?>
		</td>
		<td><?php echo h($coUser['CoUser']['login']); ?></td>
		<td>
			<?php echo $this->Html->link($coUser['Medio']['nombre'], array('controller' => 'medios', 'action' => 'view', $coUser['Medio']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($coUser['Hotele']['nombre'], array('controller' => 'hoteles', 'action' => 'view', $coUser['Hotele']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($coUser['Entidade']['nombre'], array('controller' => 'entidades', 'action' => 'view', $coUser['Entidade']['id'])); ?>
			<?php echo $this->Html->link($coUser['Municipio']['nombre'], array('controller' => 'municipios', 'action' => 'view', $coUser['Municipio']['id'])); ?>			
		</td>
		<td><?php echo h($coUser['CoUser']['asistio']); ?></td>
		<td><?php echo h($coUser['CoUser']['ultimo_acceso']); ?></td>
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

</div><!--Fin Row-->


<script type="text/javascript">
//El autofocus interfiere con el accordion, al tener el foco el prime rinput y al hacer clic en un anchor, automaticamente se desplaza hacia arriba.
/*
var text_input = document.getElementById('BuscadorSearchText');
text_input.focus();
text_input.onblur = function ()
{
    setTimeout(function () {
        text_input.focus();
    });
};
*/





$('#accordion')
  .on('show.bs.collapse', function(e) {
    $(e.target).prev('.panel-heading').addClass('active_accordion');
  })
  .on('hide.bs.collapse', function(e) {
    $(e.target).prev('.panel-heading').removeClass('active_accordion');
  });	
</script>
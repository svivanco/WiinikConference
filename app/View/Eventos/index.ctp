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
	<h1>Eventos</h1>
        </div><!-- col-md-2 -->
        
        <div class="col-md-7">
            <div class="container-fluid">
                <h4>Buscador</h4>
                <?php 
                    echo $this->Form->create('Buscador',array(
                                'url' => array('controller' => 'CoUsers', 'action' => 'bienesraices'),
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
        <?php echo $this->Html->link('Nuevo Registro', array('action' => 'add'),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>        </div>

                </div>
            </div><!-- col-md-2 -->
         </div><!-- col-md-8 -->
    </div> <!--Fin searchwrapper -->


</div> <!--Fin col-md-12 -->


    <div class="searchwrapper_after col-md-12">
    </div> <!--Fin searchwrapper_after -->


<div class="row">

    <div class="col-md-12">
        <div class="panel-group" id="accordion">    
        <?php 
        //ID de los botones accordion
        $X=0;
		foreach ($eventos as $evento)
        { 	
        ?>
    
          <div class="panel panel-greydark">
        <div class="panel-heading<?php //echo $X%2 ? "odd" : "even"; ?>" data-toggle="collapse" data-target="#collapse_<?php echo $X; ?>">
          <h4 class="panel-title accordion-toggle">

            <span class="usuario_acordion"><?php echo h($evento['Evento']['nombre']); ?></span>

            <div class="right"><span class="badge badge-warning">
            </span></div>
          </h4>
        </div><!--Fin panel-heading-->
        <div id="collapse_<?php echo $X; ?>" class="panel-collapse collapse">
          <div class="panel-body">
   
   
        
                <div class="col-md-4"> 
                    <h1>Datos Generales</h1>
                     <ul class="list-unstyled">
					 
	 
                        <!-- ul items-->
                        <li>
                                <span class="glyphicon glyphicon-user"></span>
                                <?php echo h($evento['Evento']['nombre']); ?> (ID: <?php echo h($evento['Evento']['id']); ?>	)
                        </li>
                        <li>
                                <span class="glyphicon glyphicon-user"></span>
                                <?php echo h($evento['Evento']['descripcion']); ?>
                        </li>
                        <li>
                                <span class="glyphicon glyphicon-globe"></span>
                                <?php echo $evento['Evento']['lugar']; ?>
                        </li>
                        <li>
                                <span class="glyphicon glyphicon-globe"></span>
                                <?php echo $evento['Evento']['url_site']; ?>
                        </li>
						
                        <li class="active">
                                <span class="glyphicon glyphicon-earphone"></span>
                                <?php echo h($evento['Evento']['contacto_telefono']); ?>
                        </li>
                        <li class="active">
                                <span class="glyphicon glyphicon-earphone"></span>
                                <?php echo h($evento['Evento']['contacto_direccion']); ?>
                        </li>
                        <li>
                                <span class="glyphicon glyphicon-envelope"></span>
                                <?php echo h($evento['Evento']['contacto_correo']); ?>
                        </li>
                        <li>
                                 <span class="glyphicon glyphicon-calendar"></span>
                                Inicia:<?php echo h($evento['Evento']['fecha_inicio']); ?><br />                   			
                        </li>
                        <li>
                                 <span class="glyphicon glyphicon-time"></span>
                                 Termina:<?php echo h($evento['Evento']['fecha_fin']); ?><br />
                        </li>
                        <li>
                                 <span class="glyphicon glyphicon-time"></span>
                                 Cupos:<?php echo h($evento['Evento']['cupos']); ?><br />
                        </li>
                        </ul>
                
			<div class='botones'><div class='btn-group'>
				<?php echo $this->Html->link('', array('action' => 'view', $evento['Evento']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?>
				<?php echo $this->Html->link('', array('controller' => 'CoUsers','action' => 'registro', $evento['Evento']['id']),array('class'=>'btn btn-default glyphicon glyphicons-plus')); ?>			
			
				<?php echo $this->Html->link('', array('action' => 'edit', $evento['Evento']['id']),array('class'=>'btn btn-default glyphicon glyphicon-edit')); ?>
				<?php echo $this->Form->postLink('', array('action' => 'delete', $evento['Evento']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $evento['Evento']['id'])); ?>
			</div></div>

                </div><!--Fin col-md-4-->
                
                
                
                <div class="col-md-8"> 
                    <h1>Configuraciones</h1>

                <div class="col-md-6"> 
						<div class="row"><div class="col-md-6"><?php echo __('Requerir Codigo'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['requerir_codigo']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Codigo'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['codigo']; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Permitir Adjuntos'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['permitir_adjuntos']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Permitir Acompanantes'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['permitir_acompanantes']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Requerir Captcha'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['requerir_captcha']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Datos Transportacion'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['datos_transportacion']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Datos Direccion'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['datos_direccion']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Datos Medicos'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['datos_medicos']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Alertar Inscripcion Correo'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['alertar_inscripcion_correo']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; ?>
						</div></div>						
				</div>
                <div class="col-md-6"> 
						<dl class="configuraciones">     			

						<div class="row"><div class="col-md-6"><?php echo __('Requerir Pago'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['requerir_pago']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Costo Inscripcion'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['costo_inscripcion']; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Admin Correos Notificar'); ?></div>
						<div class="col-md-6">
							<?php 
							echo $evento['Evento']['admin_correos_notificar']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; 
							?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Activar Modulo Agenda'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['activar_modulo_agenda']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Publicado'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['publicado']? '<span class="blue_font glyphicons glyphicons-ok-2"></span>' : '<span class="orange glyphicons glyphicons-remove-2"></span>'; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Created'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['created']; ?>
						</div></div>
						<div class="row"><div class="col-md-6"><?php echo __('Modified'); ?></div>
						<div class="col-md-6">
							<?php echo $evento['Evento']['modified']; ?>
						</div></div>
					</dl>	     
				</div>


      </div><!--Fin col-md-8-->




            
                
          </div><!--Fin panel-body-->      
        </div><!--Fin Collapse-->
          </div><!--Fin Panel Default-->  
    
        <?php 
        $X++;
        }
        ?>    
     </div>  <!--Fin Panel Group-->
    </div><!--Fin Col-md-12-->

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


$('#accordion')
  .on('show.bs.collapse', function(e) {
    $(e.target).prev('.panel-heading').addClass('active_accordion');
  })
  .on('hide.bs.collapse', function(e) {
    $(e.target).prev('.panel-heading').removeClass('active_accordion');
  });	
</script>
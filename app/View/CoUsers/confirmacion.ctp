<div class="container">
  <h1 class="page-header">Hoja de Registro:  <? echo $coUser['Evento']['nombre']; ?>  </h1>
  <div class="row">
    <!-- left column -->
    <div class="col-md-5 col-sm-6 col-xs-12">
      <div class="text-center">
        <img src="http://lorempixel.com/200/200/people/9/" class="avatar img-circle img-thumbnail" alt="avatar">
		<h4><? echo $coUser['Titulo']['titulo']." ".$coUser['CoUser']['nombre']." ".$coUser['CoUser']['paterno']." ".$coUser['CoUser']['materno'];?></h4>
    
	    <div class="col-md-12 well">
		    <? // Display Barcode 
			    echo $this->Html->image('../usuarios/'.$coUser['CoUser']['id'].'/barcode.png'); 
	    	?>
		</div>
		<dl class="dl-horizontal">
			<dt><?php echo __('Login'); ?></dt>
			<dd>
				<?php echo h($coUser['CoUser']['login']); ?>
				</dd>
			<dt><?php echo __('Password'); ?></dt>
			<dd>
				<?php echo '*****'; ?>
				</dd>
			<dt><?php echo __('Actualizar Datos'); ?></dt>
			<dd>
			<a href="http://www.tsjqroo.gob.mx/conference/">http://www.tsjqroo.gob.mx/conference/</a>
			</dd>
		</dl>
		
		<!--<input type="file" class="text-center center-block well well-sm">
        <h6>Upload a different photo...</h6>-->


      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-7 col-sm-6 col-xs-12 personal-info">

      <div class="alert alert-warning alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a> 
        <i class="glyphicons glyphicons-print"></i>
		Imprima esta hoja y presentela en el evento para agilizar su pase de entrada.
      </div>

      <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a> 
        <i class="fa fa-coffee"></i>
        Esta es su <strong>hoja de confirmación</strong>. Por favor verifique sus datos y en caso de haber correcciones inicie sesión en el Micrositio para corregirlas. Es importante mantenga actualizada la información ya que la documentación (Gafet, Diplomas, Apoyo de Transportación, etc.) será en base a la información capturada.
      </div>


		<div class="row"> 
			<div class="col-md-6">
			      <h3>Información Personal</h3>
				  	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['id']); ?>
		</dd>
		<dt><?php echo __('Co Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['CoGroup']['nombre'], array('controller' => 'co_groups', 'action' => 'view', $coUser['CoGroup']['id'])); ?>
		</dd>
		<dt><?php echo __('Titulo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Titulo']['titulo'], array('controller' => 'titulos', 'action' => 'view', $coUser['Titulo']['id'])); ?>
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['nombre']); ?>
		</dd>
		<dt><?php echo __('Paterno'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['paterno']); ?>
		</dd>
		<dt><?php echo __('Materno'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['materno']); ?>
		</dd>
		<dt><?php echo __('Cargo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Cargo']['nombre'], array('controller' => 'cargos', 'action' => 'view', $coUser['Cargo']['id'])); ?>
		</dd>				
		<dt><?php echo __('Fecha Nacimiento'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['fecha_nacimiento']); ?>
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['email']); ?>
		</dd>
		<dt><?php echo __('Celular'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['celular']); ?>
		</dd>
		<dt><?php echo __('Tel'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['tel']); ?>
		</dd>		
<? 
	if ($coUser['Evento']['datos_direccion'])
	{
?>
		
		<dt><?php echo __('Institucion'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['institucion']); ?>
		</dd>
		<dt><?php echo __('Pais'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['pais']); ?>
		</dd>
		<dt><?php echo __('Entidade'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Entidade']['nombre'], array('controller' => 'entidades', 'action' => 'view', $coUser['Entidade']['id'])); ?>
		</dd>
		<dt><?php echo __('Municipio'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Municipio']['nombre'], array('controller' => 'municipios', 'action' => 'view', $coUser['Municipio']['id'])); ?>
		</dd>
		<dt><?php echo __('Colonia'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['colonia']); ?>
		</dd>
		<dt><?php echo __('Direccion'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['direccion']); ?>
		</dd>
		<dt><?php echo __('Numero'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['numero']); ?>
		</dd>
		<dt><?php echo __('Cpostal'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['cpostal']); ?>
		</dd>
<?
	}//Fin if datos_direccion
?>
		
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($coUser['CoUser']['created']); ?>
		</dd>
	</dl>   
	
			</div>
			<div class="col-md-6">
			      <h3>Transporte & Hospedaje</h3>
				  <dl>
		<dt><?php echo __('Medio'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Medio']['nombre'], array('controller' => 'medios', 'action' => 'view', $coUser['Medio']['id'])); ?>
		</dd>

	<?
	switch($coUser['Medio']['id'])
	{
							//Aereo
							case 1:								
								?>
		<dt><?php echo __('Aeropuerto'); ?></dt>
		<dd>
			<?php 
			echo  $aeropuertos[$coUser['UserAereo']['aeropuerto_id']]; 
			?>
		</dd>
		<dt><?php echo __('Aerolinea'); ?></dt>
		<dd>
			<?php echo h($coUser['UserAereo']['aerolinea']); ?>
		</dd>
		<dt><?php echo __('Fecha Llegada'); ?></dt>
		<dd>
			<?php echo h($coUser['UserAereo']['fecha_llegada']); ?>
		</dd>
		<dt><?php echo __('No Vuelo'); ?></dt>
		<dd>
			<?php echo h($coUser['UserAereo']['no_vuelo']); ?>
		</dd>
		<dt><?php echo __('Fecha Salida'); ?></dt>
		<dd>
			<?php echo h($coUser['UserAereo']['fecha_salida']); ?>
		</dd>
										
								<?
							break;
							
							//Terrestre
							case 2:
							?>
		<dt><?php echo __('Vehiculo'); ?></dt>
		<dd>
			<?php echo h($coUser['UserTerrestre']['vehiculo']); ?>
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($coUser['UserTerrestre']['color']); ?>
		</dd>
		<dt><?php echo __('Placas'); ?></dt>
		<dd>
			<?php echo h($coUser['UserTerrestre']['placas']); ?>
		</dd>
		<dt><?php echo __('Fecha Llegada'); ?></dt>
		<dd>
			<?php echo h($coUser['UserTerrestre']['fecha_llegada']); ?>
		</dd>
		<dt><?php echo __('Fecha Salida'); ?></dt>
		<dd>
			<?php echo h($coUser['UserTerrestre']['fecha_salida']); ?>
		</dd>

							<?
							break;
							
							//Maritimo
							case 3:
							?>
		<dt><?php echo __('Barco'); ?></dt>
		<dd>
			<?php echo h($coUser['UserMaritimo']['barco']); ?>
		</dd>
		<dt><?php echo __('Fecha Llegada'); ?></dt>
		<dd>
			<?php echo h($coUser['UserMaritimo']['fecha_llegada']); ?>
		</dd>
		<dt><?php echo __('Fecha Salida'); ?></dt>
		<dd>
			<?php echo h($coUser['UserMaritimo']['fecha_salida']); ?>
		</dd>
							<?
							break;
							
							default:
	}

	?>		
		
		
		<dt><?php echo __('Hotele'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coUser['Hotele']['nombre'], array('controller' => 'hoteles', 'action' => 'view', $coUser['Hotele']['id'])); ?>
		</dd>
				  </dl>
			</div>
		</div>
		



	
	 </div>
  </div>
</div>





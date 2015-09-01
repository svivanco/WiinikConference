<?    
	//Estilos sólo para el perfil
    echo $this->Html->css('perfil');		
?>

<!-- Primera Columna Acciones-->


<div class="col-md-2 well2">
	<div class="row">
		<div class="col-xs-6 col-md-12">
			<h3>
				Acciones
			</h3>
			<ul class="nav">
				<li><?php echo $this->Html->link('Editar', array('action' => 'edit', $coUser['CoUser']['id']),array('class' => 'glyphicon glyphicon-edit')); ?> </li>
				<li><?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $coUser['CoUser']['id']),array('class' => 'glyphicon glyphicon-remove'), __('Are you sure you want to delete # %s?', $coUser['CoUser']['id'])); ?> </li>
				<li><?php echo $this->Html->link('Cambiar Contraseña', array('action' => 'cambio_contrasena', $coUser['CoUser']['id']),array('class' => 'glyphicon glyphicon-lock')); ?> </li>
				<li><?php echo $this->Html->link('Cambiar Avatar', array('action' => 'cambio_avatar', $coUser['CoUser']['id']),array('class' => 'glyphicon glyphicon-picture')); ?> </li>
			</ul>
		</div>
	</div>
</div>
<!-- Fin Primera Columna Acciones-->

<div class="col-md-10">
	<div class="row"> 
		<!-- Segunda Columna-->
		<div class="col-md-4"> 
			<!-- Foto del Perfil -->
			<div class="user-heading round green">
				<?
				 //Checar imagen de perfil exista, extrañamente usando $this->webroot no funciona..
				 $foto_perfil='../webroot/usuarios/'.$coUser['CoUser']['id'].'/'.$coUser['CoUser']['id'].'_foto.jpg';
					 
				  if(file_exists($foto_perfil))
				  {
  				    $foto_perfil=$this->webroot.'usuarios/'.$coUser['CoUser']['id'].'/'.$coUser['CoUser']['id'].'_foto.jpg';
				  }
				  else
				    $foto_perfil=$this->webroot.'img/foto_perfil.jpg';
				 ?>
				<a href="<? echo $this->webroot;?>co_users/view/<? echo $coUser['CoUser']['id'];?>"><img class="topnav_img" width="200px" height="200px" src="<? echo  $foto_perfil; ?>" /></a> </div>
			<!-- Fin Foto del Perfil --> 
		</div>
		<!-- Fin Segunda Columna--> 
		
		<!-- Tercera Columna-->
		<div class="col-md-8">
			<h3>
				<?php echo h($coUser['CoUser']['nombre']." ".$coUser['CoUser']['paterno']." ".$coUser['CoUser']['materno']); ?>
			</h3>
			<div class="row">
				<div class="bio-row">
					<p>
						<span>
							<i class="fa fa-group"></i>Grupo
						</span>
						: <?php echo $coUser['CoGroup']['nombre'];?>
					</p>
				</div>
				<div class="bio-row">
					<p>
						<span>
							<i class="fa fa-birthday-cake"></i> F. Nacimiento
						</span>
						: <?php echo h($coUser['CoUser']['fechanac']); ?>
					</p>
				</div>
				<div class="bio-row">
					<p>
						<span>
							<i class="fa fa-graduation-cap"></i>Ocupación
						</span>
						:
						<?php 
                            if (isset($coUser['UserEconomico']['CatsofimActividad']))
                                  	echo $coUser['UserEconomico']['CatsofimActividad']['actividad'];
                       	?>
					</p>
				</div>
				<div class="bio-row">
					<p>
						<span>
							<i class="fa fa-envelope"></i>Correo
						</span>
						: <a class="text-gray" href="mailto:<?php echo h($coUser['CoUser']['email']); ?>"><?php echo h($coUser['CoUser']['email']); ?></a> 
				</div>
				<div class="bio-row">
					<p>
						<span>
							<i class="fa fa-mobile"></i>Celular
						</span>
						: <?php echo $coUser['UserData']['celular'] ?>
					</p>
				</div>
				<div class="bio-row">
					<p>
						<span>
							<i class="fa fa-phone"></i> Teléfono
						</span>
						: <?php echo $coUser['UserData']['tel'] ?>
					</p>
				</div>
			</div>
		</div>
		<!-- Fin Tercera Columna--> 
	</div>
	
	<!-- Inicia Sección de pestañas-->
	
	<div class="row">
		<div class="col-md-12 tabs_bio"> 
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#Perfil" data-toggle="tab">Datos Generales</a></li>
				<li><a href="#Economicos" data-toggle="tab">Hospedaje & Transporte</a></li>
				<li><a href="#Complementarios" data-toggle="tab">Complementarios</a></li>
				<li><a href="#GeoData" data-toggle="tab">GeoData</a></li>
				<li><a href="#Documentos" data-toggle="tab">Documentos</a></li>
				<li><a href="#Prestamos" data-toggle="tab">Prestamos & Servicios</a></li>
			</ul>
			
			<!-- Tab panes -->
			<div class="tab-content"> 
				
				<!-- Inician Tabs -->
				
				<div class="tab-pane fade in active" id="Perfil">
					<div class="col-md-6 col-xs-6">
						<h3>
							Informaci&oacute;n Principal
							<div class="update"><?php echo $this->Html->link('Editar', array('action' => 'edit', $coUser['CoUser']['id']),array('class' => 'btn btn-success glyphicon glyphicon-edit')); ?></div>
						</h3>
						<dl class="dl-horizontal">
							<dt><?php echo __('Id'); ?></dt>
							<dd> <?php echo h($coUser['CoUser']['id']); ?> </dd>
							<dt><?php echo __('Co Group'); ?></dt>
							<dd> <?php echo $this->Html->link($coUser['CoGroup']['nombre'], array('controller' => 'co_groups', 'action' => 'view', $coUser['CoGroup']['id'])); ?> </dd>
							<dt><?php echo __('User Tipo'); ?></dt>
							<dd> <?php echo $this->Html->link($coUser['UserTipo']['tipo'], array('controller' => 'user_tipos', 'action' => 'view', $coUser['UserTipo']['id'])); ?> </dd>
							<dt><?php echo __('Entidade'); ?></dt>
							<dd> <?php echo $this->Html->link($coUser['Entidade']['nombre'], array('controller' => 'entidades', 'action' => 'view', $coUser['Entidade']['id'])); ?> </dd>
							<dt><?php echo __('Municipio'); ?></dt>
							<dd> <?php echo $this->Html->link($coUser['CatsofimLocalidad']['localidad'], array('controller' => 'CatsofimLocalidad', 'action' => 'view', $coUser['CatsofimLocalidad']['id'])); ?> </dd>
							<dt><?php echo __('Sucursale'); ?></dt>
							<dd> <?php echo $this->Html->link($coUser['Sucursale']['nombre'], array('controller' => 'sucursales', 'action' => 'view', $coUser['Sucursale']['id'])); ?> </dd>
							<dt><?php echo __('Nombre'); ?></dt>
							<dd> <?php echo h($coUser['CoUser']['nombre']); ?> </dd>
							<dt><?php echo __('Paterno'); ?></dt>
							<dd> <?php echo h($coUser['CoUser']['paterno']); ?> </dd>
							<dt><?php echo __('Materno'); ?></dt>
							<dd> <?php echo h($coUser['CoUser']['materno']); ?> </dd>
							<dt><?php echo __('Login'); ?></dt>
							<dd> <?php echo h($coUser['CoUser']['login']); ?> </dd>
							<dt><?php echo __('Password'); ?></dt>
							<dd> °°°°°° </dd>
							<dt><?php echo __('Email'); ?></dt>
							<dd> <?php echo h($coUser['CoUser']['email']); ?> </dd>
							<dt><?php echo __('Activo'); ?></dt>
							<dd> <?php echo h($coUser['CoUser']['activo']); ?> </dd>
							<dt><?php echo __('Ultimo Acceso'); ?></dt>
							<dd> <?php echo h($coUser['CoUser']['ultimo_acceso']); ?> </dd>
							<dt><?php echo __('Created'); ?></dt>
							<dd> <?php echo h($coUser['CoUser']['created']); ?> </dd>
							<dt><?php echo __('Modified'); ?></dt>
							<dd> <?php echo h($coUser['CoUser']['modified']); ?> </dd>
						</dl>
					</div>
					<!--Fin MD6 -->
					
					<div class="col-md-6 col-xs-6">
						<h3>
							Informaci&oacute;n General
							<div class="update">
								<? 
								 if($coUser['UserData']['id']==NULL)
								 {
									echo $this->Html->link('Agregar', array('controller'=>'UserDatas','action' => 'add', $coUser['CoUser']['id']),array('class' => 'btn btn-danger glyphicon glyphicon-plus'));
								 }
								 else
								 {
									echo $this->Html->link('Editar', array('controller'=>'UserDatas','action' => 'edit', $coUser['UserData']['id']),array('class' => 'btn btn-success glyphicon glyphicon-edit'));
								 }
								 ?>
							</div>
						</h3>
						<? 
						//Para evitar el intentar imprimir variables que no existen..
						 if($coUser['UserData']['id']!=NULL)
						 {
						?>
							<dl class="dl-horizontal">
								<dt><?php echo __('Id'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['id']); ?> </dd>
								<dt><?php echo __('User Escolaridade'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserData']['UserEscolaridade']['grado'], array('controller' => 'user_escolaridades', 'action' => 'view', $coUser['UserData']['UserEscolaridade']['id'])); ?> </dd>
								<dt><?php echo __('User Tipo Vivienda'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserData']['UserTipoVivienda']['tipo'], array('controller' => 'user_tipo_viviendas', 'action' => 'view', $coUser['UserData']['UserTipoVivienda']['id'])); ?> </dd>
								<dt><?php echo __('User Estado Civile'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserData']['UserEstadoCivile']['estado'], array('controller' => 'user_estado_civiles', 'action' => 'view', $coUser['UserData']['UserEstadoCivile']['id'])); ?> </dd>
								<dt><?php echo __('User Sexo'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserData']['UserSexo']['sexo'], array('controller' => 'user_sexos', 'action' => 'view', $coUser['UserData']['UserSexo']['id'])); ?> </dd>
								<dt><?php echo __('User Empresa Celulare'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserData']['UserEmpresaCelulare']['empresa'], array('controller' => 'user_empresa_celulares', 'action' => 'view', $coUser['UserData']['UserEmpresaCelulare']['id'])); ?> </dd>
								<dt><?php echo __('Apodo'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['apodo']); ?> </dd>
								<dt><?php echo __('Curp'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['curp']); ?> </dd>
								<dt><?php echo __('Pais'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['pais']); ?> </dd>
								<dt><?php echo __('Nacionalidad'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['nacionalidad']); ?> </dd>
								<dt><?php echo __('Entidade'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserData']['Entidade']['nombre'], array('controller' => 'entidades', 'action' => 'view', $coUser['UserData']['Entidade']['id'])); ?> </dd>
								<dt><?php echo __('Catsofim Localidad'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserData']['CatsofimLocalidad']['localidad'], array('controller' => 'catsofim_localidads', 'action' => 'view', $coUser['UserData']['CatsofimLocalidad']['id'])); ?> </dd>
								<dt><?php echo __('Colonia'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['colonia']); ?> </dd>
								<dt><?php echo __('Direccion'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['direccion']); ?> </dd>
								<dt><?php echo __('Numero'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['numero']); ?> </dd>
								<dt><?php echo __('Cruzamientos'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['cruzamientos']); ?> </dd>
								<dt><?php echo __('Cpostal'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['cpostal']); ?> </dd>
								<dt><?php echo __('DirecDescrip'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['direcDescrip']); ?> </dd>
								<dt><?php echo __('Celular'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['celular']); ?> </dd>
								<dt><?php echo __('Tel'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['tel']); ?> </dd>
								<dt><?php echo __('Aresidencia'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['aresidencia']); ?> </dd>
								<dt><?php echo __('Jefe'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['jefe']); ?> </dd>
								<dt><?php echo __('Fechanac'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['fechanac']); ?> </dd>
								<dt><?php echo __('Latitud'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['latitud']); ?> </dd>
								<dt><?php echo __('Longitud'); ?></dt>
								<dd> <?php echo h($coUser['UserData']['longitud']); ?> </dd>
							</dl>
						<?
						 }//Fin del IF CoUser['UserData']
						?>
					</div>
					<!--Fin MD6 --> 
					
				</div>
				<!--Fin Tab Perfil -->
				
				<div class="tab-pane fade" id="Economicos">
					<div class="col-md-6">
						<h3>
							Informaci&oacute;n Economica
							<div class="update">
								<? 
									 if($coUser['UserEconomico']['id']==NULL)
									 {
										echo $this->Html->link('Agregar', array('controller'=>'UserEconomicos','action' => 'add', $coUser['CoUser']['id']),array('class' => 'btn btn-danger glyphicon glyphicon-plus'));
									 }
									 else
									 {
										echo $this->Html->link('Editar', array('controller'=>'UserEconomicos','action' => 'edit', $coUser['UserEconomico']['id']),array('class' => 'btn btn-success glyphicon glyphicon-edit'));
									 }
								 ?>
							</div>
						</h3>
						<? 
						//Para evitar el intentar imprimir variables que no existen..
						 if($coUser['UserEconomico']['id']!=NULL)
						 {
						?>
							<dl class="dl-horizontal">
								<dt><?php echo __('Id'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['id']); ?> </dd>
								<dt><?php echo __('Catsofim Actividad'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserEconomico']['CatsofimActividad']['actividad'], array('controller' => 'catsofim_actividads', 'action' => 'view', $coUser['UserEconomico']['CatsofimActividad']['id'])); ?> </dd>
								<dt><?php echo __('Periocidad Ingreso'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserEconomico']['PeriocidadIngreso']['ciclo'], array('controller' => 'periocidad_ingresos', 'action' => 'view', $coUser['UserEconomico']['PeriocidadIngreso']['id'])); ?> </dd>
								<dt><?php echo __('Ingreso Promedio'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['ingreso_promedio']); ?> </dd>
								<dt><?php echo __('Depenmayo'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['depenmayo']); ?> </dd>
								<dt><?php echo __('Depenmeno'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['depenmeno']); ?> </dd>
								<dt><?php echo __('Gelectricidad'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['gelectricidad']); ?> </dd>
								<dt><?php echo __('Gtel'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['gtel']); ?> </dd>
								<dt><?php echo __('Gvivienda'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['gvivienda']); ?> </dd>
								<dt><?php echo __('Gcombus'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['gcombus']); ?> </dd>
								<dt><?php echo __('Gmedicos'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['gmedicos']); ?> </dd>
								<dt><?php echo __('Ghogar'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['ghogar']); ?> </dd>
								<dt><?php echo __('Geducacion'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['geducacion']); ?> </dd>
								<dt><?php echo __('Deudas'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['deudas']); ?> </dd>
								<dt><?php echo __('Otros'); ?></dt>
								<dd> <?php echo h($coUser['UserEconomico']['otros']); ?> </dd>
							</dl>
						<?
						 }//Fin del IF CoUser['UserEconomico']
						?>
					</div>
					<div class="col-md-6">
						<h3>
							Informaci&oacute;n de Trabajo
							<div class="update">
							<? 
							 if($coUser['UserLaborale']['id']==NULL)
							 {
								echo $this->Html->link('Agregar', array('controller'=>'UserLaborales','action' => 'add', $coUser['CoUser']['id']),array('class' => 'btn btn-danger glyphicon glyphicon-plus'));
							 }
							 else
							 {
								echo $this->Html->link('Editar', array('controller'=>'UserLaborales','action' => 'edit', $coUser['UserLaborale']['id']),array('class' => 'btn btn-success glyphicon glyphicon-edit'));
							 }
							 ?>
						</h3>
						<? 
						//Para evitar el intentar imprimir variables que no existen..
						 if($coUser['UserLaborale']['id']!=NULL)
						 {
						?>
							<dl class="dl-horizontal">
								<dt><?php echo __('Id'); ?></dt>
								<dd> <?php echo h($coUser['UserLaborale']['id']); ?> </dd>
								<dt><?php echo __('Entidade'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserLaborale']['Entidade']['nombre'], array('controller' => 'entidades', 'action' => 'view', $coUser['UserLaborale']['Entidade']['id'])); ?> </dd>
								<dt><?php echo __('Municipio'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserLaborale']['CatsofimLocalidad']['localidad'], array('controller' => 'CatsofimLocalidads', 'action' => 'view', $coUser['UserLaborale']['CatsofimLocalidad']['id'])); ?> </dd>
								<dt><?php echo __('Ramo Empresa'); ?></dt>
								<dd> <?php echo $this->Html->link($coUser['UserLaborale']['RamoEmpresa']['ramo'], array('controller' => 'ramo_empresas', 'action' => 'view', $coUser['UserLaborale']['RamoEmpresa']['id'])); ?> </dd>
								<dt><?php echo __('Empresa'); ?></dt>
								<dd> <?php echo h($coUser['UserLaborale']['empresa']); ?> </dd>
								<dt><?php echo __('Ini Operaciones'); ?></dt>
								<dd> <?php echo h($coUser['UserLaborale']['ini_operaciones']); ?> </dd>
								<dt><?php echo __('Direccion'); ?></dt>
								<dd> <?php echo h($coUser['UserLaborale']['direccion']); ?> </dd>
								<dt><?php echo __('Numero'); ?></dt>
								<dd> <?php echo h($coUser['UserLaborale']['numero']); ?> </dd>
								<dt><?php echo __('Tel'); ?></dt>
								<dd> <?php echo h($coUser['UserLaborale']['tel']); ?> </dd>
								<dt><?php echo __('Email Trabajo'); ?></dt>
								<dd> <?php echo h($coUser['UserLaborale']['email_trabajo']); ?> </dd>
								<dt><?php echo __('Act Principal'); ?></dt>
								<dd> <?php echo h($coUser['UserLaborale']['act_principal']); ?> </dd>
							</dl>
						<?
						 }//Fin del IF CoUser['UserLaborale']
						?>
					</div>
				</div>
				<!--Fin Tab Economicos -->
				
				<div class="tab-pane fade" id="Complementarios">
					<h3>
						Informaci&oacute;n de User Conyuge
						<div class="update">
							<? 
							 if($coUser['UserConyuge']['id']==NULL)
							 {
								echo $this->Html->link('Agregar', array('controller'=>'UserConyuges','action' => 'add', $coUser['CoUser']['id']),array('class' => 'btn btn-danger glyphicon glyphicon-plus'));
							 }
							 else
							 {
								echo $this->Html->link('Editar', array('controller'=>'UserConyuges','action' => 'edit', $coUser['UserConyuge']['id']),array('class' => 'btn btn-success glyphicon glyphicon-edit'));
							 }
							 ?>
						</div>
					</h3>
					<? 
					//Para evitar el intentar imprimir variables que no existen..
					 if($coUser['UserConyuge']['id']!=NULL)
					 {
					?>
						<dl class="dl-horizontal">
							<dt><?php echo __('Id'); ?></dt>
							<dd> <?php echo h($coUser['UserConyuge']['id']); ?> </dd>
							<dt><?php echo __('User Sexo'); ?></dt>
							<dd> <?php echo $this->Html->link($coUser['UserConyuge']['UserSexo']['sexo'], array('controller' => 'user_sexos', 'action' => 'view', $coUser['UserConyuge']['UserSexo']['id'])); ?> </dd>
							<dt><?php echo __('Nombre'); ?></dt>
							<dd> <?php echo h($coUser['UserConyuge']['nombre']); ?> </dd>
							<dt><?php echo __('Paterno'); ?></dt>
							<dd> <?php echo h($coUser['UserConyuge']['paterno']); ?> </dd>
							<dt><?php echo __('Materno'); ?></dt>
							<dd> <?php echo h($coUser['UserConyuge']['materno']); ?> </dd>
							<dt><?php echo __('Ocup Conyuge'); ?></dt>
							<dd> <?php echo h($coUser['UserConyuge']['ocup_conyuge']); ?> </dd>
							<dt><?php echo __('Nac Conyuge'); ?></dt>
							<dd> <?php echo h($coUser['UserConyuge']['nac_conyuge']); ?> </dd>
						</dl>
					<? 
					 }//Fin del IF CoUser['UserConyuge']
					?>
				</div>
				<!--Fin Tab Complementarios -->
				
				<div class="tab-pane fade" id="GeoData">
					<div class="col-md-4">
						<h3>
							<?php printf('Dirección del Usuario'); ?>
						</h3>
						<div id="mapaDirections"></div>
					</div>
					<!--Fin MD6 -->
					
					<div class="col-md-8">
						<div class="btn-group">
							<button type="button" class="btn btn-success" onclick="streetViewNoti(<? echo $coUser['UserData']['latitud'].",".$coUser['UserData']['longitud']?>)">
							<span class="glyphicon glyphicon-road">
							</span>
							Ver Dirección en StreetView</button>
						</div>
						<div id="map"></div>
						<div id="panoramadiv"></div>
					</div>
					<!--Fin MD6 --> 
					
				</div>
				<!--Fin Tab GeoData -->
				
				<div class="tab-pane fade" id="Documentos">
					<div class="col-md-12">
						<h3>
							<?php printf('Documentos'); ?>
						</h3>
						<div class="panel panel-danger">
							<div class="panel-heading">
								<div class="update">
									<?				
										echo $this->Html->link('Agregar', array('controller'=>'UserAdjuntos','action' => 'add', $coUser['CoUser']['id']),array('class' => 'btn btn-danger glyphicon glyphicon-plus'));
								    ?>
								</div>
								<h3 class="panel-title">
									Documentos
								</h3>
							</div>
							<div class="panel-body">
								<div class="dataTable">
									<table cellpadding="0" cellspacing="0" border="0" id="table" width="100%" class="tinytable">
										<thead>
											<tr>
												<th>ID</th>
												<th>Tipo</th>
												<th>Documento</th>
												<th>Tipo</th>
												<th>Tamaño</th>
												<th>Creado</th>
												<th class="actions">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?
											//Para evitar el intentar imprimir variables que no existen..
											 if($coUser['UserAdjunto']!=NULL)
											 {		
												for($i=0;$i<count($coUser['UserAdjunto']);$i++)
													{					
														$tamaño=$coUser['UserAdjunto'][$i]['UserAdjunto']['size']/1024;
														?>
														<tr>
															<td><?php echo h($coUser['UserAdjunto'][$i]['UserAdjunto']['id']); ?></td>
															<td><?php echo $coUser['UserAdjunto'][$i]['TipoAdjunto']['tipo'];?></td>
															<td><span class="glyphicon glyphicon-download-alt"></span>
																<?php 
																echo '<a href="'.$this->webroot.'usuarios/'.$coUser['UserAdjunto'][$i]['UserAdjunto']['co_user_id'].'/'.$coUser['UserAdjunto'][$i]['UserAdjunto']['documento'].'">'.$coUser['UserAdjunto'][$i]['UserAdjunto']['documento']."</a>";
																?></td>
															<td><?php echo $coUser['UserAdjunto'][$i]['UserAdjunto']['tipo']; ?></td>
															<td><?php echo round($tamaño,2)." KB"; ?></td>
															<td><?php echo h($coUser['UserAdjunto'][$i]['UserAdjunto']['created']); ?></td>
															<td>
																<div class='botones'>
																	<div class='btn-group'> <?php echo $this->Html->link('', array('controller' => 'UserAdjuntos','action' => 'view', $coUser['UserAdjunto'][$i]['UserAdjunto']['id']),array('class'=>'btn btn-default glyphicon glyphicon-eye-open')); ?> <?php echo $this->Html->link('', array('controller' => 'UserAdjuntos','action' => 'edit', $coUser['UserAdjunto'][$i]['UserAdjunto']['id']),array('class'=>'btn btn-default glyphicon glyphicon-edit')); ?> <?php echo $this->Form->postLink('', array('controller' => 'UserAdjuntos','action' => 'delete',$coUser['UserAdjunto'][$i]['UserAdjunto']['id']), array('class'=>'btn btn-default glyphicon glyphicon-remove'), __('Realmente desea eliminar el registro con Id %s?', $coUser['UserAdjunto'][$i]['UserAdjunto']['id'])); ?> </div>
																</div>
															</td>
														</tr>
														<?					
													}		//Fin del For
											  }//Fin del If
											?>
										</tbody>
									</table>
								</div>
								<!--Fin dataTable --> 
							</div>
							<!--Fin panel-body (Panel content) --> 
						</div>
						<!--Fin panel panel-warning Documentos --> 
						
					</div>
					<!--Fin MD12 --> 
					
				</div>
				<!--Fin Tab Documentos -->
				
				<div class="tab-pane fade" id="Prestamos">
					<div class="col-md-12">
						<h1>
							Prestamos
						</h1>
						<?php echo $this->Html->link('Prestamo', array('controller' => 'Prestamos','action' => 'add',$coUser['CoUser']['id']),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>
						<div class="dataTable">
							<table cellpadding="0" cellspacing="0" border="0" id="table" width="100%" class="tinytable">
								<thead>
									<tr>
										<th class="nosort"><h3>ID</h3></th>
										<th><h3>Meses</h3></th>
										<th><h3>Creedito</h3></th>
										<th><h3>Estado</h3></th>
										<th><h3>Medio de Pago</h3></th>
										<!--<th><h3># Pagos</h3></th>-->
										<th><h3>Creado</h3></th>
										<th><h3>Formatos</h3></th>
									</tr>
								</thead>
								<tbody>
									<?
									if (isset($coUser['Prestamo']))
									{
										for($i=0;$i<count($coUser['Prestamo']);$i++)
										{
											$pestado=$coUser['Prestamo'][$i]['PrestamoEstado']['estado'];
											$pestado_id=$coUser['Prestamo'][$i]['PrestamoEstado']['id'];
												
											echo '				
											<tr>
											<td>'.$coUser['Prestamo'][$i]['Prestamo']['id'].'</td>
											<td>'.$coUser['Prestamo'][$i]['Prestamo']['plazo'].'</td>
											<td>'.$coUser['Prestamo'][$i]['Prestamo']['cantidad'].'</td>
											<td>'.$pestado.'</td>
											<td>'.$coUser['Prestamo'][$i]['CatsofimTipopago']['instrumento'].'</td>

											<td>'.$coUser['Prestamo'][$i]['Prestamo']['created'].'</td>';
											  ///************ACCIONES
													echo '<td align="center">';
													//Acción ver Prestamo									
													echo '<a target="_blank" href="../../Prestamos/view/'.$coUser['Prestamo'][$i]['Prestamo']['id'].'" title="Ver Prestamo"><img src="'.$this->webroot.'img/'.'prestamo.png" width="32" height="32"></a>';
													
													//Acción Listar Pagos
													if($pestado_id==2 or $pestado_id==4  or $pestado_id==5 or $pestado_id==6)
													{
														echo '<a target="_blank" href="../../Pagos/index/'.$coUser['Prestamo'][$i]['Prestamo']['id'].'" title="Listado de Pagos"><img src="'.$this->webroot.'img/'.'list.png" width="32" height="32"></a>';
													}
													else
													{
														echo '<img src="'.$this->webroot.'img/'.'list_inhabilitado.png" width="32" height="32">';
													}					
													//Acción Generar Documentación de Prestamo									
													if($pestado_id==2 or $pestado_id==4  or $pestado_id==5 or $pestado_id==6)
													{
														echo '<a target="_blank"href="../../Prestamos/estadoCuenta/'.$coUser['Prestamo'][$i]['Prestamo']['id'].'" title="Estado de Cuenta"><img src="'.$this->webroot.'img/'.'word.png" width="32" height="32"></a>';
													}
													else
													{
														echo '<img src="'.$this->webroot.'img/'.'word_inhabilitado.png" width="32" height="32">';
													}
												echo '</td>';	
											 //************Fin de Acciones
											echo '</tr>';	
										}		
									}
									?>
								</tbody>
							</table>
						</div>
						<!--Fin DataTable -->
						
						<h1>
							Servicios
						</h1>
						<?php echo $this->Html->link('Servicio', array('controller' => 'Servicios','action' => 'add',$coUser['CoUser']['id']),array('class'=>'btn btn-primary glyphicon glyphicon-plus')); ?>
						<table cellpadding="0" cellspacing="0" border="0" id="table2" width="100%" class="tinytable">
							<thead>
								<tr>
									<th><h3>ID</h3></th>
									<th><h3># Solicitud</h3></th>
									<th><h3>Costos</h3></th>
									<th><h3>Estado</h3></th>
									<th><h3>Monto</h3></th>
									<th><h3>RFC</h3></th>
									<th><h3>Abogado</h3></th>
									<th><h3>Creado</h3></th>
									<th class="actions">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?
									if (isset($coUser['Servicio']))
									{
								
										for($i=0;$i<count($coUser['Servicio']);$i++)
										{
												?>
														<tr>
															<td><?php echo h($coUser['Servicio'][$i]['Servicio']['id']); ?></td>
															<td><?php echo h($coUser['Servicio'][$i]['Servicio']['num_solicitud']); ?></td>
															<td><?php echo h($coUser['Servicio'][$i]['Servicio']['costo_servicio']); ?></td>
															<td><?php echo $this->Html->link($coUser['Servicio'][$i]['ServicioEstado']['estado'], array('controller' => 'servicio_estados', 'action' => 'view', $coUser['Servicio'][$i]['ServicioEstado']['id'])); ?></td>
															<td><?php echo h($coUser['Servicio'][$i]['Servicio']['monto_credito']); ?></td>
															<td><?php echo h($coUser['Servicio'][$i]['Servicio']['RFC_acreditado']); ?></td>
															<td><?php echo h($coUser['Servicio'][$i]['Servicio']['abogado']); ?></td>
															<td><?php echo h($coUser['Servicio'][$i]['Servicio']['created']); ?></td>
															<td><div class='btn-group'> 
															<?php echo $this->Html->link('Ver', array('controller' => 'Servicios','action' => 'view', $coUser['Servicio'][$i]['Servicio']['id']),array('class'=>'btn btn-default')); ?> 
															<?php echo $this->Html->link('Editar', array('controller' => 'Servicios','action' => 'edit', $coUser['Servicio'][$i]['Servicio']['id']),array('class'=>'btn btn-default')); ?> 
															<?php echo $this->Form->postLink('Eliminar', array('controller' => 'Servicios','action' => 'delete', $coUser['Servicio'][$i]['Servicio']['id']), array('class'=>'btn btn-default'), __('Realmente desea eliminar el registro con Id %s?', $coUser['Servicio'][$i]['Servicio']['id'])); ?> </div></td>
														</tr>
																
												<? 
										} 
									}
								?>
							</tbody>
						</table>
					</div>
					<!--Fin MD8 --> 
				</div>
				<!--Fin Tab Prestamos -->
				
				<?php 
				   //Si es diferente de Clientes y Dae
				   if($coUser['CoGroup']['id']!=3 and $coUser['CoGroup']['id']!=7)
				   {
			    ?>
						<div class="tab-pane fade" id="Empleado">
							<div class="col-md-12">
								<h1>
									Información del Empleado
								</h1>
								<div class="update">
									<? 
										 if($coUser['UserEmpleado']['id']==NULL)
										 {
											echo $this->Html->link('Agregar', array('controller'=>'UserEmpleados','action' => 'add', $coUser['CoUser']['id']),array('class' => 'btn btn-danger glyphicon glyphicon-plus'));
										 }
										 else
										 {
											echo $this->Html->link('Editar', array('controller'=>'UserEmpleados','action' => 'edit', $coUser['UserEmpleado']['id']),array('class' => 'btn btn-success glyphicon glyphicon-edit'));
										 }
									 ?>
						</div>
							  <?
							  if($coUser['UserEmpleado']['id']!=NULL)
							   {
							  ?>
											<dl class="dl-horizontal">
												<dt><?php echo __('Id'); ?></dt>
												<dd> <?php echo h($coUser['UserEmpleado']['id']); ?> </dd>
												<dt><?php echo __('Departamento'); ?></dt>
												<dd> <?php echo $this->Html->link($coUser['UserEmpleado']['Departamento']['departamento'], array('controller' => 'departamentos', 'action' => 'view', $coUser['UserEmpleado']['Departamento']['id'])); ?> </dd>
												<dt><?php echo __('Co User'); ?></dt>
												<dd> <?php echo $this->Html->link($coUser['UserEmpleado']['CoUser']['nombre_completo'], array('controller' => 'co_users', 'action' => 'view', $coUser['UserEmpleado']['CoUser']['id'])); ?> </dd>
												<dt><?php echo __('Puesto'); ?></dt>
												<dd> <?php echo $this->Html->link($coUser['UserEmpleado']['Puesto']['puesto'], array('controller' => 'puestos', 'action' => 'view', $coUser['UserEmpleado']['Puesto']['id'])); ?> </dd>
												<dt><?php echo __('Horario'); ?></dt>
												<dd> <?php echo $this->Html->link($coUser['UserEmpleado']['Horario']['id'], array('controller' => 'horarios', 'action' => 'view', $coUser['UserEmpleado']['Horario']['id'])); ?> </dd>
												<dt><?php echo __('Seguro Social'); ?></dt>
												<dd> <?php echo h($coUser['UserEmpleado']['seguro_social']); ?> </dd>
												<dt><?php echo __('ExtTel'); ?></dt>
												<dd> <?php echo h($coUser['UserEmpleado']['extTel']); ?> </dd>
												<dt><?php echo __('Created'); ?></dt>
												<dd> <?php echo h($coUser['UserEmpleado']['created']); ?> </dd>
												<dt><?php echo __('Modified'); ?></dt>
												<dd> <?php echo h($coUser['UserEmpleado']['modified']); ?> </dd>
											</dl>
			  				 <?
								}//Fin del if  if($coUser['UserEmpleado']['id']!=NULL)
							?>
					</div>
					<!--Fin MD12 --> 
				</div>
				
				<!--Fin Tab Empleado -->
			<?php
			   }
		   ?>
			</div>
			<!--Tab Contents--> 
			
		</div>
		<!--Fin M12 Tabs--> 
		
	</div >
	<!-- Fin Primer row--> 
	
</div >
<!-- Fin Col-md-10-->

<?
    // load the necessary scripts
	echo $this->Html->script("http://maps.google.com/maps/api/js?sensor=true", false); 
    echo $this->Html->script('geoloc/google_map_helper.js',false); //Funciones JS del GooglemapHelper 
	echo $this->Html->script('geoloc/funciones_generales.js',false); //Funciones JS del GooglemapHelper
	echo $this->Html->script('highcharts.js',false); //www.higcharts.com Graficas
	echo $this->Html->script('bootstrap-fileinput.js',false); 
?>


<script type="text/javascript">

	ruta_trazada=false;
	//Hack para mapas dentro de tabs en Google Maps no realizamos el trazado ni el desplegado hasta hacer clic en la pestaña.
	$('a[href="#GeoData"]').on('shown.bs.tab', function (e) 
	{
	  //alert(e.target.hash); // activated tab
	  if(ruta_trazada==false)
	  {
			ruta_trazada=true;
			initialize();
			google.maps.event.trigger(map, 'resize');
			trazar_ruta(<? echo $coUser['UserData']['latitud'].",".$coUser['UserData']['longitud'] ?>);		
			streetViewNoti(<? echo $coUser['UserData']['latitud'].",".$coUser['UserData']['longitud']?>);
	  }
	})
	
	//http://ck.kennt-wayne.de/2012/dec/twitter-bootstrap-how-to-fix-tabs
	$(document).ready(function()
	 {
		//Redirecciona al tab, usando un prefijo al cargar por primera vez, al usar redirect en cake #_Pagos	
		/*
		var hash = document.location.hash;
		var prefix = "_";
		if (hash) 
		{
			$('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
		} 
		*/
	
		//Redirecciona al tab, usando #Pagos
		/* Automagically jump on good tab based on anchor; for page reloads or links */
		 if(location.hash) 
		  {
			 $('a[href=' + location.hash + ']').tab('show');		 
		  }
	
	
		//Para evitar el bajar al nivel del tab, (al mostrarse el tab subimos)
		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) 
		{
			location.hash = $(e.target).attr('href').substr(1);
			scrollTo(0,0);		
			//Creamos una cookie con el anchor, para que desde cakephp usemos al redireccionar
			//funciones_propias.js
			create_cookie('anchor', location.hash, 1, '/');		
		});
	
		//Actualiza el URL con el anchor o ancla del tab al darle clic
		 /* Update hash based on tab, basically restores browser default behavior to
		 fix bootstrap tabs */
		$(document.body).on("click", "a[data-toggle]", function(event) 
		  {
			location.hash = this.getAttribute("href");
		  });
	
		  
		//Redirecciona al tab, al usar los botones de regresar y avanzar del navegador.
		/* on history back activate the tab of the location hash if exists or the default tab if no hash exists */   
		$(window).on('popstate', function() 
		{
		  //Si se accesa al menu, se regresa al tab del perfil (activo default), fixed conflict with menu
		  //var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
		  var anchor = location.hash;
		  $('a[href=' + anchor + ']').tab('show');
	
		});	  
	
	});//Fin OnReady
</script>
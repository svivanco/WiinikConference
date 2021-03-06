<?php
App::uses('AppController', 'Controller');
App::uses('Barcode', 'Lib');
/**
 * CoUsers Controller
 *
 * @property CoUser $CoUser
 * @property PaginatorComponent $Paginator
 */
class CoUsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','RequestHandler');
	public $rutaUpload='usuarios/';
	//Salt usado en el mecanismo de encryptaci�n de cookies
	public $encryption_key="!@#$%^&*";

	
    var $helpers = array('Ajax');


    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->LdapAuth->allow('access');
        $this->LdapAuth->allow('code_verification');
        $this->LdapAuth->allow('registro');
        $this->LdapAuth->allow('lock');
        $title_for_layout = 'Usuarios';
        $this->set(compact('title_for_layout'));
    }

/**
 * index method
 *
 * @return void
 */
	public function index() 
	{
		if(isset($this->params['url']['search_text']))
		{
			$search=$this->params['url']['search_text'];
			$this->paginate = array(
			'conditions'=>array('or' => array(
			'CoUser.nombre LIKE' => '%'. $search. '%',
			'CoUser.paterno LIKE' => '%'. $search. '%',		
			'CoUser.materno LIKE' => '%'. $search. '%',
			'CoUser.login LIKE' => '%'. $search. '%',
			'CoUser.email LIKE' => '%'. $search. '%',
			'CoUser.co_group_id LIKE' => '%'. $search. '%',
			'CoUser.id LIKE' => '%'. $search. '%'))	);
			
			$coUsers=$this->paginate();
			$this->set(compact('coUsers'));
			//$this->set('CoMenus', $this->paginate());		
		}
		else
		{		
		$this->CoUser->recursive = 0;
			$this->Paginator->settings['order'] = 'CoUser.id DESC';
			$coUsers=$this->paginate();
			$this->set(compact('coUsers'));
		}
		//$this->CoUser->recursive = 0;		
		//$this->set('coUsers', $this->Paginator->paginate());
	}



	public function participantes() 
	{


		$this->CoUser->recursive =1;
		
		
		if(isset($this->params['url']['search_text']))
		{
			$search=$this->params['url']['search_text'];
			$this->paginate = array('conditions'=>array('CoUser.co_group_id' => 2));			
			$this->paginate = array(
			'conditions'=>array('or' => array(
			'CoUser.nombre LIKE' => '%'. $search. '%',
			'CoUser.paterno LIKE' => '%'. $search. '%',		
			'CoUser.materno LIKE' => '%'. $search. '%',
			'CoUser.login LIKE' => '%'. $search. '%',
			'CoUser.email LIKE' => '%'. $search. '%',
			'CoUser.id LIKE' => '%'. $search. '%'))	);
			
			$coUsers=$this->paginate();
			$this->set(compact('coUsers', 'PrestamoEstados','PrestamoCSS','pendientes','pendientesj'));
		}
		else
		{		

			//Listamos s�lo los usuarios del Grupo Participantes
			$this->paginate = array('conditions'=>array('CoUser.co_group_id' => 2));			

			$coUsers=$this->Paginator->paginate();
			$this->set(compact('coUsers', 'PrestamoEstados','PrestamoCSS','pendientes','pendientesj','pagosj'));

		}
		
	}	



/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) 
	{
		$this->CoUser->recursive = 1;		
		if (!$this->CoUser->exists($id)) 
		{
			throw new NotFoundException(__('Id invalido para el registro'));
		}
		$options = array('conditions' => array('CoUser.' . $this->CoUser->primaryKey => $id));
		$this->set('coUser', $this->CoUser->find('first', $options));
	}
	

	public function miperfil($id = null) 
	{
		$usuario=$this->Session->read('Auth.User.id');
		
		$this->CoUser->recursive = 1;		
		if (!$this->CoUser->exists($usuario)) 
		{
			throw new NotFoundException(__('Id invalido para el registro'));
		}
		
		$options = array('conditions' => array('CoUser.id' => $usuario));
		$this->set('coUser', $this->CoUser->find('first', $options));
	}

	
	
	
/**
 * confirmacion method
 *
 * Muestra la hoja de confirmaci�n de registro
 * en la cual se enlista la informaci�n del usuario para su impresi�n
 * @return void
 */
	
	public function Confirmacion($id = null) 
	{
		$this->CoUser->recursive = 1;		
		if (!$this->CoUser->exists($id)) 
		{
			throw new NotFoundException(__('Id invalido para el registro'));
		}
		$options = array('conditions' => array('CoUser.' . $this->CoUser->primaryKey => $id));
		$coUser=$this->CoUser->find('first', $options);
		$aeropuertos = $this->CoUser->UserAereo->Aeropuerto->find('list');
		$this->set(compact('coUser','aeropuertos'));
	}	
	
	
/**
 * confirmacion de asistencia 
 *
 * Recibe como parametro el id del usuario, enviado previamente mediante el lector de c�digo de barras
 * actualizando el campo asistio, en la tabla del usuario
 * @return void
 */
	
	public function Asistencia($id = null) 
	{
			$this->CoUser->recursive = 1;		
			//Recibimos el ID del usuario
			$usuario_id=$this->params['pass'][0];

		
			if ($this->request->is('post')) 
				{
					
					$usuario_id=$this->request->data['Buscador']['usuario'];
					//Verificamos exista el usuario
					if (!$this->CoUser->exists($usuario_id)) 
					{
						$this->Session->setFlash(__('Id de usuario invalido para el registro'));
						return $this->redirect(array('action' => 'asistencia',$usuario_id));
					}
					$this->CoUser->id=$usuario_id;
					$this->CoUser->saveField("asistio",true);
					
					$this->Session->setFlash(__('Asistencia confirmada'));
					return $this->redirect(array('action' => 'asistencia',$usuario_id));
				} 
		
		$options = array('conditions' => array('CoUser.id'=> $usuario_id));
		$this->set('coUser', $this->CoUser->find('first', $options));

	}	
	
	

/**
 * add method
 *
 * @return void
 */
	public function add() 
	{
		
		//Recibimos el ID del evento
		$evento_id=$this->params['pass'][0];
		
		//Validamos se reciva el ID del evento
		if(!isset($evento_id))
		throw new NotFoundException(__('Se requiere un ID de Evento'));
			
			if ($this->request->is('post')) 
			{
				$this->CoUser->create();
				if ($this->CoUser->save($this->request->data)) 
				{
						$this->Session->setFlash(__('El usuario ha sido guardado.'));
						//Obtenemos el ID recien creado y redirigimos a la captura de datos complementarios
						$newUserId = $this->CoUser->id;
						$this->check_folder($newUserId);
						$this->make_codebar($newUserId);
						//return 	$this->redirect($this->origReferer());			
						$this->Session->setFlash(__('The co user ha sido guardado.'));
						return $this->redirect(array('action' => 'index'));
					} 
					else 
					{
						$this->Session->setFlash(__('The co user no pudo ser guardado. Porfavor intente de nuevo..'));
					}
			}
			
			$options = array('conditions'=>array('Evento.id' => $evento_id));		
			$evento= $this->CoUser->Evento->find('first',$options);
			
			$eventos = $this->CoUser->Evento->find('list');
			$coGroups = $this->CoUser->CoGroup->find('list');
			$titulos = $this->CoUser->Titulo->find('list');
			
			$cargos = $this->CoUser->Cargo->find('list');
			$medios = $this->CoUser->Medio->find('list');
			$hoteles = $this->CoUser->Hotele->find('list');
			$entidades = $this->CoUser->Entidade->find('list');
			$municipios = $this->CoUser->Municipio->find('list');
			$this->set(compact('eventos', 'coGroups', 'titulos', 'cargos', 'medios', 'hoteles', 'entidades', 'municipios','evento'));
	}
	
	
		
	public function code_verification()
    {
        $this->layout = 'lock';
		
		//Recibimos el ID del evento
		$evento_id=$this->params['pass'][0];
		
		//Validamos se reciva el ID del evento
		if(!isset($evento_id))
		throw new NotFoundException(__('Se requiere un ID de Evento'));
		
		$options = array('conditions'=>array('Evento.id' => $evento_id));					
		$evento= $this->CoUser->Evento->find('first',$options);
		
        if($this->request->is('post'))
        {
			$evento_id=$this->request->data['CoUser']['evento'];
			$options = array('conditions'=>array('Evento.id' => $evento_id));					
			$evento= $this->CoUser->Evento->find('first',$options);

			$codigo_invitacion=	$this->request->data['CoUser']['code'];
			if ($evento['Evento']['codigo']==$codigo_invitacion)
			{
				$this->Session->write('codigo_verificado',true);
				return $this->redirect(array('action' => 'registro',$evento_id));
			}
			else
				$this->Session->setFlash(__('El ID de evento no coincide.'));
        }//Fin If post data

		$this->set(compact('evento'));

    }	
	
/**
 * add method
 *
 * @return void
 */
	public function registro() 
	{
		
		//Recibimos el ID del evento
		$evento_id=$this->params['pass'][0];
		
		
		//Validamos se reciva el ID del evento
		if(!isset($evento_id))
		throw new NotFoundException(__('Se requiere un ID de Evento'));

		$options = array('conditions'=>array('Evento.id' => $evento_id));					
		$evento= $this->CoUser->Evento->find('first',$options);

		//Verificamos si se requiere c�digo de invitaci�n..
		if ($evento['Evento']['requerir_codigo'])
		{
			//Validamos si ya se tiene validado el c�digo mediante la sesion
			$validado=$this->Session->read('codigo_verificado');
			
			//Si no se tiene en sesi�n redirigir..
			if (!$validado)			
				return $this->redirect(array('action' => 'code_verification',$evento_id));
		}
			
			if ($this->request->is('post')) 
			{
				$this->CoUser->create();
				if ($this->CoUser->save($this->request->data)) 
			{
					$this->Session->setFlash(__('El usuario ha sido guardado.'));
					//Obtenemos el ID recien creado y redirigimos a la captura de datos complementarios
					$newUserId = $this->CoUser->id;
					$this->check_folder($newUserId);
					$this->make_codebar($newUserId);
					
				
					//Si el evento tiene configurado solicitar datos de transportacion..
					//redirigir a los datos complementarios del medio
					if ($evento['Evento']['datos_transportacion'])
					{
						switch($this->request->data['CoUser']['medio_id'])
						{
							//Aereo
							case 1:
								return $this->redirect(array('controller'=>'UserAereos','action' => 'add',$newUserId));
							break;
							
							//Terrestre
							case 2:
								return $this->redirect(array('controller'=>'UserTerrestres','action' => 'add',$newUserId));
							break;
							
							//Maritimo
							case 3:
								return $this->redirect(array('controller'=>'UserMaritimos','action' => 'add',$newUserId));
							break;
							
							default:
								return $this->redirect(array('action' => 'Confirmacion',$newUserId));
						}		
					}
	
					$this->Session->setFlash(__('The co user ha sido guardado.'));
					return $this->redirect(array('action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash(__('The co user no pudo ser guardado. Porfavor intente de nuevo..'));
				}
			}

			$eventos = $this->CoUser->Evento->find('list',$options);

			$options = array('conditions'=>array('CoGroup.id' => 2));					
			$coGroups = $this->CoUser->CoGroup->find('list',$options);
			$titulos = $this->CoUser->Titulo->find('list');
			
			$options = array('conditions'=>array('Cargo.habilitado' => 1));								
			$cargos = $this->CoUser->Cargo->find('list',$options);
			
			//verificamos este h�bilitado el medio
			$options = array('conditions'=>array('Medio.habilitado' => 1));								
			$medios = $this->CoUser->Medio->find('list',$options);
			
			$hoteles = $this->CoUser->Hotele->find('list');
			$entidades = $this->CoUser->Entidade->find('list');
			$municipios = $this->CoUser->Municipio->find('list');
			$this->set(compact('eventos', 'coGroups', 'titulos', 'cargos', 'medios', 'hoteles', 'entidades', 'municipios','evento'));
	}	



/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CoUser->exists($id)) {
			throw new NotFoundException(__('Invalid co user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CoUser->save($this->request->data)) {
				$this->make_codebar($this->request->data['CoUser']['id']);
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Registro actualizado.','default',array('class'=>'alert alert-success'));
				return 	$this->redirect($this->origReferer());

				$this->Session->setFlash(__('The co user ha sido guardado.'));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The co user no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('CoUser.' . $this->CoUser->primaryKey => $id));
			$this->request->data = $this->CoUser->find('first', $options);
            unset($this->request->data['CoUser']['password']);
		}
		$eventos = $this->CoUser->Evento->find('list');
		$coGroups = $this->CoUser->CoGroup->find('list');
		$titulos = $this->CoUser->Titulo->find('list');
		$cargos = $this->CoUser->Cargo->find('list');
		$medios = $this->CoUser->Medio->find('list');
		$hoteles = $this->CoUser->Hotele->find('list');
		$entidades = $this->CoUser->Entidade->find('list');
		$municipios = $this->CoUser->Municipio->find('list');
		//Al entrar a la vista de edici�n capturamos el URL desde donde se proviene, al realizar el guardado, redirigimos desde donde se provino.
		$this->setReferer();

		$this->set(compact('eventos', 'coGroups', 'titulos', 'cargos', 'medios', 'hoteles', 'entidades', 'municipios'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CoUser->id = $id;
		if (!$this->CoUser->exists()) {
			throw new NotFoundException(__('Invalid co user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CoUser->delete()) {
			$this->Session->setFlash(__('The co user ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The co user no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}
    
	
	//Funci�n principal de logueo	
    public function login()
    {
        $this->layout = 'login';
        if($this->request->is('post'))
        {
            if($this->LdapAuth->login())
            {
				//Al iniciar sesi�n correctamente, obtenemos toda la informaci�n del usuario en la sesion
				$usuario=$this->Session->read('Auth.User');
                $this->CoUser->id =$usuario['id'];
                $this->CoUser->saveField('ultimo_acceso',date('Y-m-d H:i:s'));
				
				//Si el usuario es de tipo empleado, creamos la cookie de usuario por 1 hora
				$timecookie=60*60*3;
				$dataUser=$usuario['login'].",".$usuario['nombre'].",".$usuario['id'];
				$cryptDataUser=$this->encrypt($dataUser,$this->encryption_key);
				setcookie('empleado',$cryptDataUser ,time() + $timecookie, "/");

				//Si el usuario es diferente de clientes, (verificamos para empleados y trabajadores)
				if($usuario['CoGroup']['id']!=3)
				{
						//$url_referida=$this->Session->read('Auth.redirect');
						//Si existe url de referer, (sesi�n caducada) redirigir a donde estaba al volver a loguearse
						
						//Al manejar pantalla de lock, ahora el login redirige a la p�gina del grupo y no al �ltimo referer..
						//if(empty($url_referida))				
							$pagina_inicio=$usuario['CoGroup']['pagina_inicio'];
				}
				
				$this->redirect($pagina_inicio);
            }
            else
            {
                //Si la validacion de credenciales no fue correcta enviamos un mensaje de error
                $this->LdapAuth->flash("Nombre de usuario o contrase&ntilde;a incorrectos");
                //Borrar el password enviado para que no lo regrese a la vista
                unset($this->request->data['CoUser']['password']);
            }
        }
        else
        {
		
			//si existe cookie de empleado, redirigimos a lock
			if (isset($_COOKIE["empleado"]))
                 $this->redirect('/CoUsers/lock');
		   
            if($this->LdapAuth->loggedIn())
            {
                $this->redirect('/');
            }
			
	
        }
		
    }
    
	
	public function lock()
    {
        $this->layout = 'lock';
		/*
		$stringLocale=Configure::read('Strings');        
		$this->set(compact('stringLocale'));		   
		*/
		
        if($this->request->is('post'))
        {
            if($this->LdapAuth->login())
            {
				//Al iniciar sesi�n correctamente, obtenemos toda la informaci�n del usuario en la sesion
				$usuario=$this->Session->read('Auth.User');
                $this->CoUser->id =$usuario['id'];
                $this->CoUser->saveField('ultimo_acceso',date('Y-m-d H:i:s'));
				
				//Si el usuario es de tipo empleado, creamos la cookie de usuario por 1 hora, concatenando la informaci�n y encriptandola
				$timecookie=60*60*3;
				$dataUser=$usuario['login'].",".$usuario['nombre'].",".$usuario['id'];
				$cryptDataUser=$this->encrypt($dataUser,$this->encryption_key);
				setcookie('empleado',$cryptDataUser ,time() + $timecookie, "/");
				
				
				//Si el usuario es diferente de clientes, (verificamos para empleados y trabajadores)
				if($usuario['CoGroup']['id']!=3)
				{
						$url_referida=$this->Session->read('Auth.redirect');
						//Si existe url de referer, (sesi�n caducada) redirigir a donde estaba al volver a loguearse
						
						if(empty($url_referida))				
							$pagina_inicio=$usuario['CoGroup']['pagina_inicio'];
						else							
							$pagina_inicio=$url_referida;
				}
				$this->redirect($pagina_inicio);
            }
            else
            {
                //Si la validacion de credenciales no fue correcta enviamos un mensaje de error
                $this->LdapAuth->flash("Nombre de usuario o contrase&ntilde;a incorrectos");
                //Borrar el password enviado para que no lo regrese a la vista
                unset($this->request->data['CoUser']['password']);
            }
        }//Fin If post data

		//Limpiamos el password, por si lo recuerda
        unset($this->request->data['CoUser']['password']);
		
		$decrypdata=$this->decrypt($_COOKIE["empleado"],$this->encryption_key);
		$decrypdata=explode(",",$decrypdata);

		$userData['name']=trim($decrypdata[1]);
		$userData['username']=trim($decrypdata[0]);
		$userData['id']=trim($decrypdata[2]);		
	
		$this->set(compact('userData'));
    }
	

	
	
	
    
    public function logout()
    {
        $this->Session->destroy();
        $this->redirect(array('action'=>'login'));
    }
    
    /**
    * Funcion para cambio de contrase�a
    * 
    */
    function cambio_contrasena()
    {
        //Si recibimos la peticion mediante el metodo POST
        if($this->request->is('post'))
        {
            //Establecemos la recursividad en -1 para que la consulta unicamente nos devuelva datos de la tabla app_usuarios
            $this->CoUser->recursive = -1;
            //Recuperamos el Id almacenado en la variable de sesion
            $AppUsuarioId = $this->Session->read('Auth.User.id');
            //Consultamos unicamente el password del usuario, buscandolo por su Id
            $InformacionUsuario = $this->CoUser->findById($AppUsuarioId,array('fields'=>'CoUser.password'));
            
            //Establecemos el valor de la contrase�a actual
            $ContrasenaActual = $InformacionUsuario['CoUser']['password'];
            //Encriptamos la contrase�a que el usuario esta indicado que es la actual
            $ContrasenaActualFormulario = $this->LdapAuth->password($this->request->data['CoUser']['password_actual']);
            
            //Recuperamos la nueva contrase�a con su confirmacion
            $ContrasenaNueva = $this->request->data['CoUser']['password'];
            $ContrasenaRepetida = $this->request->data['CoUser']['password_repit'];
            
            //Si la contrase�a que el usuario indico que es la actual coincide con la actual registrado en la base de datos
            if($ContrasenaActualFormulario == $ContrasenaActual)
            {
                //Si la contrase�a nueva fue confirmada adecuadamente
                if($ContrasenaNueva == $ContrasenaRepetida)
                {
                    //Agregamos el campo id al arreglo data para que la actualizacion sea en automatico
                    $this->request->data['CoUser']['id'] = $AppUsuarioId;
                    //Ejecutamos la actualizacion y si fue correcta y lo siguiente establece los mensajes dependiendo de cada caso
                    if($this->CoUser->save($this->request->data))
                    {
                        $this->Session->setFlash('<b>La contrase&ntilde;a fue cambiada correctamente</b>','default',array('class'=>'alert alert-success'));
                    }
                    else
                    {
                        $this->Session->setFlash('<b>La contrase&ntilde;a no fue cambiada</b>','default',array('class'=>'alert alert-danger'));
                    }
                }
                else
                {
                    $this->Session->setFlash('<b>La confirmacion de la nueva contrase&ntilde;a es incorrecta</b>','default',array('class'=>'alert alert-danger'));
                }
            }
            else
            {
                $this->Session->setFlash('<b>La contrase&ntilde;a actual es incorrecta</b>','default',array('class'=>'alert alert-danger'));
            } 
            //Siempre redireccionaremos a la misma pagina del cambio de contrase�a
            $this->redirect(array('action'=>'cambio_contrasena'));
        }
    }
    
    /**
    * Buscar usuario dentro del directorio activo, por medio de su login.
    * Esta funcion es utilizada por medio de Ajax
    * 
    */
    function buscar_ldap()
    {
        //Seteamos el layout de la vista
        $this->layout = 'ajax';
        //Recuperamos el login de la peticion recibida por medio de Ajax
        $login = $this->request->query['Login'];
        //Por medio del login recuperado, ejecutamos la busqueda del usuario por medio del componente LdapAuth
        $usuario = $this->LdapAuth->buscarUsuario($login);
        //Se envia la variable usuario a la vista.
        $this->set(compact('usuario'));
    }
	
    ####################################################
    #                                                  #
    #        FUNCION JSON PARA MOVILES                 #
    #                                                  #
    ####################################################
    
    public function access()
    {
        $success = false;
        $coUser = array();
        if(isset($this->request->query['login']) && isset($this->request->query['password']))
        {
            $this->request->data['CoUser']['login'] = $this->request->query['login'];
            $this->request->data['CoUser']['password'] = $this->request->query['password'];
            if($this->LdapAuth->login())
            {
                $success = true;
                $coUser = $this->CoUser->findByLogin($this->request->query['login'],'CoUser.id,CoUser.login,CoUser.nombre,CoUser.paterno,CoUser.materno');
            }
        }
        $this->Session->destroy();
        $this->set(compact('success','coUser'));
        $this->set('_serialize',array('success','coUser'));
        $this->set('_jsonp',true);
    }
		   /**
 * mkdir method
 * verifica la existencia del directorio del usuario, en caso de no existir, crea la carpeta
 */
	
	function check_folder($usuario_id)
	{
		$directorio=$this->rutaUpload.$usuario_id."/";

		if (is_dir($directorio)) 
		{ 
			//echo "El directorio existe¡";
		}
		else
		{
			if(!mkdir($directorio, 0777, true))
			{
				echo ('No se pudo crear la carpeta ('.$directorio.'). Verifique que tenga permisos de escritura en '.$rutaUpload);
			}
	
		}
	}
	
	
/**
 * mkdir method
 * Crea el c�digo de barras del usuario
 */
	function make_codebar($usuario_id)
	{
		//Default filename
		$filename="barcode.png";
		$file =$this->rutaUpload.$usuario_id.'/'.$filename; 
		$barcode=new Barcode();

		if (file_exists($file)) 
		{ 
			//echo "El archivo existe¡";
		}
		else
		{
			$data_to_encode = $usuario_id;                          
			// Generate Barcode data 
			$barcode->barcode(); 
			$barcode->setType('C128'); 
			$barcode->setCode($data_to_encode); 
			$barcode->setSize(80,150); 
			
			// Generates image file on server             
			$barcode->writeBarcodeFile($file); 
		}
	}
			
	


}

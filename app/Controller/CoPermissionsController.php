<?php
App::uses('AppController', 'Controller');
/**
 * CoPermissions Controller
 *
 * @property CoPermission $CoPermission
 * @property PaginatorComponent $Paginator
 */
class CoPermissionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CoPermission->recursive = 0;
		$this->set('coPermissions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CoPermission->exists($id)) {
			throw new NotFoundException('Id invalido para el registro');
		}
		$options = array('conditions' => array('CoPermission.' . $this->CoPermission->primaryKey => $id));
		$this->set('coPermission', $this->CoPermission->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CoPermission->create();
			if ($this->CoPermission->save($this->request->data)) {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Registro guardado.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>El registro no pudo ser guardado.','default',array('clas'=>'alert alert-danger'));
			}
		}
		$coGroups = $this->CoPermission->CoGroup->find('list');
		$this->set(compact('coGroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null)
	 {
		if (!$this->CoPermission->exists($id)) 
		{
			throw new NotFoundException(__('Id invalido para el registro'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CoPermission->save($this->request->data)) {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Registro actualizado.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>El registro no pudo ser actualizado.','default',array('class'=>'alert alert-danger'));
			}
		} else 
		{
			$options = array('conditions' => array('CoPermission.' . $this->CoPermission->primaryKey => $id));
			$this->request->data = $this->CoPermission->find('first', $options);
		}
		$coGroups = $this->CoPermission->CoGroup->find('list');
		$this->set(compact('coGroups'));
	}






/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CoPermission->id = $id;
		if (!$this->CoPermission->exists()) {
			throw new NotFoundException(__('Id invalido para el registro'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CoPermission->delete()) {
			$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Registro eliminado.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>El registro no pudo ser eliminado.','default',array('class'=>'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}


    public function add_from_controller()
    {
        $controllers = $this->__getControllers();
        $this->set(compact('controllers'));
    }
	
	
    
    public function get_actions()
    {
        //Establecer el layout
        $this->layout = 'ajax';
        if(!empty($this->request->data['CoPermission']['controller_id']))
        {
            //Recuperar el nombre del controlador enviado desde el formulario
            $Controlador = $this->request->data['CoPermission']['controller_id'];
            //Establecer el nombre del controlador para la tabla de permisos
            $controllerName = strtolower($Controlador);
            //Importar el controlador
            App::import('Controller',$Controlador);
            //Agregar el posfilo Controller para instanciar la clase
            $Controlador .= 'Controller';
            //Crear la instancia del objeto
            $thisObjeto = new $Controlador;
            //Recuperar los metodos del objeto
            $metodosControllerTmp = $thisObjeto->methods;
            //Ordenarlos
            sort($metodosControllerTmp,SORT_ASC);
            //Acomodar el arreglo para poder eliminar los metodos del appController
            $metodosController['*'] = '*';
            foreach($metodosControllerTmp as $key => $value)
            {
                $metodosController[$value] = $value;
            }
            //Obtener los metodos del AppController
            $metodosAppController = $this->__getAppMethods();
            //Borrarlos de los metodos del controlador solicitado
            foreach($metodosAppController as $key => $value)
            {
                unset($metodosController[$value]);
            }
            //Buscar los permisos que ya han sido registrados en la base de datos
            $permisosRegistrados = $this->CoPermission->find
                                                            (
                                                                'list',
                                                                array
                                                                    (
                                                                        'conditions'=>array
                                                                                        (
                                                                                            'CoPermission.nombre LIKE'=>$controllerName.':%'
                                                                                        ),
                                                                        'fields'=>array
                                                                                        (
                                                                                            'CoPermission.nombre',
                                                                                            'CoPermission.nombre'
                                                                                        )
                                                                    )
                                                            );
            //Generar el arreglo final de los metodos
            $i = 0;
            foreach($metodosController as $key => $value)
            {
                $registrado = (isset($permisosRegistrados[$controllerName.':'.$value]))?true:false;
                $metodos[$i]['nombreAccion'] = $value;
                $metodos[$i]['nombrePermiso'] = $controllerName.':'.$value;
                $metodos[$i]['registrado'] = $registrado;
                $i++;
            }
            //Buscar los grupos
            $coGroups = $this->CoPermission->CoGroup->find('list');
            //Enviar las variables a la vista
            $this->set(compact('metodos','coGroups'));
        }
    }
    
    public function save_permissions()
    {
        if($this->request->is('post'))
        {
            $this->CoPermission->getDataSource()->begin();
            foreach($this->request->data['CoPermission']['permiso'] as $permiso)
            {
                $data['CoPermission']['nombre'] = $permiso;
                $data['CoPermission']['descripcion'] = $permiso;
                $data['CoPermission']['activo'] = 1;
                $data['CoGroup'] = $this->request->data['CoGroup'];
                $this->CoPermission->create();
                if(!$this->CoPermission->save($data))
                {
                    $this->CoPermission->getDataSource()->rollback();
                    $this->Session->setFlash('<strong>Ocurrio un error al guardar los permisos</strong>','default',array('class'=>'alert alert-danger'));
                    $this->redirect(array('action'=>'index'));
                }
            }
            $this->CoPermission->getDataSource()->commit();
            $this->Session->setFlash('</strong>Se guardaron los permisos satisfactoriamente!</strong>','default',array('class'=>'alert alert-success'));
        }
        $this->redirect(array('action'=>'index'));
    }
    
    private function __getAppMethods()
    {
        App::import('Controller','App');
        $thisAppController = new AppController();
        $metodosTmp = $thisAppController->methods;
        $metodos = array();
        foreach($metodosTmp as $key => $value)
        {
            $metodos[$value] = $value;
        }
        return $metodos;
    }
    
    private function __getControllers()
    {
        //Obtener la lista de controladores
        $tmpController = App::objects("Controller");
        //Ordenarlos alfabeticamente
        sort($tmpController,SORT_ASC);
        //Recorrer el arreglo para ajustarlo en el arreglo final
        $controllers = array();
        foreach($tmpController as $key => $value)
        {
			$control=substr($value,0,strpos($value,'Controller'));
            $controllers[$control] = $control;
        }
        //Borrar el indice del AppController
        unset($controllers['App']);
        return $controllers;
    }
    
	
	///*************  PROPIOS
	
	function panel()
	{
		
        $controllers = $this->__getControllers2();

		$options = array('conditions' => array('CoPermission.id'=> 1));
		$permiso=$this->CoPermission->find('first', $options);
		
        $this->set(compact('controllers','permiso'));		
	}
	
	//Devuelve los controles con sus acciones
    private function __getControllers2()
    {
        //Obtener la lista de controladores
        $tmpController = App::objects("Controller");
        //Ordenarlos alfabeticamente
        sort($tmpController,SORT_ASC);
        //Recorrer el arreglo para ajustarlo en el arreglo final
        $controllers = array();
        foreach($tmpController as $key => $value)
        {
			$control=substr($value,0,strpos($value,'Controller'));
            $controllers[$control] = $control;
			//Añadimos sus metodos
            $controllers[$control]=$this->get_actions2($control);
        }
        //Borrar el indice del AppController
        unset($controllers['App']);
        return $controllers;
    }
	
	
	
    public function get_actions2($control)
    {
        if(!empty($control))
        {
            //Recuperar el nombre del controlador enviado desde el formulario
            $Controlador = $control;
            //Establecer el nombre del controlador para la tabla de permisos
            $controllerName = strtolower($Controlador);
            //Importar el controlador
            App::import('Controller',$Controlador);
            //Agregar el posfilo Controller para instanciar la clase
            $Controlador .= 'Controller';
            //Crear la instancia del objeto
            $thisObjeto = new $Controlador;
            //Recuperar los metodos del objeto
            $metodosControllerTmp = $thisObjeto->methods;
            //Ordenarlos
            sort($metodosControllerTmp,SORT_ASC);
            //Acomodar el arreglo para poder eliminar los metodos del appController
            $metodosController['*'] = '*';
            foreach($metodosControllerTmp as $key => $value)
            {
                $metodosController[$value] = $value;
            }
            //Obtener los metodos del AppController, metodos genericos que todos deberian tener acceso
            $metodosAppController = $this->__getAppMethods();
            //Borrarlos de los metodos del controlador solicitado
            foreach($metodosAppController as $key => $value)
            {
                unset($metodosController[$value]);
            }
            //Buscar los permisos que ya han sido registrados en la base de datos
            $permisosRegistrados = $this->CoPermission->find
                                                            (
                                                                'list',
                                                                array
                                                                    (
                                                                        'conditions'=>array
                                                                                        (
                                                                                            'CoPermission.nombre LIKE'=>$controllerName.':%'
                                                                                        ),
                                                                        'fields'=>array
                                                                                        (
                                                                                            'CoPermission.nombre',
                                                                                            'CoPermission.id'
                                                                                        )
                                                                    )
                  
				                                            );
															
            //Generar el arreglo final de los metodos
            $i = 0;
            foreach($metodosController as $key => $value)
            {
                $registrado = (isset($permisosRegistrados[$controllerName.':'.$value]))?true:false;
                $metodos[$i]['nombreAccion'] = $value;
                $metodos[$i]['nombrePermiso'] = $controllerName.':'.$value;
                $metodos[$i]['registrado'] = $registrado;
                $metodos[$i]['id'] = $permisosRegistrados[$controllerName.':'.$value];
                $i++;
            }
			
			return $metodos;
        }
    }	
	
	
	
	public function add_all() 
	{
		//Obtenemos todos los controles
       $controladores = $this->__getControllers();	  

	   $metodos=array();
	   
	    foreach($controladores as $control => $value)
        {

					$metodos2=$this->get_actions2($value);			
					foreach($metodos2 as $metodo => $value)
					{
						$metodos[]=$value;			
					}

        }
		
		
		$this->set(compact('metodos'));		
	}	
	


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit_ajax()
	 {

 		$id=$this->params['url']['id'];			

		if (!$this->CoPermission->exists($id)) 
		{
			throw new NotFoundException(__('Id invalido para el registro'));
		}

		
		$options = array('conditions' => array('CoPermission.id' => $id));
		$this->request->data = $this->CoPermission->find('first', $options);

		$coGroups = $this->CoPermission->CoGroup->find('list');
		$this->set(compact('coGroups'));
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function save_ajax()
	 {
		if ($this->request->is(array('post', 'put'))) 
		{
			
			if ($this->CoPermission->save($this->request->data)) 
			{
				$exito=true;

			} 
			else 
			{
				$exito=false;
			}
			
				$this->set(compact('exito'));			
		}
	 }
	 
	 
	
}//class

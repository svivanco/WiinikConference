<?php
App::uses('AppController', 'Controller');
/**
 * CoGroups Controller
 *
 * @property CoGroup $CoGroup
 * @property PaginatorComponent $Paginator
 */
class CoGroupsController extends AppController {

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
		$this->CoGroup->recursive = 0;
		$this->set('coGroups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CoGroup->exists($id)) {
			throw new NotFoundException('Id invalido para el registro');
		}
		$options = array('conditions' => array('CoGroup.' . $this->CoGroup->primaryKey => $id));
		$this->set('coGroup', $this->CoGroup->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CoGroup->create();
			if ($this->CoGroup->save($this->request->data)) {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Registro guardado.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>El registro no pudo ser guardado.','default',array('clas'=>'alert alert-danger'));
			}
		}

/*		$options = array('conditions' => array('CoMenu.co_menu_id' => NULL));
		$padres=$this->CoGroup->CoMenu->find('list',$options);
		$coMenus = array();
		
		foreach ($padres as $padre_id => $padre)
		{
			$coMenus[$padre_id]="++".$padre;
			
			$options = array('conditions' => array('CoMenu.co_menu_id' => $padre_id));
			$hijos=$this->CoGroup->CoMenu->find('list',$options);
		
			foreach ($hijos as $hijo_id=> $hijo)
			{
				$coMenus[$hijo_id]="  --".$hijo;
			}
			
		}
*/

		
		$options = array('conditions' => array('CoMenu.co_menu_id' => NULL));
		$padres=$this->CoGroup->CoMenu->find('list',$options);
		$coMenus = array();
		
		foreach ($padres as $padre_id => $padre)
		{
			$coMenus[$padre]=array($padre_id => "++".$padre);
			$options = array('conditions' => array('CoMenu.co_menu_id' => $padre_id));
			$coMenus[$padre]+=$this->CoGroup->CoMenu->find('list',$options);
		}
		
		$coPermissions = $this->CoGroup->CoPermission->find('list');
		
		
		$this->set(compact('coMenus', 'coPermissions','padres'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CoGroup->exists($id)) {
			throw new NotFoundException(__('Id invalido para el registro'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CoGroup->save($this->request->data)) {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Registro actualizado.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>El registro no pudo ser actualizado.','default',array('class'=>'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CoGroup.' . $this->CoGroup->primaryKey => $id));
			$this->request->data = $this->CoGroup->find('first', $options);
		}
		
	/*	
		$options = array('conditions' => array('CoMenu.co_menu_id' => NULL));
		$padres=$this->CoGroup->CoMenu->find('list',$options);
		$coMenus = array();
		
		foreach ($padres as $padre_id => $padre)
		{
			$coMenus[$padre]=array($padre_id => "++".$padre);
			$options = array('conditions' => array('CoMenu.co_menu_id' => $padre_id));
			$coMenus[$padre]+=$this->CoGroup->CoMenu->find('list',$options);
		}
	*/

		
	/*	$Permisos = $this->CoGroup->CoPermission->find('list');

		$coPermissions = array();
	
		//Para devolver agrupados los permisos.
		foreach ($Permisos as $permiso_id=> $actividad)
		{

			if($actividad=="Todos los permisos")
			{
				//No se agrega ya que el componente select2, crea el primer textbox para seleccionarlos todos
			}
			else
			{
				//Dividimos el permiso => actualizaciones:add, en controlador=>$grupo[0] y actividad=>$grupo[1]
				$grupo= explode(":", $actividad);
				
				//Creamos el grupo si tiene un *
				if($grupo[1]=="*")
				{
					$coPermissions[$grupo[0]]=array($permiso_id => "*");
					//Almacenamos temporalmente el nombre del controlador, para cuando no entre
					$padre=$grupo[0];
				}
				else
				{
					if($actividad=="Todos los permisos")
					$coPermissions["Todos los permisos"]=array($permiso_id => $actividad);

					//Añadimos el permiso bajo el controlador
					$coPermissions[$padre][$permiso_id]=$grupo[1];
				}
			}
		}
		*/
		
		$coMenus = $this->CoGroup->CoMenu->find('list');
		$coPermissions = $this->CoGroup->CoPermission->find('list');
		
		/*
		pr($coPermissions);
		pr($coMenus);
		die();
		*/
		
		$this->set(compact('coMenus', 'coPermissions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CoGroup->id = $id;
		if (!$this->CoGroup->exists()) {
			throw new NotFoundException(__('Id invalido para el registro'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CoGroup->delete()) {
			$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Registro eliminado.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>El registro no pudo ser eliminado.','default',array('class'=>'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
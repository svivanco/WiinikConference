<?php
App::uses('AppController', 'Controller');
/**
 * CoMenus Controller
 *
 * @property CoMenu $CoMenu
 * @property PaginatorComponent $Paginator
 */
class CoMenusController extends AppController {

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
	public function index()
	{
		if(isset($this->params['url']['search_text']))
		{
			$search=$this->params['url']['search_text'];
			$this->paginate = array(
			'conditions'=>array('or' => array(
			'MenuPadre.nombre LIKE' => '%'. $search. '%',
			'CoMenu.nombre LIKE' => '%'. $search. '%',
			'CoMenu.destino LIKE' => '%'. $search. '%',
			'CoMenu.icono LIKE' => '%'. $search. '%',
			'CoMenu.info_tooltip LIKE' => '%'. $search. '%',
			'CoMenu.id LIKE' => '%'. $search. '%'))	);
			
			$coMenus=$this->paginate();
			$this->set(compact('coMenus'));
	
			//$this->set('CoMenus', $this->paginate());
		}
		else
		{		
		$this->CoMenu->recursive = 0;
			$coMenus=$this->paginate();
			$this->set(compact('coMenus'));
		}
		//$this->CoMenu->recursive = 0;
		//$this->set('coMenus', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CoMenu->exists($id)) {
			throw new NotFoundException('Id invalido para el registro');
		}
		$options = array('conditions' => array('CoMenu.' . $this->CoMenu->primaryKey => $id));
		$this->set('coMenu', $this->CoMenu->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CoMenu->create();
			if ($this->CoMenu->save($this->request->data)) {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Registro guardado.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>El registro no pudo ser guardado.','default',array('class'=>'alert alert-danger'));
			}
		}
		$coMenus = $this->CoMenu->MenuPadre->find('list',array('conditions'=>array('MenuPadre.co_menu_id IS NULL','MenuPadre.activo'=>1)));
		$coGroups = $this->CoMenu->CoGroup->find('list');
		$this->set(compact('coMenus', 'coGroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CoMenu->exists($id)) {
			throw new NotFoundException(__('Id invalido para el registro'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CoMenu->save($this->request->data)) {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Registro actualizado.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>El registro no pudo ser actualizado.','default',array('class'=>'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CoMenu.' . $this->CoMenu->primaryKey => $id));
			$this->request->data = $this->CoMenu->find('first', $options);
		}
		$coMenus = $this->CoMenu->MenuPadre->find('list',array('conditions'=>array('MenuPadre.co_menu_id IS NULL','MenuPadre.activo'=>1,'MenuPadre.id !='=>$this->request->data['CoMenu']['id'])));
		$coGroups = $this->CoMenu->CoGroup->find('list');
		$this->set(compact('coMenus', 'coGroups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CoMenu->id = $id;
		if (!$this->CoMenu->exists()) {
			throw new NotFoundException(__('Id invalido para el registro'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CoMenu->delete()) {
			$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>Registro eliminado.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>El registro no pudo ser eliminado.','default',array('class'=>'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

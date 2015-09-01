<?php
App::uses('AppController', 'Controller');
/**
 * UserTerrestres Controller
 *
 * @property UserTerrestre $UserTerrestre
 * @property PaginatorComponent $Paginator
 */
class UserTerrestresController extends AppController {

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
		$this->UserTerrestre->recursive = 0;
		$this->set('userTerrestres', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserTerrestre->exists($id)) {
			throw new NotFoundException(__('Invalid user terrestre'));
		}
		$options = array('conditions' => array('UserTerrestre.' . $this->UserTerrestre->primaryKey => $id));
		$this->set('userTerrestre', $this->UserTerrestre->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() 
	{
		//Recibimos el ID del usuario
		$user_id=$this->params['pass'][0];

		
		if ($this->request->is('post')) 
		{
			$this->UserTerrestre->create();
			if ($this->UserTerrestre->save($this->request->data)) 
			{
				$user_id=$this->request->data['UserTerrestre']['co_user_id'];				
				$this->Session->setFlash(__('The user terrestre ha sido guardado.'));
				return $this->redirect(array('controller' => 'CoUsers','action' => 'Confirmacion',$user_id));
			} else {
				$this->Session->setFlash(__('The user terrestre no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		}
		$options = array('conditions'=>array('CoUser.id' => $user_id));					
		$coUsers = $this->UserTerrestre->CoUser->find('list',$options);
		$this->set(compact('coUsers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserTerrestre->exists($id)) {
			throw new NotFoundException(__('Invalid user terrestre'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserTerrestre->save($this->request->data)) {
				$this->Session->setFlash(__('The user terrestre ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user terrestre no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('UserTerrestre.' . $this->UserTerrestre->primaryKey => $id));
			$this->request->data = $this->UserTerrestre->find('first', $options);
		}
		$coUsers = $this->UserTerrestre->CoUser->find('list');
		$this->set(compact('coUsers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserTerrestre->id = $id;
		if (!$this->UserTerrestre->exists()) {
			throw new NotFoundException(__('Invalid user terrestre'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserTerrestre->delete()) {
			$this->Session->setFlash(__('The user terrestre ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The user terrestre no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

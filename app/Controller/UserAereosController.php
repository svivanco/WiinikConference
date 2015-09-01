<?php
App::uses('AppController', 'Controller');
/**
 * UserAereos Controller
 *
 * @property UserAereo $UserAereo
 * @property PaginatorComponent $Paginator
 */
class UserAereosController extends AppController {

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
		$this->UserAereo->recursive = 0;
		$this->set('userAereos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserAereo->exists($id)) {
			throw new NotFoundException(__('Invalid user aereo'));
		}
		$options = array('conditions' => array('UserAereo.' . $this->UserAereo->primaryKey => $id));
		$this->set('userAereo', $this->UserAereo->find('first', $options));
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
		
		if ($this->request->is('post')) {
			$this->UserAereo->create();
			if ($this->UserAereo->save($this->request->data)) 
			{
				$user_id=$this->request->data['UserAereo']['co_user_id'];				
				$this->Session->setFlash(__('The user aereo ha sido guardado.'));
				return $this->redirect(array('controller' => 'CoUsers','action' => 'Confirmacion',$user_id));

				
			} 
			else 
			{
				$this->Session->setFlash(__('The user aereo no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		}
		$options = array('conditions'=>array('CoUser.id' => $user_id));					
		$coUsers = $this->UserAereo->CoUser->find('list',$options);
		$aeropuertos = $this->UserAereo->Aeropuerto->find('list');
		$this->set(compact('coUsers', 'aeropuertos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserAereo->exists($id)) {
			throw new NotFoundException(__('Invalid user aereo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserAereo->save($this->request->data)) {
				$this->Session->setFlash(__('The user aereo ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user aereo no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('UserAereo.' . $this->UserAereo->primaryKey => $id));
			$this->request->data = $this->UserAereo->find('first', $options);
		}
		$coUsers = $this->UserAereo->CoUser->find('list');
		$aeropuertos = $this->UserAereo->Aeropuerto->find('list');
		$this->set(compact('coUsers', 'aeropuertos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserAereo->id = $id;
		if (!$this->UserAereo->exists()) {
			throw new NotFoundException(__('Invalid user aereo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserAereo->delete()) {
			$this->Session->setFlash(__('The user aereo ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The user aereo no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

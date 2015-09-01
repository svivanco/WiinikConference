<?php
App::uses('AppController', 'Controller');
/**
 * UserAcompanantes Controller
 *
 * @property UserAcompanante $UserAcompanante
 * @property PaginatorComponent $Paginator
 */
class UserAcompanantesController extends AppController {

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
		$this->UserAcompanante->recursive = 0;
		$this->set('userAcompanantes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserAcompanante->exists($id)) {
			throw new NotFoundException(__('Invalid user acompanante'));
		}
		$options = array('conditions' => array('UserAcompanante.' . $this->UserAcompanante->primaryKey => $id));
		$this->set('userAcompanante', $this->UserAcompanante->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserAcompanante->create();
			if ($this->UserAcompanante->save($this->request->data)) {
				$this->Session->setFlash(__('The user acompanante ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user acompanante no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		}
		$coUsers = $this->UserAcompanante->CoUser->find('list');
		$relacions = $this->UserAcompanante->Relacion->find('list');
		$userSexos = $this->UserAcompanante->UserSexo->find('list');
		$this->set(compact('coUsers', 'relacions', 'userSexos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserAcompanante->exists($id)) {
			throw new NotFoundException(__('Invalid user acompanante'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserAcompanante->save($this->request->data)) {
				$this->Session->setFlash(__('The user acompanante ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user acompanante no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('UserAcompanante.' . $this->UserAcompanante->primaryKey => $id));
			$this->request->data = $this->UserAcompanante->find('first', $options);
		}
		$coUsers = $this->UserAcompanante->CoUser->find('list');
		$relacions = $this->UserAcompanante->Relacion->find('list');
		$userSexos = $this->UserAcompanante->UserSexo->find('list');
		$this->set(compact('coUsers', 'relacions', 'userSexos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserAcompanante->id = $id;
		if (!$this->UserAcompanante->exists()) {
			throw new NotFoundException(__('Invalid user acompanante'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserAcompanante->delete()) {
			$this->Session->setFlash(__('The user acompanante ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The user acompanante no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

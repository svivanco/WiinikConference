<?php
App::uses('AppController', 'Controller');
/**
 * UserSexos Controller
 *
 * @property UserSexo $UserSexo
 * @property PaginatorComponent $Paginator
 */
class UserSexosController extends AppController {

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
		$this->UserSexo->recursive = 0;
		$this->set('userSexos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserSexo->exists($id)) {
			throw new NotFoundException(__('Invalid user sexo'));
		}
		$options = array('conditions' => array('UserSexo.' . $this->UserSexo->primaryKey => $id));
		$this->set('userSexo', $this->UserSexo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserSexo->create();
			if ($this->UserSexo->save($this->request->data)) {
				$this->Session->setFlash(__('The user sexo ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user sexo no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserSexo->exists($id)) {
			throw new NotFoundException(__('Invalid user sexo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserSexo->save($this->request->data)) {
				$this->Session->setFlash(__('The user sexo ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user sexo no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('UserSexo.' . $this->UserSexo->primaryKey => $id));
			$this->request->data = $this->UserSexo->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserSexo->id = $id;
		if (!$this->UserSexo->exists()) {
			throw new NotFoundException(__('Invalid user sexo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserSexo->delete()) {
			$this->Session->setFlash(__('The user sexo ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The user sexo no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

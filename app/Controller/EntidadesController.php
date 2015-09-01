<?php
App::uses('AppController', 'Controller');
/**
 * Entidades Controller
 *
 * @property Entidade $Entidade
 * @property PaginatorComponent $Paginator
 */
class EntidadesController extends AppController {

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
		$this->Entidade->recursive = 0;
		$this->set('entidades', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Entidade->exists($id)) {
			throw new NotFoundException(__('Invalid entidade'));
		}
		$options = array('conditions' => array('Entidade.' . $this->Entidade->primaryKey => $id));
		$this->set('entidade', $this->Entidade->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Entidade->create();
			if ($this->Entidade->save($this->request->data)) {
				$this->Session->setFlash(__('The entidade ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entidade no pudo ser guardado. Porfavor intente de nuevo..'));
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
		if (!$this->Entidade->exists($id)) {
			throw new NotFoundException(__('Invalid entidade'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Entidade->save($this->request->data)) {
				$this->Session->setFlash(__('The entidade ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entidade no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('Entidade.' . $this->Entidade->primaryKey => $id));
			$this->request->data = $this->Entidade->find('first', $options);
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
		$this->Entidade->id = $id;
		if (!$this->Entidade->exists()) {
			throw new NotFoundException(__('Invalid entidade'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Entidade->delete()) {
			$this->Session->setFlash(__('The entidade ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The entidade no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

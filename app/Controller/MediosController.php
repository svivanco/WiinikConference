<?php
App::uses('AppController', 'Controller');
/**
 * Medios Controller
 *
 * @property Medio $Medio
 * @property PaginatorComponent $Paginator
 */
class MediosController extends AppController {

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
		$this->Medio->recursive = 0;
		$this->set('medios', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Medio->exists($id)) {
			throw new NotFoundException(__('Invalid medio'));
		}
		$options = array('conditions' => array('Medio.' . $this->Medio->primaryKey => $id));
		$this->set('medio', $this->Medio->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Medio->create();
			if ($this->Medio->save($this->request->data)) {
				$this->Session->setFlash(__('The medio ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The medio no pudo ser guardado. Porfavor intente de nuevo..'));
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
		if (!$this->Medio->exists($id)) {
			throw new NotFoundException(__('Invalid medio'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Medio->save($this->request->data)) {
				$this->Session->setFlash(__('The medio ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The medio no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('Medio.' . $this->Medio->primaryKey => $id));
			$this->request->data = $this->Medio->find('first', $options);
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
		$this->Medio->id = $id;
		if (!$this->Medio->exists()) {
			throw new NotFoundException(__('Invalid medio'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Medio->delete()) {
			$this->Session->setFlash(__('The medio ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The medio no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

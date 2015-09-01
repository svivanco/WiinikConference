<?php
App::uses('AppController', 'Controller');
/**
 * Hoteles Controller
 *
 * @property Hotele $Hotele
 * @property PaginatorComponent $Paginator
 */
class HotelesController extends AppController {

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
		$this->Hotele->recursive = 0;
		$this->set('hoteles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Hotele->exists($id)) {
			throw new NotFoundException(__('Invalid hotele'));
		}
		$options = array('conditions' => array('Hotele.' . $this->Hotele->primaryKey => $id));
		$this->set('hotele', $this->Hotele->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Hotele->create();
			if ($this->Hotele->save($this->request->data)) {
				$this->Session->setFlash(__('The hotele ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The hotele no pudo ser guardado. Porfavor intente de nuevo..'));
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
		if (!$this->Hotele->exists($id)) {
			throw new NotFoundException(__('Invalid hotele'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Hotele->save($this->request->data)) {
				$this->Session->setFlash(__('The hotele ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The hotele no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('Hotele.' . $this->Hotele->primaryKey => $id));
			$this->request->data = $this->Hotele->find('first', $options);
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
		$this->Hotele->id = $id;
		if (!$this->Hotele->exists()) {
			throw new NotFoundException(__('Invalid hotele'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Hotele->delete()) {
			$this->Session->setFlash(__('The hotele ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The hotele no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

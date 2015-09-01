<?php
App::uses('AppController', 'Controller');
/**
 * Aeropuertos Controller
 *
 * @property Aeropuerto $Aeropuerto
 * @property PaginatorComponent $Paginator
 */
class AeropuertosController extends AppController {

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
		$this->Aeropuerto->recursive = 0;
		$this->set('aeropuertos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Aeropuerto->exists($id)) {
			throw new NotFoundException(__('Invalid aeropuerto'));
		}
		$options = array('conditions' => array('Aeropuerto.' . $this->Aeropuerto->primaryKey => $id));
		$this->set('aeropuerto', $this->Aeropuerto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Aeropuerto->create();
			if ($this->Aeropuerto->save($this->request->data)) {
				$this->Session->setFlash(__('The aeropuerto ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The aeropuerto no pudo ser guardado. Porfavor intente de nuevo..'));
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
		if (!$this->Aeropuerto->exists($id)) {
			throw new NotFoundException(__('Invalid aeropuerto'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Aeropuerto->save($this->request->data)) {
				$this->Session->setFlash(__('The aeropuerto ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The aeropuerto no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('Aeropuerto.' . $this->Aeropuerto->primaryKey => $id));
			$this->request->data = $this->Aeropuerto->find('first', $options);
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
		$this->Aeropuerto->id = $id;
		if (!$this->Aeropuerto->exists()) {
			throw new NotFoundException(__('Invalid aeropuerto'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Aeropuerto->delete()) {
			$this->Session->setFlash(__('The aeropuerto ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The aeropuerto no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

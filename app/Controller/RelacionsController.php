<?php
App::uses('AppController', 'Controller');
/**
 * Relacions Controller
 *
 * @property Relacion $Relacion
 * @property PaginatorComponent $Paginator
 */
class RelacionsController extends AppController {

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
		$this->Relacion->recursive = 0;
		$this->set('relacions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Relacion->exists($id)) {
			throw new NotFoundException(__('Invalid relacion'));
		}
		$options = array('conditions' => array('Relacion.' . $this->Relacion->primaryKey => $id));
		$this->set('relacion', $this->Relacion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Relacion->create();
			if ($this->Relacion->save($this->request->data)) {
				$this->Session->setFlash(__('The relacion ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The relacion no pudo ser guardado. Porfavor intente de nuevo..'));
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
		if (!$this->Relacion->exists($id)) {
			throw new NotFoundException(__('Invalid relacion'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Relacion->save($this->request->data)) {
				$this->Session->setFlash(__('The relacion ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The relacion no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('Relacion.' . $this->Relacion->primaryKey => $id));
			$this->request->data = $this->Relacion->find('first', $options);
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
		$this->Relacion->id = $id;
		if (!$this->Relacion->exists()) {
			throw new NotFoundException(__('Invalid relacion'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Relacion->delete()) {
			$this->Session->setFlash(__('The relacion ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The relacion no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

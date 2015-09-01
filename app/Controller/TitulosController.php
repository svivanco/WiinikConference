<?php
App::uses('AppController', 'Controller');
/**
 * Titulos Controller
 *
 * @property Titulo $Titulo
 * @property PaginatorComponent $Paginator
 */
class TitulosController extends AppController {

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
		$this->Titulo->recursive = 0;
		$this->set('titulos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Titulo->exists($id)) {
			throw new NotFoundException(__('Invalid titulo'));
		}
		$options = array('conditions' => array('Titulo.' . $this->Titulo->primaryKey => $id));
		$this->set('titulo', $this->Titulo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Titulo->create();
			if ($this->Titulo->save($this->request->data)) {
				$this->Session->setFlash(__('The titulo ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The titulo no pudo ser guardado. Porfavor intente de nuevo..'));
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
		if (!$this->Titulo->exists($id)) {
			throw new NotFoundException(__('Invalid titulo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Titulo->save($this->request->data)) {
				$this->Session->setFlash(__('The titulo ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The titulo no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('Titulo.' . $this->Titulo->primaryKey => $id));
			$this->request->data = $this->Titulo->find('first', $options);
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
		$this->Titulo->id = $id;
		if (!$this->Titulo->exists()) {
			throw new NotFoundException(__('Invalid titulo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Titulo->delete()) {
			$this->Session->setFlash(__('The titulo ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The titulo no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

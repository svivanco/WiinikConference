<?php
App::uses('AppController', 'Controller');
/**
 * Ubicaciones Controller
 *
 * @property Ubicacione $Ubicacione
 * @property PaginatorComponent $Paginator
 */
class UbicacionesController extends AppController {

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
		$this->Ubicacione->recursive = 0;
		$this->set('ubicaciones', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ubicacione->exists($id)) {
			throw new NotFoundException(__('Invalid ubicacione'));
		}
		$options = array('conditions' => array('Ubicacione.' . $this->Ubicacione->primaryKey => $id));
		$this->set('ubicacione', $this->Ubicacione->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Ubicacione->create();
			if ($this->Ubicacione->save($this->request->data)) {
				$this->Session->setFlash(__('The ubicacione ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ubicacione no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		}
		$eventos = $this->Ubicacione->Evento->find('list');
		$this->set(compact('eventos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Ubicacione->exists($id)) {
			throw new NotFoundException(__('Invalid ubicacione'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ubicacione->save($this->request->data)) {
				$this->Session->setFlash(__('The ubicacione ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ubicacione no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('Ubicacione.' . $this->Ubicacione->primaryKey => $id));
			$this->request->data = $this->Ubicacione->find('first', $options);
		}
		$eventos = $this->Ubicacione->Evento->find('list');
		$this->set(compact('eventos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Ubicacione->id = $id;
		if (!$this->Ubicacione->exists()) {
			throw new NotFoundException(__('Invalid ubicacione'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Ubicacione->delete()) {
			$this->Session->setFlash(__('The ubicacione ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The ubicacione no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

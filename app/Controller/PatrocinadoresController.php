<?php
App::uses('AppController', 'Controller');
/**
 * Patrocinadores Controller
 *
 * @property Patrocinadore $Patrocinadore
 * @property PaginatorComponent $Paginator
 */
class PatrocinadoresController extends AppController {

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
		$this->Patrocinadore->recursive = 0;
		$this->set('patrocinadores', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Patrocinadore->exists($id)) {
			throw new NotFoundException(__('Invalid patrocinadore'));
		}
		$options = array('conditions' => array('Patrocinadore.' . $this->Patrocinadore->primaryKey => $id));
		$this->set('patrocinadore', $this->Patrocinadore->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Patrocinadore->create();
			if ($this->Patrocinadore->save($this->request->data)) {
				$this->Session->setFlash(__('The patrocinadore ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patrocinadore no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		}
		$eventos = $this->Patrocinadore->Evento->find('list');
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
		if (!$this->Patrocinadore->exists($id)) {
			throw new NotFoundException(__('Invalid patrocinadore'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Patrocinadore->save($this->request->data)) {
				$this->Session->setFlash(__('The patrocinadore ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The patrocinadore no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('Patrocinadore.' . $this->Patrocinadore->primaryKey => $id));
			$this->request->data = $this->Patrocinadore->find('first', $options);
		}
		$eventos = $this->Patrocinadore->Evento->find('list');
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
		$this->Patrocinadore->id = $id;
		if (!$this->Patrocinadore->exists()) {
			throw new NotFoundException(__('Invalid patrocinadore'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Patrocinadore->delete()) {
			$this->Session->setFlash(__('The patrocinadore ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The patrocinadore no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

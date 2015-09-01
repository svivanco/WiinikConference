<?php
App::uses('AppController', 'Controller');
/**
 * TipoAdjuntos Controller
 *
 * @property TipoAdjunto $TipoAdjunto
 * @property PaginatorComponent $Paginator
 */
class TipoAdjuntosController extends AppController {

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
		$this->TipoAdjunto->recursive = 0;
		$this->set('tipoAdjuntos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TipoAdjunto->exists($id)) {
			throw new NotFoundException(__('Invalid tipo adjunto'));
		}
		$options = array('conditions' => array('TipoAdjunto.' . $this->TipoAdjunto->primaryKey => $id));
		$this->set('tipoAdjunto', $this->TipoAdjunto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TipoAdjunto->create();
			if ($this->TipoAdjunto->save($this->request->data)) {
				$this->Session->setFlash(__('The tipo adjunto ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo adjunto no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		}
		$coGroups = $this->TipoAdjunto->CoGroup->find('list');
		$this->set(compact('coGroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TipoAdjunto->exists($id)) {
			throw new NotFoundException(__('Invalid tipo adjunto'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TipoAdjunto->save($this->request->data)) {
				$this->Session->setFlash(__('The tipo adjunto ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo adjunto no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('TipoAdjunto.' . $this->TipoAdjunto->primaryKey => $id));
			$this->request->data = $this->TipoAdjunto->find('first', $options);
		}
		$coGroups = $this->TipoAdjunto->CoGroup->find('list');
		$this->set(compact('coGroups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TipoAdjunto->id = $id;
		if (!$this->TipoAdjunto->exists()) {
			throw new NotFoundException(__('Invalid tipo adjunto'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TipoAdjunto->delete()) {
			$this->Session->setFlash(__('The tipo adjunto ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The tipo adjunto no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

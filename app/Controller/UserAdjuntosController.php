<?php
App::uses('AppController', 'Controller');
/**
 * UserAdjuntos Controller
 *
 * @property UserAdjunto $UserAdjunto
 * @property PaginatorComponent $Paginator
 */
class UserAdjuntosController extends AppController {

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
		$this->UserAdjunto->recursive = 0;
		$this->set('userAdjuntos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserAdjunto->exists($id)) {
			throw new NotFoundException(__('Invalid user adjunto'));
		}
		$options = array('conditions' => array('UserAdjunto.' . $this->UserAdjunto->primaryKey => $id));
		$this->set('userAdjunto', $this->UserAdjunto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserAdjunto->create();
			if ($this->UserAdjunto->save($this->request->data)) {
				$this->Session->setFlash(__('The user adjunto ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user adjunto no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		}
		$coUsers = $this->UserAdjunto->CoUser->find('list');
		$tipoAdjuntos = $this->UserAdjunto->TipoAdjunto->find('list');
		$this->set(compact('coUsers', 'tipoAdjuntos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserAdjunto->exists($id)) {
			throw new NotFoundException(__('Invalid user adjunto'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserAdjunto->save($this->request->data)) {
				$this->Session->setFlash(__('The user adjunto ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user adjunto no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('UserAdjunto.' . $this->UserAdjunto->primaryKey => $id));
			$this->request->data = $this->UserAdjunto->find('first', $options);
		}
		$coUsers = $this->UserAdjunto->CoUser->find('list');
		$tipoAdjuntos = $this->UserAdjunto->TipoAdjunto->find('list');
		$this->set(compact('coUsers', 'tipoAdjuntos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserAdjunto->id = $id;
		if (!$this->UserAdjunto->exists()) {
			throw new NotFoundException(__('Invalid user adjunto'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserAdjunto->delete()) {
			$this->Session->setFlash(__('The user adjunto ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The user adjunto no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

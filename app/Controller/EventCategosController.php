<?php
App::uses('AppController', 'Controller');
/**
 * EventCategos Controller
 *
 * @property EventCatego $EventCatego
 * @property PaginatorComponent $Paginator
 */
class EventCategosController extends AppController {

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
		$this->EventCatego->recursive = 0;
		$this->set('eventCategos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EventCatego->exists($id)) {
			throw new NotFoundException(__('Invalid event catego'));
		}
		$options = array('conditions' => array('EventCatego.' . $this->EventCatego->primaryKey => $id));
		$this->set('eventCatego', $this->EventCatego->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EventCatego->create();
			if ($this->EventCatego->save($this->request->data)) {
				$this->Session->setFlash(__('The event catego ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event catego no pudo ser guardado. Porfavor intente de nuevo..'));
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
		if (!$this->EventCatego->exists($id)) {
			throw new NotFoundException(__('Invalid event catego'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EventCatego->save($this->request->data)) {
				$this->Session->setFlash(__('The event catego ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event catego no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('EventCatego.' . $this->EventCatego->primaryKey => $id));
			$this->request->data = $this->EventCatego->find('first', $options);
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
		$this->EventCatego->id = $id;
		if (!$this->EventCatego->exists()) {
			throw new NotFoundException(__('Invalid event catego'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EventCatego->delete()) {
			$this->Session->setFlash(__('The event catego ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The event catego no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

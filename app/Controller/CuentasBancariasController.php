<?php
App::uses('AppController', 'Controller');
/**
 * CuentasBancarias Controller
 *
 * @property CuentasBancaria $CuentasBancaria
 * @property PaginatorComponent $Paginator
 */
class CuentasBancariasController extends AppController {

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
		$this->CuentasBancaria->recursive = 0;
		$this->set('cuentasBancarias', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CuentasBancaria->exists($id)) {
			throw new NotFoundException(__('Invalid cuentas bancaria'));
		}
		$options = array('conditions' => array('CuentasBancaria.' . $this->CuentasBancaria->primaryKey => $id));
		$this->set('cuentasBancaria', $this->CuentasBancaria->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CuentasBancaria->create();
			if ($this->CuentasBancaria->save($this->request->data)) {
				$this->Session->setFlash(__('The cuentas bancaria ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cuentas bancaria no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		}
		$eventos = $this->CuentasBancaria->Evento->find('list');
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
		if (!$this->CuentasBancaria->exists($id)) {
			throw new NotFoundException(__('Invalid cuentas bancaria'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CuentasBancaria->save($this->request->data)) {
				$this->Session->setFlash(__('The cuentas bancaria ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cuentas bancaria no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('CuentasBancaria.' . $this->CuentasBancaria->primaryKey => $id));
			$this->request->data = $this->CuentasBancaria->find('first', $options);
		}
		$eventos = $this->CuentasBancaria->Evento->find('list');
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
		$this->CuentasBancaria->id = $id;
		if (!$this->CuentasBancaria->exists()) {
			throw new NotFoundException(__('Invalid cuentas bancaria'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CuentasBancaria->delete()) {
			$this->Session->setFlash(__('The cuentas bancaria ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The cuentas bancaria no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

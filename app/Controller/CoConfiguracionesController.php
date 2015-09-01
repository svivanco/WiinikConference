<?php
App::uses('AppController', 'Controller');
/**
 * CoConfiguraciones Controller
 *
 * @property CoConfiguracione $CoConfiguracione
 * @property PaginatorComponent $Paginator
 */
class CoConfiguracionesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');



	public function catalogos() 
	{
		//Vista que organiza los catalogos
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CoConfiguracione->recursive = 0;
		$this->set('coConfiguraciones', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CoConfiguracione->exists($id)) {
			throw new NotFoundException(__('Invalid co configuracione'));
		}
		$options = array('conditions' => array('CoConfiguracione.' . $this->CoConfiguracione->primaryKey => $id));
		$this->set('coConfiguracione', $this->CoConfiguracione->find('first', $options));
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CoConfiguracione->exists($id)) {
			throw new NotFoundException(__('Invalid co configuracione'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CoConfiguracione->save($this->request->data)) {
				$this->Session->setFlash(__('The co configuracione has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The co configuracione could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CoConfiguracione.' . $this->CoConfiguracione->primaryKey => $id));
			$this->request->data = $this->CoConfiguracione->find('first', $options);
		}
	}
}

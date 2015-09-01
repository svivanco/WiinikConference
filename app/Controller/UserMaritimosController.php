<?php
App::uses('AppController', 'Controller');
/**
 * UserMaritimos Controller
 *
 * @property UserMaritimo $UserMaritimo
 * @property PaginatorComponent $Paginator
 */
class UserMaritimosController extends AppController {

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
		$this->UserMaritimo->recursive = 0;
		$this->set('userMaritimos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserMaritimo->exists($id)) {
			throw new NotFoundException(__('Invalid user maritimo'));
		}
		$options = array('conditions' => array('UserMaritimo.' . $this->UserMaritimo->primaryKey => $id));
		$this->set('userMaritimo', $this->UserMaritimo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() 
	{
		//Recibimos el ID del usuario
		$user_id=$this->params['pass'][0];
		
		if ($this->request->is('post')) {
			$this->UserMaritimo->create();
			if ($this->UserMaritimo->save($this->request->data)) 
			{
				$user_id=$this->request->data['UserMaritimo']['co_user_id'];				
				$this->Session->setFlash(__('The user maritimo ha sido guardado.'));
				return $this->redirect(array('controller' => 'CoUsers','action' => 'Confirmacion',$user_id));
			} 
			else 
			{
				$this->Session->setFlash(__('The user maritimo no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		}
		$options = array('conditions'=>array('CoUser.id' => $user_id));							
		$coUsers = $this->UserMaritimo->CoUser->find('list',$options);
		$this->set(compact('coUsers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserMaritimo->exists($id)) {
			throw new NotFoundException(__('Invalid user maritimo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserMaritimo->save($this->request->data)) {
				$this->Session->setFlash(__('The user maritimo ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user maritimo no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('UserMaritimo.' . $this->UserMaritimo->primaryKey => $id));
			$this->request->data = $this->UserMaritimo->find('first', $options);
		}
		$coUsers = $this->UserMaritimo->CoUser->find('list');
		$this->set(compact('coUsers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserMaritimo->id = $id;
		if (!$this->UserMaritimo->exists()) {
			throw new NotFoundException(__('Invalid user maritimo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserMaritimo->delete()) {
			$this->Session->setFlash(__('The user maritimo ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The user maritimo no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

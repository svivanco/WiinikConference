<?php
App::uses('AppController', 'Controller');
/**
 * Audits Controller
 *
 * @property Audit $Audit
 * @property PaginatorComponent $Paginator
 */
class AuditsController extends AppController {

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
	public function index() 
	{
		if(isset($this->params['url']['search_text']))
		{
			$search=$this->params['url']['search_text'];
			$this->paginate = array(
			'conditions'=>array('or' => array(
			'Audit.model LIKE' => '%'. $search. '%',
			'Audit.event LIKE' => '%'. $search. '%',		
			'Audit.description LIKE' => '%'. $search. '%',
			'Audit.created LIKE' => '%'. $search. '%',
			'Audit.ip LIKE' => '%'. $search. '%',
			'Audit.json_object LIKE' => '%'. $search. '%',

			'Audit.URL_referrer LIKE' => '%'. $search. '%'))	);
			
			$audits=$this->paginate();
			$this->set(compact('audits'));
			//$this->set('CoMenus', $this->paginate());		
		}
		else
		{		
			$this->Audit->recursive = 0;
			$this->Paginator->settings['order'] = 'Audit.id DESC';
			$audits=$this->paginate();
			$this->set(compact('audits'));
		}

		
		//$this->Audit->recursive = 0;
		//$this->set('audits', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Audit->exists($id)) {
			throw new NotFoundException(__('Invalid audit'));
		}
		$options = array('conditions' => array('Audit.' . $this->Audit->primaryKey => $id));
		$this->set('audit', $this->Audit->find('first', $options));
	}



/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Audit->id = $id;
		if (!$this->Audit->exists()) {
			throw new NotFoundException(__('Invalid audit'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Audit->delete()) {
			$this->Session->setFlash(__('The audit ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The audit no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

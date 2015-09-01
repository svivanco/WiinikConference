<?php
App::uses('AppController', 'Controller');
/**
 * AuditDeltas Controller
 *
 * @property AuditDelta $AuditDelta
 * @property PaginatorComponent $Paginator
 */
class AuditDeltasController extends AppController {

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
			if(isset($this->params->pass[0]))
			{
				$id_audit=$this->params->pass[0];
				$this->paginate = array('conditions'=>array('AuditDelta.audit_id' => $id_audit));
				$this->set('auditDeltas', $this->paginate());		
				
			}
			else
			{
				$this->AuditDelta->recursive = 0;
				$this->set('auditDeltas', $this->Paginator->paginate());			
			}

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AuditDelta->exists($id)) {
			throw new NotFoundException(__('Invalid audit delta'));
		}
		$options = array('conditions' => array('AuditDelta.' . $this->AuditDelta->primaryKey => $id));
		$this->set('auditDelta', $this->AuditDelta->find('first', $options));
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AuditDelta->id = $id;
		if (!$this->AuditDelta->exists()) {
			throw new NotFoundException(__('Invalid audit delta'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AuditDelta->delete()) {
			$this->Session->setFlash(__('The audit delta ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The audit delta no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

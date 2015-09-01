<?php
App::uses('AppController', 'Controller');
/**
 * Municipios Controller
 *
 * @property Municipio $Municipio
 * @property PaginatorComponent $Paginator
 */
class MunicipiosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
 var $helpers = array('Ajax');/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Municipio->recursive = 0;
		$this->set('municipios', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Municipio->exists($id)) {
			throw new NotFoundException(__('Invalid municipio'));
		}
		$options = array('conditions' => array('Municipio.' . $this->Municipio->primaryKey => $id));
		$this->set('municipio', $this->Municipio->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Municipio->create();
			if ($this->Municipio->save($this->request->data)) {
				$this->Session->setFlash(__('The municipio ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The municipio no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		}
		$entidades = $this->Municipio->Entidade->find('list');
		$areas = $this->Municipio->Area->find('list');				
		$this->set(compact('entidades','areas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Municipio->exists($id)) {
			throw new NotFoundException(__('Invalid municipio'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Municipio->save($this->request->data)) {
				$this->Session->setFlash(__('The municipio ha sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The municipio no pudo ser guardado. Porfavor intente de nuevo..'));
			}
		} else {
			$options = array('conditions' => array('Municipio.' . $this->Municipio->primaryKey => $id));
			$this->request->data = $this->Municipio->find('first', $options);
		}
		$entidades = $this->Municipio->Entidade->find('list');
		$areas = $this->Municipio->Area->find('list');				
		$this->set(compact('entidades','areas'));
	}





/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Municipio->id = $id;
		if (!$this->Municipio->exists()) {
			throw new NotFoundException(__('Invalid municipio'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Municipio->delete()) {
			$this->Session->setFlash(__('The municipio ha sido borrado.'));
		} else {
			$this->Session->setFlash(__('The municipio no pudo ser borrado. Porfavor intente de nuevo..'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	

		/**
 * FUNCION AJAX	
 *
 * @throws NotFoundException
 * @param string $id
 * @return LISTADO DE MUNICIPIOS EN BASE AL ESTADO
 */
	function buscar_municipio()
    {
		//pr($this->request);
		//echo "via".$this->params['url']['entidade_id'];	
        $this->layout = 'ajax';
		//La variable se debe de llamar igual a la que se le envia en el controlador CoUser->Add
		$municipios = $this->Municipio->find
                                                                     (
                                                                            'list',
                                                                            array
                                                                                (
                                                                                    'conditions'=>array
                                                                                                      (
                                                                 'Municipio.entidade_id'=>$this->params['url']['entidade_id']
                                                                                                        ) 
                                                                                )
                                                                        ); 
		//pr($municipios);
		//die();																		
        $this->set(compact('municipios'));                
    }


	
}
	
	

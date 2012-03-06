<?php
App::uses('AppController', 'Controller');
/**
 * Auths Controller
 *
 * @property Auth $Auth
 */
class AuthsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Auth->recursive = 0;
		$this->set('auths', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		$this->set('auth', $this->Auth->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Auth->create();
			if ($this->Auth->save($this->request->data)) {
				$this->Session->setFlash(__('The auth has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Auth->save($this->request->data)) {
				$this->Session->setFlash(__('The auth has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Auth->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		if ($this->Auth->delete()) {
			$this->Session->setFlash(__('Auth deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Auth was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

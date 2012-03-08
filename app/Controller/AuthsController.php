<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once realpath(dirname(__FILE__)) . '/../Lib/litle/LitleOnline.php';

App::uses('AppController', 'Controller');
/**
 * Auths Controller
 *
 * @property Auth $Auth
 */
class AuthsController extends AppController {

	
	private function purgeNull($data_in, $data_out=NULL){
	
		foreach($data_in as $key => $value)
		{
			if ((!(!$value)) && (!is_array($value)))//is_string($value) || is_numeric($value))
			{
				$data_out[$key] = $data_in[$key];
			}
			elseif(is_array($value))
			{
				$notEmpty = false;
				foreach ($value as $key2 => $value2){
					
					$notEmpty = $notEmpty || $value2;
				}
				//$this->Session->setFlash(__($notEmpty));
					
					if ($notEmpty){
						//$this->Session->setFlash(__('notempty'));
						$data_out[$key] = $data_in[$key];
						AuthsController::purgeNull($value, $data_out[$key]);
					}
				
			}
				
		}
		return $data_out;
	}

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
			
			
			$hash_in = array(
						'orderId'=> '4',
						'amount'=>$this->data['Auth']['amount'],
						'orderSource'=>'ecommerce',
						'billToAddress'=>array(
								'name'=>$this->data['Auth']['name'],
								'addressLine1'=>$this->data['Auth']['address1'],
								'city'=>$this->data['Auth']['city'],
								'state'=>$this->data['Auth']['state'],
								'country'=>$this->data['Auth']['country'],
								'zip'=>$this->data['Auth']['zip'],
								'email'=>$this->data['Auth']['email']),
						'card'=> array(
								'type'=>$this->data['Auth']['type'],
								'number'=>$this->data['Auth']['number'],
								'expDate'=>$this->data['Auth']['expDate'],
								'cardValidationNum'=>$this->data['Auth']['cardValidationNum']));
			
			$hash_out = AuthsController::purgeNull($hash_in);
			
			$initilaize = &new LitleOnlineRequest();
			@$authorizationResponse = $initilaize->authorizationRequest($hash_out);
			$message= XmlParser::getAttribute($authorizationResponse,'litleOnlineResponse','message');
			$response = XmlParser::getNode($authorizationResponse,'response');
			$authMessage = XmlParser::getNode($authorizationResponse,'message');
			$litleTxnId = XmlParser::getNode($authorizationResponse,'litleTxnId');
			$this->request->data['Auth']['message'] = $message;
			$this->request->data['Auth']['response'] = $response;
			$this->request->data['Auth']['authMessage'] = $authMessage;
			$this->request->data['Auth']['litleTxnId'] = $litleTxnId;
			
			$this->Auth->create();
			
			if ($this->Auth->save($this->request->data)) {
				
				$this->Session->setFlash(__($message));
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
				
				$hash_in = array(
							'orderId'=> '4',
							'amount'=>$this->data['Auth']['amount'],
							'orderSource'=>'ecommerce',
							'billToAddress'=>array(
									'name'=>$this->data['Auth']['name'],
									'addressLine1'=>$this->data['Auth']['address1'],
									'city'=>$this->data['Auth']['city'],
									'state'=>$this->data['Auth']['state'],
									'country'=>$this->data['Auth']['country'],
									'zip'=>$this->data['Auth']['zip'],
									'email'=>$this->data['Auth']['email']),
							'card'=> array(
									'type'=>$this->data['Auth']['type'],
									'number'=>$this->data['Auth']['number'],
									'expDate'=>$this->data['Auth']['expDate'],
									'cardValidationNum'=>$this->data['Auth']['cardValidationNum']));
				$initilaize = &new LitleOnlineRequest();
				@$authorizationResponse = $initilaize->authorizationRequest($hash_in);
				//$message= XmlParser::getAttribute($authorizationResponse,'litleOnlineResponse','message');
				$this->Session->setFlash(__($message));
		
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Auth->read(null, $id);
		}
	}
	
	
	public function capture($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$hash_in = array('orderId'=> '4',
										'litleTxnId'=>$this->Auth->field('litleTxnId'),
										'amount'=>$this->data['Auth']['captureAmount'],
										'orderSource'=>'ecommerce');
			$initilaize = &new LitleOnlineRequest();
			@$captureResponse = $initilaize->captureRequest($hash_in);
			$captureMessage= XmlParser::getNode($captureResponse,'message');
			$captureLitleTxnId = XmlParser::getNode($captureResponse,'litleTxnId');
			$message= XmlParser::getAttribute($captureResponse,'litleOnlineResponse','message');
			
			$this->request->data['Auth']['message'] = $message;
			$this->request->data['Auth']['captureMessage'] = $captureMessage;
			$this->request->data['Auth']['captureLitleTxnId'] = $captureLitleTxnId;
			
			//$this->Auth->create();
			
			if ($this->Auth->save($this->request->data)) {
				
				$this->Session->setFlash(__($captureMessage));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Auth->read(null, $id);
		}
	}
	
	public function credit($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Auth->save($this->request->data)) {
	
	
				$hash_in = array(
								'litleTxnId'=>$this->Auth->field('captureLitleTxnId'),
								'amount'=>$this->data['Auth']['creditAmount']
								);
				$initilaize = &new LitleOnlineRequest();
				@$creditResponse = $initilaize->creditRequest($hash_in);
				$creditMessage= XmlParser::getNode($creditResponse,'message');
				//$captureMessage= XmlParser::getAttribute($captureResponse,'litleOnlineResponse','message');
				$this->Session->setFlash(__($creditMessage));
	
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

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

	/**
	 * purge Null method
	 *
	 * @returns array with no empty key values
	 */
	public function purgeNull($data_in, $data_out=NULL){

		foreach($data_in as $key => $value)
		{
			if (($value != NULL) && (!is_array($value)))
			{
				$data_out[$key] = $data_in[$key];
			}
			elseif(is_array($value))
			{
				$notEmpty = false;
				foreach ($value as $key2 => $value2){
						
					$notEmpty = $notEmpty || $value2;
				}
				if ($notEmpty){
					$data_out[$key] = $data_in[$key];
					AuthsController::purgeNull($value, $data_out[$key]);
				}

			}

		}
		return $data_out;
	}
	
	/**
	 * get Form Data method
	 *
	 * @return the string if not null
	 */
	function getFormData($string){
		if ($this->data['Auth'][$string] == '' || $this->data['Auth'][$string] == NULL){
			return NULL;
		}else{
			return $this->data['Auth'][$string];
		}
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
	 * add authorization method
	 *
	 * @returns message, authMessage, Response and ;litleTxnId to database
	 */
	public function add() {
		if ($this->request->is('post')) {
			$hash_in = array(
						'orderId'=> '123',
						'amount'=>$this->data['Auth']['amount'],
						'orderSource'=>'ecommerce',
						'billToAddress'=>array(
								'name'=>AuthsController::getFormData('name'),
								'addressLine1'=>AuthsController::getFormData('address1'),
								'city'=>AuthsController::getFormData('city'),
								'state'=>AuthsController::getFormData('state'),
								'country'=>'US',
								'zip'=>AuthsController::getFormData('zip')),
						'card'=> array(
								'type'=>AuthsController::getFormData('type'),
								'number'=>AuthsController::getFormData('number'),
								'expDate'=>AuthsController::getFormData('expDate'),
								'cardValidationNum'=>AuthsController::getFormData('cardValidationNum')));
				
			$hash_out = AuthsController::purgeNull($hash_in);
				
			$initilaize = &new LitleOnlineRequest();
			@$authorizationResponse = $initilaize->authorizationRequest($hash_out);
			$message= XmlParser::getAttribute($authorizationResponse,'litleOnlineResponse','message');
			$response = XmlParser::getNode($authorizationResponse,'response');
			$authMessage = XmlParser::getNode($authorizationResponse,'message');
			$authLitleTxnId = XmlParser::getNode($authorizationResponse,'litleTxnId');
			$this->request->data['Auth']['message'] = $message;
			$this->request->data['Auth']['response'] = $response;
			$this->request->data['Auth']['authMessage'] = $authMessage;
			$this->request->data['Auth']['transactionStatus'] = $authMessage;
			$this->request->data['Auth']['litleTxnId'] = $authLitleTxnId;
			$this->request->data['Auth']['authLitleTxnId'] = $authLitleTxnId;
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
							'orderId'=> $id,
							'amount'=>$this->data['Auth']['amount'],
							'orderSource'=>'ecommerce',
							'billToAddress'=>array(
									'name'=>$this->data['Auth']['name'],
									'addressLine1'=>$this->data['Auth']['address1'],
									'city'=>$this->data['Auth']['city'],
									'state'=>$this->data['Auth']['state'],
									'country'=>'US',
									'zip'=>$this->data['Auth']['zip']),
							'card'=> array(
									'type'=>$this->data['Auth']['type'],
									'number'=>$this->data['Auth']['number'],
									'expDate'=>$this->data['Auth']['expDate'],
									'cardValidationNum'=>$this->data['Auth']['cardValidationNum']));
				$initilaize = &new LitleOnlineRequest();
				@$authorizationResponse = $initilaize->authorizationRequest($hash_in);
				$message= XmlParser::getAttribute($authorizationResponse,'litleOnlineResponse','message');
				$this->Session->setFlash(__($message));

				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Auth->read(null, $id);
		}
	}

	/**
	* capture method
	*
	* @returns message, captureMessage, Response and litleTxnId to database
	*/
	public function capture($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		unset($this->request->data['Auth']['message']);
		#unset($this->request->data['Auth']['litleTxnId']);
		if ($this->request->is('post') || $this->request->is('put')) {
			$hash_in = array('orderId'=> $id,
										'partial'=>$this->data['Auth']['partial'],
										'litleTxnId'=>$this->Auth->field('litleTxnId'),
										'amount'=>$this->data['Auth']['captureAmount'],
										'orderSource'=>'ecommerce');
			$initilaize = &new LitleOnlineRequest();
			@$captureResponse = $initilaize->captureRequest($hash_in);
			$captureMessage= XmlParser::getNode($captureResponse,'message');
			$captureLitleTxnId = XmlParser::getNode($captureResponse,'litleTxnId');
			$message= XmlParser::getAttribute($captureResponse,'litleOnlineResponse','message');
			$this->request->data['Auth']['message'] = NULL;
			$this->request->data['Auth']['litleTxnId'] = NULL;
			$this->request->data['Auth']['transactionStatus'] = NULL;
			$this->request->data['Auth']['amount'] = $this->data['Auth']['captureAmount'];
			$this->request->data['Auth']['message'] = $message;
			$this->request->data['Auth']['litleTxnId'] = $captureLitleTxnId;
			$this->request->data['Auth']['captureMessage'] = $captureMessage;
			$this->request->data['Auth']['transactionStatus'] = $captureMessage;
			$this->request->data['Auth']['captureLitleTxnId'] = $captureLitleTxnId;
				
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

	/**
	* credit method
	*
	* @returns message, creditMessage, Response and litleTxnId to database
	*/
	public function credit($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
				
			$hash_in = array(
										'litleTxnId'=>$this->Auth->field('captureLitleTxnId'),
										'amount'=>$this->data['Auth']['creditAmount']
			);
			$initilaize = &new LitleOnlineRequest();
			@$creditResponse = $initilaize->creditRequest($hash_in);
			$creditMessage= XmlParser::getNode($creditResponse,'message');
			$creditLitleTxnId = XmlParser::getNode($creditResponse,'litleTxnId');
			$creditMessage= XmlParser::getNode($creditResponse,'message');
			$message= XmlParser::getAttribute($creditResponse,'litleOnlineResponse','message');
			$this->request->data['Auth']['message'] = NULL;
			$this->request->data['Auth']['litleTxnId'] = NULL;
			$this->request->data['Auth']['transactionStatus'] = NULL;
			$this->request->data['Auth']['amount'] = $this->data['Auth']['creditAmount'];
			$this->request->data['Auth']['message'] = $message;
			$this->request->data['Auth']['litleTxnId'] = $creditLitleTxnId;
			$this->request->data['Auth']['creditMessage'] = $creditMessage;
			$this->request->data['Auth']['transactionStatus'] = $creditMessage;
			$this->request->data['Auth']['creditLitleTxnId'] = $creditLitleTxnId;
				
			if ($this->Auth->save($this->request->data)) {

				$this->Session->setFlash(__($creditMessage));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Auth->read(null, $id);
		}
	}
	public function reAuth($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$hash_in = array(
							'litleTxnId'=>$this->Auth->field('litleTxnId')
			);
			$initilaize = &new LitleOnlineRequest();
			@$reAuthorizationResponse = $initilaize->authorizationRequest($hash_in);
			$reAuthMessage= XmlParser::getNode($reAuthorizationResponse,'message');
			$reAuthLitleTxnId = XmlParser::getNode($reAuthorizationResponse,'litleTxnId');
			$message= XmlParser::getAttribute($reAuthorizationResponse,'litleOnlineResponse','message');
			unset($this->request->data['Auth']['litleTxnId']);
			unset($this->request->data['Auth']['message']);
			unset($this->request->data['Auth']['transactionStatus']);
			$this->request->data['Auth']['message'] = $message;
			$this->request->data['Auth']['litleTxnId'] = $reAuthLitleTxnId;
			$this->request->data['Auth']['authMessage'] = $reAuthMessage;
			$this->request->data['Auth']['transactionStatus'] = $reAuthMessage;
			$this->request->data['Auth']['authLitleTxnId'] = $reAuthLitleTxnId;
		
			if ($this->Auth->save($this->request->data)) {
		
				$this->Session->setFlash(__($message));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Auth->read(null, $id);
		}
	}
	public function saleToken($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
				$hash_in = array(
								'orderId'=> $id,
								'amount'=>$this->data['Auth']['amount'],
								'orderSource'=>'ecommerce',
								'billToAddress'=>array(
										'name'=>AuthsController::getFormData('name'),
										'addressLine1'=>AuthsController::getFormData('address1'),
										'city'=>AuthsController::getFormData('city'),
										'state'=>AuthsController::getFormData('state'),
										'country'=>'US',
										'zip'=>AuthsController::getFormData('zip')),
								'token'=> array(
										'litleToken'=>$this->Auth->field('litleToken'),
										'expDate'=>AuthsController::getFormData('expDate'),
										'cardValidationNum'=>AuthsController::getFormData('cardValidationNum'),
										'type'=>AuthsController::getFormData('type')));
		
				$hash_out = AuthsController::purgeNull($hash_in);
		
				$initilaize = &new LitleOnlineRequest();
				@$saleResponse = $initilaize->saleRequest($hash_out);
				$message= XmlParser::getAttribute($saleResponse,'litleOnlineResponse','message');
				$response = XmlParser::getNode($saleResponse,'response');
				$saleMessage = XmlParser::getNode($saleResponse,'message');
				$saleLitleTxnId = XmlParser::getNode($saleResponse,'litleTxnId');
				$this->request->data['Auth']['message'] = $message;
				$this->request->data['Auth']['response'] = $response;
				$this->request->data['Auth']['saleMessage'] = $saleMessage;
				$this->request->data['Auth']['transactionStatus'] = $saleMessage;
				$this->request->data['Auth']['litleTxnId'] = $saleLitleTxnId;
				$this->request->data['Auth']['saleLitleTxnId'] = $saleLitleTxnId;
		
				$this->Auth->create();
				if ($this->Auth->save($this->request->data)) {
					$this->Session->setFlash(__($message));
					$this->redirect(array('action' => 'index'));
					} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Auth->read(null, $id);
		}
	}
		
	
	public function authReversal($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		
			$hash_in = array(
								'litleTxnId'=>$this->Auth->field('litleTxnId')
			);
			$initilaize = &new LitleOnlineRequest();
			@$authRevResponse = $initilaize->authReversalRequest($hash_in);
			$authRevMessage= XmlParser::getNode($authRevResponse,'message');
			$authRevLitleTxnId = XmlParser::getNode($authRevResponse,'litleTxnId');
			$message= XmlParser::getAttribute($authRevResponse,'litleOnlineResponse','message');
			$this->request->data['Auth']['message'] = NULL;
			$this->request->data['Auth']['litleTxnId'] = NULL;
			$this->request->data['Auth']['transactionStatus'] = NULL;
			$this->request->data['Auth']['authRevLitleTxnId'] = $authRevLitleTxnId;
			$this->request->data['Auth']['message'] = $message;
			$this->request->data['Auth']['litleTxnId'] = $authRevLitleTxnId;
			$this->request->data['Auth']['authRevMessage'] = $authRevMessage;
			$this->request->data['Auth']['transactionStatus'] = $authRevMessage;
			$this->request->data['Auth']['authRevLitleTxnId'] = $authRevLitleTxnId;
		
			if ($this->Auth->save($this->request->data)) {
		
				$this->Session->setFlash(__($message));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Auth->read(null, $id);
		}
	}
	public function sale() {
			if ($this->request->is('post')) {
				$hash_in = array(
								'orderId'=> $this->Auth->field('id'),
								'amount'=>$this->data['Auth']['amount'],
								'orderSource'=>'ecommerce',
								'billToAddress'=>array(
										'name'=>AuthsController::getFormData('name'),
										'addressLine1'=>AuthsController::getFormData('address1'),
										'city'=>AuthsController::getFormData('city'),
										'state'=>AuthsController::getFormData('state'),
										'country'=>'US',
										'zip'=>AuthsController::getFormData('zip')),
								'card'=> array(
										'type'=>AuthsController::getFormData('type'),
										'number'=>AuthsController::getFormData('number'),
										'expDate'=>AuthsController::getFormData('expDate'),
										'cardValidationNum'=>AuthsController::getFormData('cardValidationNum')));
		
				$hash_out = AuthsController::purgeNull($hash_in);
		
				$initilaize = &new LitleOnlineRequest();
				@$saleResponse = $initilaize->saleRequest($hash_out);
				$message= XmlParser::getAttribute($saleResponse,'litleOnlineResponse','message');
				$response = XmlParser::getNode($saleResponse,'response');
				$saleMessage = XmlParser::getNode($saleResponse,'message');
				$saleLitleTxnId = XmlParser::getNode($saleResponse,'litleTxnId');
				$this->request->data['Auth']['message'] = $message;
				$this->request->data['Auth']['response'] = $response;
				$this->request->data['Auth']['saleMessage'] = $saleMessage;
				$this->request->data['Auth']['transactionStatus'] = $saleMessage;
				$this->request->data['Auth']['litleTxnId'] = $saleLitleTxnId;
				$this->request->data['Auth']['saleLitleTxnId'] = $saleLitleTxnId;
		
				$this->Auth->create();
				if ($this->Auth->save($this->request->data)) {
					$this->Session->setFlash(__($message));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
				}
			}
	}
	public function token() {
		if ($this->request->is('post')) {
			$hash_in = array(
										'accountNumber'=>AuthsController::getFormData('number')
			);

			$hash_out = AuthsController::purgeNull($hash_in);
		
			$initilaize = &new LitleOnlineRequest();
			@$registerTokenResponse = $initilaize->registerTokenRequest($hash_out);
			$message= XmlParser::getAttribute($registerTokenResponse,'litleOnlineResponse','message');
			$response = XmlParser::getNode($registerTokenResponse,'response');
			$tokenMessage = XmlParser::getNode($registerTokenResponse,'message');
			$litleToken = XmlParser::getNode($registerTokenResponse,'litleToken');
			$tokenLitleTxnId = XmlParser::getNode($registerTokenResponse,'litleTxnId');
			$this->request->data['Auth']['message'] = $message;
			$this->request->data['Auth']['response'] = $response;
			$this->request->data['Auth']['tokenMessage'] = $tokenMessage;
			$this->request->data['Auth']['transactionStatus'] = $tokenMessage;
			$this->request->data['Auth']['litleTxnId'] = $tokenLitleTxnId;
			$this->request->data['Auth']['tokenLitleTxnId'] = $tokenLitleTxnId;
			$this->request->data['Auth']['litleToken'] = $litleToken;
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
	* void method
	*
	* @returns message, voidMessage, Response and litleTxnId to database
	*/
	public function void($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
					
			$hash_in = array(
							'litleTxnId'=>$this->Auth->field('litleTxnId')
			);
			$initilaize = &new LitleOnlineRequest();
			@$voidResponse = $initilaize->voidRequest($hash_in);
			$voidMessage= XmlParser::getNode($voidResponse,'message');
			$voidLitleTxnId = XmlParser::getNode($voidResponse,'litleTxnId');
			$message= XmlParser::getAttribute($voidResponse,'litleOnlineResponse','message');
			$this->request->data['Auth']['message'] = NULL;
			$this->request->data['Auth']['litleTxnId'] = NULL;
			$this->request->data['Auth']['transactionStatus'] = NULL;
			$this->request->data['Auth']['message'] = $message;
			$this->request->data['Auth']['litleTxnId'] = $voidLitleTxnId;
			$this->request->data['Auth']['voidMessage'] = $voidMessage;
			$this->request->data['Auth']['transactionStatus'] = $voidMessage;
			$this->request->data['Auth']['voidLitleTxnId'] = $voidLitleTxnId;
				
			if ($this->Auth->save($this->request->data)) {
				$this->Session->setFlash(__($voidMessage));
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

<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once realpath(dirname(__FILE__)) . '/../Lib/litle/LitleOnline.php';

App::uses('AppController', 'Controller');
/**
 * Tokens Controller
 *
 * @property Token $Token
 */
class TokensController extends AppController {


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
					TokensController::purgeNull($value, $data_out[$key]);
				}

			}

		}
		return $data_out;
	}

	function getFormData($string){
		if ($this->data['Token'][$string] == '' || NULL){
			return NULL;
		}else{
			return $this->data['Token'][$string];
		}
	}

	/**
	 * index method
	 *
	 *	 * @return void
	 */
	public function index() {
		$this->Token->recursive = 0;
		$this->set('tokens', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Token->id = $id;
		if (!$this->Token->exists()) {
			throw new NotFoundException(__('Invalid token'));
		}
		$this->set('token', $this->Token->read(null, $id));
	}

	/**
	 * add method
	 *registers a credit card number and returns a litleToken
	 */
	public function add() {
		if ($this->request->is('post')) {

			$hash_in = array(
						'orderId'=> '4',
						'accountNumber'=>TokensController::getFormData('number'));

			$hash_out = TokensController::purgeNull($hash_in);

			$initilaize = &new LitleOnlineRequest();
			@$tokenResponse = $initilaize->registerTokenRequest($hash_out);
			$message= XmlParser::getAttribute($tokenResponse,'litleOnlineResponse','message');
			$response = XmlParser::getNode($tokenResponse,'response');
			$tokenMessage = XmlParser::getNode($tokenResponse,'message');
			$litleToken = XmlParser::getNode($tokenResponse,'litleToken');
			$this->request->data['Token']['message'] = $message;
			$this->request->data['Token']['response'] = $response;
			$this->request->data['Token']['tokenMessage'] = $tokenMessage;
			$this->request->data['Token']['litleToken'] = $litleToken;

			$this->Token->create();

			if ($this->Token->save($this->request->data)) {

				$this->Session->setFlash(__($message));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		}
	}
	/**
	 * sale method
	 *
	 * @param string saleAmount, litleToken
	 * @return saleMessage, saleLitleTxnId
	 */
	public function sale($id = null) {
		if ($this->request->is('post')) {
			$this->Token->id = $id;
			if (!$this->Token->exists()) {
				throw new NotFoundException(__('Invalid auth'));
			}
			$hash_in = array(
							'orderId'=> '4',
							'amount'=>$this->data['Token']['saleAmount'],
							'orderSource'=>'ecommerce',
							'billToAddress'=>array(
									'name'=>TokensController::getFormData('name'),
									'addressLine1'=>TokensController::getFormData('address1'),
									'city'=>TokensController::getFormData('city'),
									'state'=>TokensController::getFormData('state'),
									'country'=>TokensController::getFormData('country'),
									'zip'=>TokensController::getFormData('zip'),
									'email'=>TokensController::getFormData('email')),
							'token'=> array(
									'litleToken'=>$this->Token->field('litleToken'),
									'expDate'=>TokensController::getFormData('expDate'),
									'cardValidationNum'=>TokensController::getFormData('cardValidationNum'),
									'type'=>TokensController::getFormData('type')));

			$hash_out = TokensController::purgeNull($hash_in);

			$initilaize = &new LitleOnlineRequest();
			@$saleResponse = $initilaize->authorizationRequest($hash_out);
			$message= XmlParser::getAttribute($saleResponse,'litleOnlineResponse','message');
			$saleMessage = XmlParser::getNode($saleResponse,'message');
			$litleTxnId = XmlParser::getNode($saleResponse,'litleTxnId');
			$this->request->data['Token']['message'] = $message;
			$this->request->data['Token']['saleMessage'] = $saleMessage;
			$this->request->data['Token']['saleLitleTxnId'] = $litleTxnId;

			if ($this->Token->save($this->request->data)) {

				$this->Session->setFlash(__($message));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Token could not be saved. Please, try again.'));
			}
		}
	}
	/**
	 * credit method
	 *
	 * @param string creditAmount, saleLitleTxnId
	 * @return creditMessage, creditLitleTxnId
	 */
	public function credit($id = null) {
		$this->Token->id = $id;
		if (!$this->Token->exists()) {
			throw new NotFoundException(__('Invalid Token'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

			$hash_in = array(
							'litleTxnId'=>$this->Token->field('saleLitleTxnId'),
							'amount'=>$this->data['Token']['creditAmount']
			);
			$initilaize = &new LitleOnlineRequest();
			@$creditResponse = $initilaize->creditRequest($hash_in);
			$message= XmlParser::getAttribute($creditResponse,'litleOnlineResponse','message');
			$creditLitleTxnId = XmlParser::getNode($creditResponse,'litleTxnId');
			$creditMessage= XmlParser::getNode($creditResponse,'message');
			$this->request->data['Token']['message'] = $message;
			$this->request->data['Token']['creditMessage'] = $creditMessage;
			$this->request->data['Token']['creditLitleTxnId'] = $creditLitleTxnId;

			if ($this->Token->save($this->request->data)) {

				$this->Session->setFlash(__($message));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Token->read(null, $id);
		}
	}

	/**
	 * void method
	 *
	 * @param string voidType
	 * @return voidMessage
	 */
	public function void($id = null) {
		$this->Token->id = $id;
		if (!$this->Token->exists()) {
			throw new NotFoundException(__('Invalid Token'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

			if ($this->data['Token']['voidType'] == 'sale'){
				$voidLitleTxnId = $this->Token->field('saleLitleTxnId');
			}
			elseif($this->data['Token']['voidType'] == 'credit'){
				$voidLitleTxnId = $this->Token->field('creditLitleTxnId');
			}
			else{
				$this->Session->setFlash(__('The transaction could not be voided. Please, try again.'));
				$voidLitleTxnId = 123;
			}

			$hash_in = array(
					'litleTxnId'=>$voidLitleTxnId
			);
			$initilaize = &new LitleOnlineRequest();
			@$voidResponse = $initilaize->voidRequest($hash_in);
			$voidMessage= XmlParser::getNode($voidResponse,'message');
			$message= XmlParser::getAttribute($voidResponse,'litleOnlineResponse','message');
			$this->request->data['Token']['voidMessage'] = $voidMessage;
			if ($this->Token->save($this->request->data)) {

				$this->Session->setFlash(__($message));

				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Token->read(null, $id);
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
		$this->Token->id = $id;
		if (!$this->Token->exists()) {
			throw new NotFoundException(__('Invalid Token'));
		}
		if ($this->Token->delete()) {
			$this->Session->setFlash(__('Token deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Token was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}

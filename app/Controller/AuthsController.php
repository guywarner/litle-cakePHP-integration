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
					$this->purgeNull($value, $data_out[$key]);
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

	function getOrderId()
	{
		return rand(0,50000);
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

	public function authView($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		$this->set('auth', $this->Auth->read(null, $id));
	}
	public function captureView($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		$this->set('auth', $this->Auth->read(null, $id));
	}
	public function creditView($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		$this->set('auth', $this->Auth->read(null, $id));
	}
	public function voidView($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		$this->set('auth', $this->Auth->read(null, $id));
	}
	public function reauthView($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		$this->set('auth', $this->Auth->read(null, $id));
	}
	public function authrevView($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		$this->set('auth', $this->Auth->read(null, $id));
	}
	public function tokenView($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		$this->set('auth', $this->Auth->read(null, $id));
	}
	public function tokenSaleView($id = null) {
		$this->Auth->id = $id;
		if (!$this->Auth->exists()) {
			throw new NotFoundException(__('Invalid auth'));
		}
		$this->set('auth', $this->Auth->read(null, $id));
	}
	public function saleView($id = null) {
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
		$this->request->data['Auth']['countries'] = $this->getCountryISO();
		if ($this->request->is('post')) {
			$hash_in = array(
						'orderId'=> $this->getOrderId(),
						'amount'=>$this->data['Auth']['amount'],
						'orderSource'=>'ecommerce',
						'billToAddress'=>array(
								'name'=>$this->getFormData('name'),
								'addressLine1'=>$this->getFormData('address1'),
								'city'=>$this->getFormData('city'),
								'state'=>$this->getFormData('state'),
								'country'=>$this->getFormData('country'),
								'zip'=>$this->getFormData('zip')),
						'card'=> array(
								'type'=>$this->getFormData('type'),
								'number'=>$this->getFormData('number'),
								'expDate'=>$this->getFormData('expDate'),
								'cardValidationNum'=>$this->getFormData('cardValidationNum')));

			$hash_out = $this->purgeNull($hash_in);

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
			$this->request->data['Auth']['amount'] = $this->data['Auth']['amount'];
			$this->request->data['Auth']['authAmount'] = $this->data['Auth']['amount'];
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
					'amount'=>($this->data['Auth']['partial'] == 1)? $this->data['Auth']['captureAmount']:$this->data['Auth']['amount'],			
					'litleTxnId'=>$this->Auth->field('litleTxnId'),
					'orderSource'=>'ecommerce');
			$initilaize = &new LitleOnlineRequest();
			@$captureResponse = $initilaize->captureRequest($hash_in);
			$captureMessage= XmlParser::getNode($captureResponse,'message');
			$captureLitleTxnId = XmlParser::getNode($captureResponse,'litleTxnId');
			$message= XmlParser::getAttribute($captureResponse,'litleOnlineResponse','message');
			$this->request->data['Auth']['message'] = NULL;
			$this->request->data['Auth']['litleTxnId'] = NULL;
			$this->request->data['Auth']['transactionStatus'] = NULL;
			$this->request->data['Auth']['amount'] = $this->data['Auth']['amount'];
			$this->request->data['Auth']['message'] = $message;
			$this->request->data['Auth']['litleTxnId'] = $captureLitleTxnId;
			$this->request->data['Auth']['captureMessage'] = $captureMessage;
			$this->request->data['Auth']['transactionStatus'] = $captureMessage;
			$this->request->data['Auth']['captureLitleTxnId'] = $captureLitleTxnId;
			$this->request->data['Auth']['captureAmount'] = ($this->data['Auth']['partial'] == 1)? $this->data['Auth']['captureAmount']:$this->data['Auth']['amount'];
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

				$this->Session->setFlash(__($message));
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
										'name'=>$this->getFormData('name'),
										'addressLine1'=>$this->getFormData('address1'),
										'city'=>$this->getFormData('city'),
										'state'=>$this->getFormData('state'),
										'country'=>$this->getFormData('country'),
										'zip'=>$this->getFormData('zip')),
								'token'=> array(
										'litleToken'=>$this->Auth->field('litleToken'),
										'expDate'=>$this->getFormData('expDate'),
										'cardValidationNum'=>$this->getFormData('cardValidationNum'),
										'type'=>$this->getFormData('type')));

			$hash_out = $this->purgeNull($hash_in);

			$initilaize = &new LitleOnlineRequest();
			@$saleResponse = $initilaize->saleRequest($hash_out);
			$message= XmlParser::getAttribute($saleResponse,'litleOnlineResponse','message');
			$response = XmlParser::getNode($saleResponse,'response');
			$saleMessage = XmlParser::getNode($saleResponse,'message');
			$saleLitleTxnId = XmlParser::getNode($saleResponse,'litleTxnId');
			$this->request->data['Auth']['message'] = $message;
			$this->request->data['Auth']['response'] = $response;
			#$this->request->data['Auth']['saleMessage'] = $saleMessage;
			$this->request->data['Auth']['transactionStatus'] = $saleMessage;
			$this->request->data['Auth']['litleTxnId'] = $saleLitleTxnId;
			$this->request->data['Auth']['tokenSaleLitleTxnId'] = $saleLitleTxnId;
			$this->request->data['Auth']['tokenSaleMessage'] = $saleMessage;

			$this->Auth->create();
			if ($this->Auth->save($this->request->data)) {
				$this->Session->setFlash(__($message));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The auth could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Auth->read(null, $id);
			$this->request->data['Auth']['countries'] = $this->getCountryISO();
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
		$this->request->data['Auth']['countries'] = $this->getCountryISO();
		if ($this->request->is('post')) {
			$hash_in = array(
								'orderId'=> $this->getOrderId(),
								'amount'=>$this->data['Auth']['amount'],
								'orderSource'=>'ecommerce',
								'billToAddress'=>array(
										'name'=>$this->getFormData('name'),
										'addressLine1'=>$this->getFormData('address1'),
										'city'=>$this->getFormData('city'),
										'state'=>$this->getFormData('state'),
										'country'=>$this->getFormData('country'),
										'zip'=>$this->getFormData('zip')),
								'card'=> array(
										'type'=>$this->getFormData('type'),
										'number'=>$this->getFormData('number'),
										'expDate'=>$this->getFormData('expDate'),
										'cardValidationNum'=>$this->getFormData('cardValidationNum')));

			$hash_out = $this->purgeNull($hash_in);

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
										'accountNumber'=>$this->getFormData('number')
			);

			$hash_out = $this->purgeNull($hash_in);

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
			$this->request->data['Auth']['countries'] = $this->getCountryISO();
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

	public function getCountryISO(){
		return $options = array('US'=>'United States',
		'AF'=>'Afghanistan',
		'AF'=>'Afghanistan',
		'AL'=>'Albania',
		'DZ'=>'Algeria',
		'AS'=>'American Samoa',
		'AD'=>'Andorra',
		'AO'=>'Angola',
		'AI'=>'Anguilla',
		'AQ'=>'Antarctica',
		'AG'=>'Antigua and Barbuda',
		'AR'=>'Argentina',
		'AM'=>'Armenia',
		'AW'=>'Aruba',
		'AU'=>'Australia',
		'AT'=>'Austria',
		'AZ'=>'Azerbaijan',
		'BS'=>'Bahamas',
		'BH'=>'Bahrain',
		'BD'=>'Bangladesh',
		'BB'=>'Barbados',
		'BY'=>'Belarus',
		'BE'=>'Belgium',
		'BZ'=>'Belize',
		'BJ'=>'Benin',
		'BM'=>'Bermuda',
		'BT'=>'Bhutan',
		'BO'=>'Bolivia',
		'BA'=>'Bosnia and Herzegovina',
		'BW'=>'Botswana',
		'BV'=>'Bouvet Island',
		'BR'=>'Brazil',
		'IO'=>'British Indian Ocean Territory',
		'BN'=>'Brunei Darussalam',
		'BG'=>'Bulgaria',
		'BF'=>'Burkina Faso',
		'BI'=>'Burundi',
		'KH'=>'Cambodia',
		'CM'=>'Cameroon',
		'CA'=>'Canada',
		'CV'=>'Cape Verde',
		'KY'=>'Cayman Islands',
		'CF'=>'Central African Republic',
		'TD'=>'Chad',
		'CL'=>'Chile',
		'CN'=>'China',
		'CX'=>'Christmas Island',
		'CC'=>'Cocos (Keeling) Islands',
		'CO'=>'Colombia',
		'KM'=>'Comoros',
		'CG'=>'Congo',
		'CD'=>'Congo, The Democratic Republic of The',
		'CK'=>'Cook Islands',
		'CR'=>'Costa Rica',
		'CI'=>'Cote D\'ivoire',
		'HR'=>'Croatia',
		'CU'=>'Cuba',
		'CY'=>'Cyprus',
		'CZ'=>'Czech Republic',
		'DK'=>'Denmark',
		'DJ'=>'Djibouti',
		'DM'=>'Dominica',
		'DO'=>'Dominican Republic',
		'EC'=>'Ecuador',
		'EG'=>'Egypt',
		'SV'=>'El Salvador',
		'GQ'=>'Equatorial Guinea',
		'ER'=>'Eritrea',
		'EE'=>'Estonia',
		'ET'=>'Ethiopia',
		'FK'=>'Falkland Islands (Malvinas)',
		'FO'=>'Faroe Islands',
		'FJ'=>'Fiji',
		'FI'=>'Finland',
		'FR'=>'France',
		'GF'=>'French Guiana',
		'PF'=>'French Polynesia',
		'TF'=>'French Southern Territories',
		'GA'=>'Gabon',
		'GM'=>'Gambia',
		'GE'=>'Georgia',
		'DE'=>'Germany',
		'GH'=>'Ghana',
		'GI'=>'Gibraltar',
		'GR'=>'Greece',
		'GL'=>'Greenland',
		'GD'=>'Grenada',
		'GP'=>'Guadeloupe',
		'GU'=>'Guam',
		'GT'=>'Guatemala',
		'GG'=>'Guernsey',
		'GN'=>'Guinea',
		'GW'=>'Guinea-bissau',
		'GY'=>'Guyana',
		'HT'=>'Haiti',
		'HM'=>'Heard Island and Mcdonald Islands',
		'VA'=>'Holy See (Vatican City State)',
		'HN'=>'Honduras',
		'HK'=>'Hong Kong',
		'HU'=>'Hungary',
		'IS'=>'Iceland',
		'IN'=>'India',
		'ID'=>'Indonesia',
		'IR'=>'Iran, Islamic Republic of',
		'IQ'=>'Iraq',
		'IE'=>'Ireland',
		'IM'=>'Isle of Man',
		'IL'=>'Israel',
		'IT'=>'Italy',
		'JM'=>'Jamaica',
		'JP'=>'Japan',
		'JE'=>'Jersey',
		'JO'=>'Jordan',
		'KZ'=>'Kazakhstan',
		'KE'=>'Kenya',
		'KI'=>'Kiribati',
		'KP'=>'Korea, Democratic People\'s Republic of',
		'KR'=>'Korea, Republic of',
		'KW'=>'Kuwait',
		'KG'=>'Kyrgyzstan',
		'LA'=>'Lao People\'s Democratic Republic',
		'LV'=>'Latvia',
		'LB'=>'Lebanon',
		'LS'=>'Lesotho',
		'LR'=>'Liberia',
		'LY'=>'Libyan Arab Jamahiriya',
		'LI'=>'Liechtenstein',
		'LT'=>'Lithuania',
		'LU'=>'Luxembourg',
		'MO'=>'Macao',
		'MK'=>'Macedonia, The Former Yugoslav Republic of',
		'MG'=>'Madagascar',
		'MW'=>'Malawi',
		'MY'=>'Malaysia',
		'MV'=>'Maldives',
		'ML'=>'Mali',
		'MT'=>'Malta',
		'MH'=>'Marshall Islands',
		'MQ'=>'Martinique',
		'MR'=>'Mauritania',
		'MU'=>'Mauritius',
		'YT'=>'Mayotte',
		'MX'=>'Mexico',
		'FM'=>'Micronesia, Federated States of',
		'MD'=>'Moldova, Republic of',
		'MC'=>'Monaco',
		'MN'=>'Mongolia',
		'ME'=>'Montenegro',
		'MS'=>'Montserrat',
		'MA'=>'Morocco',
		'MZ'=>'Mozambique',
		'MM'=>'Myanmar',
		'NA'=>'Namibia',
		'NR'=>'Nauru',
		'NP'=>'Nepal',
		'NL'=>'Netherlands',
		'AN'=>'Netherlands Antilles',
		'NC'=>'New Caledonia',
		'NZ'=>'New Zealand',
		'NI'=>'Nicaragua',
		'NE'=>'Niger',
		'NG'=>'Nigeria',
		'NU'=>'Niue',
		'NF'=>'Norfolk Island',
		'MP'=>'Northern Mariana Islands',
		'NO'=>'Norway',
		'OM'=>'Oman',
		'PK'=>'Pakistan',
		'PW'=>'Palau',
		'PS'=>'Palestinian Territory, Occupied',
		'PA'=>'Panama',
		'PG'=>'Papua New Guinea',
		'PY'=>'Paraguay',
		'PE'=>'Peru',
		'PH'=>'Philippines',
		'PN'=>'Pitcairn',
		'PL'=>'Poland',
		'PT'=>'Portugal',
		'PR'=>'Puerto Rico',
		'QA'=>'Qatar',
		'RE'=>'Reunion',
		'RO'=>'Romania',
		'RU'=>'Russian Federation',
		'RW'=>'Rwanda',
		'SH'=>'Saint Helena',
		'KN'=>'Saint Kitts and Nevis',
		'LC'=>'Saint Lucia',
		'PM'=>'Saint Pierre and Miquelon',
		'VC'=>'Saint Vincent and The Grenadines',
		'WS'=>'Samoa',
		'SM'=>'San Marino',
		'ST'=>'Sao Tome and Principe',
		'SA'=>'Saudi Arabia',
		'SN'=>'Senegal',
		'RS'=>'Serbia',
		'SC'=>'Seychelles',
		'SL'=>'Sierra Leone',
		'SG'=>'Singapore',
		'SK'=>'Slovakia',
		'SI'=>'Slovenia',
		'SB'=>'Solomon Islands',
		'SO'=>'Somalia',
		'ZA'=>'South Africa',
		'GS'=>'South Georgia and The South Sandwich Islands',
		'ES'=>'Spain',
		'LK'=>'Sri Lanka',
		'SD'=>'Sudan',
		'SR'=>'Suriname',
		'SJ'=>'Svalbard and Jan Mayen',
		'SZ'=>'Swaziland',
		'SE'=>'Sweden',
		'CH'=>'Switzerland',
		'SY'=>'Syrian Arab Republic',
		'TW'=>'Taiwan, Province of China',
		'TJ'=>'Tajikistan',
		'TZ'=>'Tanzania, United Republic of',
		'TH'=>'Thailand',
		'TL'=>'Timor-leste',
		'TG'=>'Togo',
		'TK'=>'Tokelau',
		'TO'=>'Tonga',
		'TT'=>'Trinidad and Tobago',
		'TN'=>'Tunisia',
		'TR'=>'Turkey',
		'TM'=>'Turkmenistan',
		'TC'=>'Turks and Caicos Islands',
		'TV'=>'Tuvalu',
		'UG'=>'Uganda',
		'UA'=>'Ukraine',
		'AE'=>'United Arab Emirates',
		'GB'=>'United Kingdom',
		'US'=>'United States',
		'UM'=>'United States Minor Outlying Islands',
		'UY'=>'Uruguay',
		'UZ'=>'Uzbekistan',
		'VU'=>'Vanuatu',
		'VE'=>'Venezuela',
		'VN'=>'Viet Nam',
		'VG'=>'Virgin Islands, British',
		'VI'=>'Virgin Islands, U.S.',
		'WF'=>'Wallis and Futuna',
		'EH'=>'Western Sahara',
		'YE'=>'Yemen',
		'ZM'=>'Zambia',
		'ZW'=>'Zimbabwe');
	}
}

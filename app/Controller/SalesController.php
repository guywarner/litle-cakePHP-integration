<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once realpath(dirname(__FILE__)) . '/../Lib/litle/LitleOnline.php';

App::uses('AppController', 'Controller');
/**
 * Sales Controller
 *
 * @property Sale $Sale
 */
class SalesController extends AppController {

	
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
						SalesController::purgeNull($value, $data_out[$key]);
					}
				
			}
				
		}
		return $data_out;
	}
	
	function getFormData($string){
		if ($this->data['Sale'][$string] == '' || NULL){
			return NULL;
		}else{
			return $this->data['Sale'][$string];
		}
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sale->recursive = 0;
		$this->set('sales', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Sale->id = $id;
		if (!$this->Sale->exists()) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$this->set('sale', $this->Sale->read(null, $id));
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
						'amount'=>$this->data['Sale']['amount'],
						'orderSource'=>'ecommerce',
						'billToAddress'=>array(
								'name'=>SalesController::getFormData('name'),
								'addressLine1'=>SalesController::getFormData('address1'),
								'city'=>SalesController::getFormData('city'),
								'state'=>SalesController::getFormData('state'),
								'country'=>SalesController::getFormData('country'),
								'zip'=>SalesController::getFormData('zip'),
								'email'=>SalesController::getFormData('email')),
						'card'=> array(
								'type'=>SalesController::getFormData('type'),
								'number'=>SalesController::getFormData('number'),
								'expDate'=>SalesController::getFormData('expDate'),
								'cardValidationNum'=>SalesController::getFormData('cardValidationNum')));
			
			$hash_out = SalesController::purgeNull($hash_in);
			
			$initilaize = &new LitleOnlineRequest();
			@$saleResponse = $initilaize->saleRequest($hash_out);
			$message= XmlParser::getAttribute($saleResponse,'litleOnlineResponse','message');
			$response = XmlParser::getNode($saleResponse,'response');
			$saleMessage = XmlParser::getNode($saleResponse,'message');
			$litleTxnId = XmlParser::getNode($saleResponse,'litleTxnId');
			$this->request->data['Sale']['message'] = $message;
			$this->request->data['Sale']['response'] = $response;
			$this->request->data['Sale']['saleMessage'] = $saleMessage;
			$this->request->data['Sale']['litleTxnId'] = $litleTxnId;
			
			$this->Sale->create();
			
			if ($this->Sale->save($this->request->data)) {
				
				$this->Session->setFlash(__($message));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale could not be saved. Please, try again.'));
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
		$this->Sale->id = $id;
		if (!$this->Sale->exists()) {
			throw new NotFoundException(__('Invalid sale'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sale->save($this->request->data)) {
				
				$hash_in = array(
							'orderId'=> '4',
							'amount'=>$this->data['Sale']['amount'],
							'orderSource'=>'ecommerce',
							'billToAddress'=>array(
									'name'=>$this->data['Sale']['name'],
									'addressLine1'=>$this->data['Sale']['address1'],
									'city'=>$this->data['Sale']['city'],
									'state'=>$this->data['Sale']['state'],
									'country'=>$this->data['Sale']['country'],
									'zip'=>$this->data['Sale']['zip'],
									'email'=>$this->data['Sale']['email']),
							'card'=> array(
									'type'=>$this->data['Sale']['type'],
									'number'=>$this->data['Sale']['number'],
									'expDate'=>$this->data['Sale']['expDate'],
									'cardValidationNum'=>$this->data['Sale']['cardValidationNum']));
				$initilaize = &new LitleOnlineRequest();
				@$saleResponse = $initilaize->saleRequest($hash_in);
				//$message= XmlParser::getAttribute($saleResponse,'litleOnlineResponse','message');
				$this->Session->setFlash(__($message));
		
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Sale->read(null, $id);
		}
	}
	
	
	
	public function credit($id = null) {
		$this->Sale->id = $id;
		if (!$this->Sale->exists()) {
			throw new NotFoundException(__('Invalid sale'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$hash_in = array(
											'litleTxnId'=>$this->Sale->field('litleTxnId'),
											'amount'=>$this->data['Sale']['creditAmount']
			);
			$initilaize = &new LitleOnlineRequest();
			@$creditResponse = $initilaize->creditRequest($hash_in);
			$creditMessage= XmlParser::getNode($creditResponse,'message');
			$creditLitleTxnId = XmlParser::getNode($creditResponse,'litleTxnId');
			$creditMessage= XmlParser::getNode($creditResponse,'message');
			//$captureMessage= XmlParser::getAttribute($captureResponse,'litleOnlineResponse','message');
			$this->request->data['Sale']['message'] = $message;
			$this->request->data['Sale']['creditMessage'] = $creditMessage;
			$this->request->data['Sale']['creditLitleTxnId'] = $creditLitleTxnId;
			
			if ($this->Sale->save($this->request->data)) {
	
				$this->Session->setFlash(__($creditMessage));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Sale->read(null, $id);
		}
	}
	
	public function void($id = null) {
		$this->Sale->id = $id;
		if (!$this->Sale->exists()) {
			throw new NotFoundException(__('Invalid sale'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->data['Sale']['voidType'] == 'sale'){
				$voidLitleTxnId = $this->Sale->field('litleTxnId');
			}
			elseif($this->data['Sale']['voidType'] == 'credit'){ 
				$voidLitleTxnId = $this->Sale->field('creditLitleTxnId');
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
			//$captureMessage= XmlParser::getAttribute($captureResponse,'litleOnlineResponse','message');
			
			if ($this->Sale->save($this->request->data)) {
	
				$this->Session->setFlash(__($voidMessage));
	
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Sale->read(null, $id);
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
		$this->Sale->id = $id;
		if (!$this->Sale->exists()) {
			throw new NotFoundException(__('Invalid sale'));
		}
		if ($this->Sale->delete()) {
			$this->Session->setFlash(__('Sale deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sale was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}



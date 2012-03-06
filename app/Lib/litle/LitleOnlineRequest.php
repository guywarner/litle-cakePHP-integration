<?php
/*
 * Copyright (c) 2011 Litle & Co.
*
* Permission is hereby granted, free of charge, to any person
* obtaining a copy of this software and associated documentation
* files (the "Software"), to deal in the Software without
* restriction, including without limitation the rights to use,
* copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the
* Software is furnished to do so, subject to the following
* conditions:
*
* The above copyright notice and this permission notice shall be
* included in all copies or substantial portions of the Software.
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND
* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
* OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
* HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
* WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
* OTHER DEALINGS IN THE SOFTWARE.
*/

//require_once realpath(dirname(__FILE__)) . '/LitleOnline.php';

class LitleOnlineRequest
{
	public function __construct()
	{
		$this->newXML = new LitleXmlMapper();
	}

	public function authorizationRequest($hash_in)
	{
		if (isset($hash_in['litleTxnId'])){
			$hash_out = array('litleTxnId'=> ($hash_in['litleTxnId']));
		}
		else {
			$hash_out = array(
			'orderId'=> Checker::requiredField($hash_in['orderId']),
			'amount'=>Checker::requiredField($hash_in['amount']),
			'orderSource'=>Checker::requiredField($hash_in['orderSource']),
			'customerInfo'=>(XMLFields::customerInfo($hash_in['customerInfo'])),
			'billToAddress'=>(XMLFields::contact($hash_in['billToAddress'])),
			'shipToAddress'=>(XMLFields::contact($hash_in['shipToAddress'])),
			'card'=> (XMLFields::cardType($hash_in['card'])),
			'paypal'=>(XMLFields::payPal($hash_in['paypal'])),
			'token'=>(XMLFields::cardTokenType($hash_in['token'])),
			'paypage'=>(XMLFields::cardPaypageType($hash_in['paypage'])),
			'billMeLaterRequest'=>(XMLFields::billMeLaterRequest($hash_in['billMeLaterRequest'])),
			'cardholderAuthentication'=>(XMLFields::fraudCheckType($hash_in['cardholderAuthentication'])),
			'processingInstructions'=>(XMLFields::processingInstructions($hash_in['processingInstructions'])),
			'pos'=>(XMLFields::pos($hash_in['pos'])),
			'customBilling'=>(XMLFields::customBilling($hash_in['customBilling'])),
			'taxBilling'=>(XMLFields::taxBilling($hash_in['taxBilling'])),
			'enhancedData'=>(XMLFields::enhancedData($hash_in['enhancedData'])),
			'amexAggregatorData'=>(XMLFields::amexAggregatorData($hash_in['amexAggregatorData'])),
			'allowPartialAuth'=>$hash_in['allowPartialAuth'],
			'healthcareIIAS'=>(XMLFields::healthcareIIAS($hash_in['healthcareIIAS'])),
			'filtering'=>(XMLFields::filteringType($hash_in['filtering'])),
			'merchantData'=>(XMLFields::filteringType($hash_in['merchantData'])),
			'recyclingRequest'=>(XMLFields::recyclingRequestType($hash_in['recyclingRequest'])));
		}

		$choice_hash = array($hash_out['card'],$hash_out['paypal'],$hash_out['token'],$hash_out['paypage']);
		$authorizationResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'authorization',$choice_hash);
		return $authorizationResponse;
	}

	public function saleRequest($hash_in)
	{
		$hash_out = array(
		'litleTxnId' => $hash_in['litleTxnId'],
		'orderId' =>Checker::requiredField($hash_in['orderId']),
		'amount' =>Checker::requiredField($hash_in['amount']),
		'orderSource'=>Checker::requiredField($hash_in['orderSource']),
		'customerInfo'=>XMLFields::customerInfo($hash_in['customerInfo']),
		'billToAddress'=>XMLFields::contact($hash_in['billToAddress']),
		'shipToAddress'=>XMLFields::contact($hash_in['shipToAddress']),
		'card'=> XMLFields::cardType($hash_in['card']),
		'paypal'=>XMLFields::payPal($hash_in['paypal']),
		'token'=>XMLFields::cardTokenType($hash_in['token']),
		'paypage'=>XMLFields::cardPaypageType($hash_in['paypage']),
		'billMeLaterRequest'=>XMLFields::billMeLaterRequest($hash_in['billMeLaterRequest']),
		'fraudCheck'=>XMLFields::fraudCheckType($hash_in['fraudCheck']),
		'cardholderAuthentication'=>XMLFields::fraudCheckType($hash_in['cardholderAuthentication']),
		'customBilling'=>XMLFields::customBilling($hash_in['customBilling']),
		'taxBilling'=>XMLFields::taxBilling($hash_in['taxBilling']),
		'enhancedData'=>XMLFields::enhancedData($hash_in['enhancedData']),
		'processingInstructions'=>XMLFields::processingInstructions($hash_in['processingInstructions']),
		'pos'=>XMLFields::pos($hash_in['pos']),
		'payPalOrderComplete'=> $hash_in['paypalOrderComplete'],
		'payPalNotes'=> $hash_in['paypalNotesType'],
		'amexAggregatorData'=>XMLFields::amexAggregatorData($hash_in['amexAggregatorData']),
		'allowPartialAuth'=>$hash_in['allowPartialAuth'],
		'healthcareIIAS'=>XMLFields::healthcareIIAS($hash_in['healthcareIIAS']),
		'filtering'=>XMLFields::filteringType($hash_in['filtering']),
		'merchantData'=>XMLFields::filteringType($hash_in['merchantData']),
		'recyclingRequest'=>XMLFields::recyclingRequestType($hash_in['recyclingRequest']));

		$choice_hash = array($hash_out['card'],$hash_out['paypal'],$hash_out['token'],$hash_out['paypage']);
		$choice2_hash= array($hash_out['fraudCheck'],$hash_out['cardholderAuthentication']);
		$saleResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'sale',$choice_hash,$choice_hash2);
		return $saleResponse;
	}

	public function authReversalRequest($hash_in)
	{
		$hash_out = array(
			'litleTxnId' => Checker::requiredField($hash_in['litleTxnId']),
			'amount' =>$hash_in['amount'],
			'payPalNotes'=>$hash_in['payPalNotes'],
			'actionReason'=>$hash_in['actionReason']);
		$authReversalResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'authReversal');
		return $authReversalResponse;
	}

	public function creditRequest($hash_in)
	{
		$hash_out = array(
					'litleTxnId' => XMLFields::returnArrayValue($hash_in, 'litleTxnId'),
					'orderId' =>XMLFields::returnArrayValue($hash_in, 'orderId'),
					'amount' =>XMLFields::returnArrayValue($hash_in, 'amount'),
					'orderSource'=>XMLFields::returnArrayValue($hash_in, 'orderSource'),
					'billToAddress'=>XMLFields::contact(XMLFields::returnArrayValue($hash_in, 'billToAddress')),
					'card'=>XMLFields::cardType(XMLFields::returnArrayValue($hash_in, 'card')),
					'paypal'=>XMLFields::credit_payPal(XMLFields::returnArrayValue($hash_in, 'paypal')),
					'token'=>XMLFields::cardTokenType(XMLFields::returnArrayValue($hash_in, 'token')),
					'paypage'=>XMLFields::cardPaypageType(XMLFields::returnArrayValue($hash_in, 'paypage')),
					'customBilling'=>XMLFields::customBilling(XMLFields::returnArrayValue($hash_in, 'customBilling')),
					'taxBilling'=>XMLFields::taxBilling(XMLFields::returnArrayValue($hash_in, 'taxBilling')),
					'billMeLaterRequest'=>XMLFields::billMeLaterRequest(XMLFields::returnArrayValue($hash_in, 'billMeLaterRequest')),
					'enhancedData'=>XMLFields::enhancedData(XMLFields::returnArrayValue($hash_in, 'enhancedData')),
					'processingInstructions'=>XMLFields::processingInstructions(XMLFields::returnArrayValue($hash_in, 'processingInstructions')),
					'pos'=>XMLFields::pos(XMLFields::returnArrayValue($hash_in, 'pos')),
					'amexAggregatorData'=>XMLFields::amexAggregatorData(XMLFields::returnArrayValue($hash_in, 'amexAggregatorData')),
					'payPalNotes' =>XMLFields::returnArrayValue($hash_in, 'payPalNotes')
		);

		$choice_hash = array($hash_out['card'],$hash_out['paypal'],$hash_out['token'],$hash_out['paypage']);
		$creditResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'credit',$choice_hash);
		return $creditResponse;
	}

	public function registerTokenRequest($hash_in)
	{
		$hash_out = array(
		'orderId'=>$hash_in['orderId'],
		'accountNumber'=>$hash_in['accountNumber'],
		'echeckForToken'=>XMLFields::echeckForTokenType($hash_in['echeckForToken']),
		'paypageRegistrationId'=>$hash_in['paypageRegistrationId']);

		$choice_hash = array($hash_out['accountNumber'],$hash_out['echeckForToken'],$hash_out['paypageRegistrationId']);
		$registerTokenResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'registerTokenRequest',$choice_hash);
		return $registerTokenResponse;
	}

	public function forceCaptureRequest($hash_in)
	{
		$hash_out = array(
		'orderId' =>Checker::requiredField($hash_in['orderId']),
		'amount' =>$hash_in['amount'],
		'orderSource'=>Checker::requiredField($hash_in['orderSource']),
		'billToAddress'=>XMLFields::contact($hash_in['billToAddress']),
		'card'=> XMLFields::cardType($hash_in['card']),
		'token'=>XMLFields::cardTokenType($hash_in['token']),
		'paypage'=>XMLFields::cardPaypageType($hash_in['paypage']),
		'customBilling'=>XMLFields::customBilling($hash_in['customBilling']),
		'taxBilling'=>XMLFields::taxBilling($hash_in['taxBilling']),
		'enhancedData'=>XMLFields::enhancedData($hash_in['enhancedData']),
		'processingInstructions'=>XMLFields::processingInstructions($hash_in['processingInstructions']),
		'pos'=>XMLFields::pos($hash_in['pos']),
		'amexAggregatorData'=>XMLFields::amexAggregatorData($hash_in['amexAggregatorData']));

		$choice_hash = array($hash_out['card'],$hash_out['paypal'],$hash_out['token'],$hash_out['paypage']);
		$forceCaptureResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'forceCapture',$choice_hash);
		return $forceCaptureResponse;
	}

	public function captureRequest($hash_in)
	{
		$hash_out = array(
		'partial'=>$hash_in['partial'],
	    'litleTxnId' => Checker::requiredField($hash_in['litleTxnId']),
		'amount' =>($hash_in['amount']),
		'enhancedData'=>XMLFields::enhancedData($hash_in['enhancedData']),
		'processingInstructions'=>XMLFields::processingInstructions($hash_in['processingInstructions']),
		'payPalOrderComplete'=>$hash_in['payPalOrderComplete'],
		'payPalNotes' =>$hash_in['payPalNotes']);
		echo "/$hash_out in captureRequest is: ";
		var_dump($hash_out);
		echo "<br>";
		$captureResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'capture');
		echo "/$captureResponse is: ";
		var_dump($captureResponse);
		echo "<br>";
		return $captureResponse;
	}

	public function captureGivenAuthRequest($hash_in)
	{

		$hash_out = array(
		'orderId'=>Checker::requiredField($hash_in['orderId']),
		'authInformation'=>XMLFields::authInformation($hash_in['authInformation']),
		'amount' =>Checker::requiredField($hash_in['amount']),
		'orderSource'=>Checker::requiredField($hash_in['orderSource']),
		'billToAddress'=>XMLFields::contact($hash_in['billToAddress']),
		'shipToAddress'=>XMLFields::contact($hash_in['shipToAddress']),
		'card'=> XMLFields::cardType($hash_in['card']),
		'token'=>XMLFields::cardTokenType($hash_in['token']),
		'paypage'=>XMLFields::cardPaypageType($hash_in['paypage']),
		'customBilling'=>XMLFields::customBilling($hash_in['customBilling']),
		'taxBilling'=>XMLFields::taxBilling($hash_in['taxBilling']),
		'billMeLaterRequest'=>XMLFields::billMeLaterRequest($hash_in['billMeLaterRequest']),
		'enhancedData'=>XMLFields::enhancedData($hash_in['enhancedData']),
		'processingInstructions'=>XMLFields::processingInstructions($hash_in['processingInstructions']),
		'pos'=>XMLFields::pos($hash_in['pos']),
		'amexAggregatorData'=>XMLFields::amexAggregatorData($hash_in['amexAggregatorData']));


		$choice_hash = array($hash_out['card'],$hash_out['token'],$hash_out['paypage']);
		$captureGivenAuthResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'captureGivenAuth',$choice_hash);
		return $captureGivenAuthResponse;
	}

	public function echeckRedepositRequest($hash_in)
	{
		$hash_out = array(
		'litleTxnId' => Checker::requiredField($hash_in['litleTxnId']),
		'echeck'=>XMLFields::echeckType($hash_in['echeck']),
		'echeckToken'=>XMLFields::echeckTokenType($hash_in['echeckToken']));

		$choice_hash = array($hash_out['echeck'],$hash_out['echeckToken']);
		$echeckRedepositResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'echeckRedeposit',$choice_hash);
		return $echeckRedepositResponse;
	}

	public function echeckSaleRequest($hash_in)
	{
		$hash_out = array(
		'litleTxnId'=>$hash_in['litleTxnId'],
		'orderId'=>$hash_in['orderId'],
		'verify'=>$hash_in['verify'],
		'amount'=>$hash_in['amount'],
		'orderSource'=>$hash_in['orderSource'],
		'billToAddress'=>XMLFields::contact($hash_in['billToAddress']),
		'shipToAddress'=>XMLFields::contact($hash_in['shipToAddress']),
		'echeck'=>XMLFields::echeckType($hash_in['echeck']),
		'echeckToken'=>XMLFields::echeckTokenType($hash_in['echeckToken']),
		'customBilling'=>XMLFields::customBilling($hash_in['customBilling']));

		$choice_hash = array($hash_out['echeck'],$hash_out['echeckToken']);

		$echeckSaleResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'echeckSale',$choice_hash);
		return $echeckSaleResponse;
	}

	public function echeckCreditRequest($hash_in)
	{
		$hash_out = array(
			'litleTxnId'=>$hash_in['litleTxnId'],
			'orderId'=>$hash_in['orderId'],
			'amount'=>$hash_in['amount'],
			'orderSource'=>$hash_in['orderSource'],
			'billToAddress'=>XMLFields::contact($hash_in['billToAddress']),
			'echeck'=>XMLFields::echeckType($hash_in['echeck']),
			'echeckToken'=>XMLFields::echeckTokenType($hash_in['echeckToken']),
			'customBilling'=>XMLFields::customBilling($hash_in['customBilling']));

		$choice_hash = array($hash_out['echeck'],$hash_out['echeckToken']);
		$echeckCreditResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'echeckCredit',$choice_hash);
		return $echeckCreditResponse;
	}

	public function echeckVerificationRequest($hash_in)
	{
		$hash_out = array(
			'litleTxnId'=>$hash_in['litleTxnId'],
			'orderId'=>Checker::requiredField($hash_in['orderId']),
			'amount'=>Checker::requiredField($hash_in['amount']),
			'orderSource'=>Checker::requiredField($hash_in['orderSource']),
			'billToAddress'=>XMLFields::contact($hash_in['billToAddress']),
			'echeck'=>XMLFields::echeckType($hash_in['echeck']),
			'echeckToken'=>XMLFields::echeckTokenType($hash_in['echeckToken']));


		$choice_hash = array($hash_out['echeck'],$hash_out['echeckToken']);
		$choice_hash = array($hash_out['echeck'],$hash_out['echeckToken']);
		$echeckVerificationResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'echeckVerification',$choice_hash);
		return $echeckVerificationResponse;
	}

	public function voidRequest($hash_in)
	{
		$hash_out = array(
		'litleTxnId' => Checker::requiredField($hash_in['litleTxnId']),
	    'processingInstructions'=>XMLFields::processingInstructions($hash_in['processingInstructions']));

		$voidResponse = LitleOnlineRequest::processRequest($hash_out,$hash_in,'void');
		return $voidResponse;
	}

	private function overideConfig($hash_in)
	{
		$hash_out = array(
		'user'=>$hash_in['user'],
		'password'=>$hash_in['password'],
		'merchantId'=>$hash_in['merchantId'],
		'reportGroup'=>$hash_in['reportGroup'],
		'id'=>$hash_in['id'],
		'version'=>$hash_in['version']);
		return $hash_out;
	}

	private function processRequest($hash_out, $hash_in, $type, $choice1 = null, $choice2 = null)
	{
		$hash_config = LitleOnlineRequest::overideconfig($hash_in);
		Checker::choice($choice1);
		Checker::choice($choice2);
		$request = Obj2xml::toXml($hash_out,$hash_config, $type);
		$litleOnlineResponse = $this->newXML->request($request);
		return $litleOnlineResponse;
	}



}


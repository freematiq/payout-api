<?php
/**
 * Примеры запросы к системе Payin-Payout
 *
 * @author Gregory Manuylov
 * Date: 27.05.14
 * Time: 12:37
 */

include './PayOut.php';

$gate = new PayOut();
$gate->setPoint('');				//	не забыть прописать идентификатор пользователя, обязательно в кавычках

//	баланс
$balance = $gate->getBalance();

//	баланс для всех валют
$balance = $gate->getBalance(PayOut::CURRENCY_ALL);

//	список провайдеров
$resp = $gate->getProviders();
//	вернет список правайдеров. у каждого сервиса есть набор полей field, их нужно передавать при проверки и проведении платежа в системе

$payment = array(
	'payment_id'	=> 1,	//	id платежа в Вашей системе
	'service_id'	=> 1008,			//	сервис проведения $gate->getProviders()
	'fields'		=>					//	поля, что указуны в $gate->getProviders() для сервиса
		array(
			'phone'=> 'номeр телефона',
		),
	'amount'		=> 15,				//	сумма на счет клиента
);

$payment = $gate->verifyPayment($payment);

//	создаем платеж
$payment = array(
	'payment_id'	=> 1,	//	id платежа в Вашей системе
	'service_id'	=> 1008,			//	сервис проведения $gate->getProviders()
	'fields'		=>					//	поля, что указуны в $gate->getProviders() для сервиса
		array(
			'phone'=> 'номeр телефона',
		),
	'amount'		=> 15,				//	сумма на счет клиента
	'data'			=> strftime('%F %X', time()),
	'comment'		=> 'mobile 1'		//	комментарий платежа
);

$payment = $gate->createPayment($payment);

//	проверяем статус что $payment
$uid = ;
$paymentStatus = $gate->getPaymentStatus($uid);

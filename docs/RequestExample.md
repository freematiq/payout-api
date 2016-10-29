# Примеры кода отправки запросов к системе Payin-Payout

[Запрос на получение списка провайдеров](GetProvidersExample.md)

```
<?php

use Freematiq\PayOut;

$gate = new PayOut();
$gate->setPoint(''); //	не забыть прописать идентификатор пользователя, обязательно в кавычках

// баланс
$balance = $gate->getBalance();

// баланс для всех валют
$balance = $gate->getBalance(PayOut::CURRENCY_ALL);

$payment = array(
    'payment_id'    => 1, // id платежа в Вашей системе
    'service_id'    => 1008, // сервис проведения $gate->getProviders()
    'fields'        => array( // поля, что указаны в $gate->getProviders() для сервиса
        'phone' => 'номeр телефона',
    ),
    'amount'        => 15, // сумма на счет клиента
);

$payment = $gate->verifyPayment($payment);

// создаем платеж
$payment = array(
    'payment_id'    => 1, // id платежа в Вашей системе
    'service_id'    => 1008, // сервис проведения $gate->getProviders()
    'fields'        => array( // поля, что указуны в $gate->getProviders() для сервиса
        'phone' => 'номeр телефона',
    ),
    'amount'        => 15, // сумма на счет клиента
    'data'          => strftime('%F %X', time()),
    'comment'       => 'mobile 1' // комментарий платежа
);

$payment = $gate->createPayment($payment);

// проверяем статус, что $payment
$uid = ;
$paymentStatus = $gate->getPaymentStatus($uid);
```

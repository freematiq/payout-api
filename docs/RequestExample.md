# Примеры кода отправки запросов к системе Payin-Payout

[Запрос на получение списка провайдеров](GetProvidersExample.md)

[Запрос на получение баланса учётной записи](GetBalanceExample.md)

[Запрос на проверку данных платежа](VerifyPaymentExample.md)

[Запрос на создание платежа](CreatePaymentExample.md)

```
<?php

use Freematiq\PayOut;

$gate = new PayOut();
$gate->setPoint(''); //	не забыть прописать идентификатор пользователя, обязательно в кавычках

// проверяем статус, что $payment
$uid = ;
$paymentStatus = $gate->getPaymentStatus($uid);
```

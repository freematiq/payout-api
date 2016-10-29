# Пример кода для проверки данных платежа

```php
<?php

use Freematiq\PayOut;

$gate = new PayOut();

/*
 * Необходимо прописать идентификатор пользователя, обязательно в кавычках. 
 */
$gate->setPoint('DDDD');

$payment = [
    //Идентификатор платежа в Вашей системе.
    'payment_id'    => 1,
    //Идентификатор сервиса проведения, который можно получить выполнив запрос $gate->getProviders().
    'service_id'    => 1008,
     //Поля для сервиса, список которых можно получить выполнив запрос $gate->getProviders().
    'fields'        => [ 
        'phone' => '79998887766',
    ],
    //сумма на счет клиента
    'amount'        => 15,
];

$payment = $gate->verifyPayment($payment);
```

Данный запрос вернет xml который содержит информацию о результате проверки данных.

Если все данные были указаны корректно, то будет получен такой ответ:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<response result="0">
    <action id="Payments.verifyPayment" result="0">
        <payment id="1" result="0" state="0"/>
    </action>
</response>
```

##Примеры ошибок

Был передан некорректный набор полей:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<response result="0">
    <action id="Payments.verifyPayment" result="0">
        <payment result="2" status="2"/>
    </action>
</response>
```

Такой идентификатор уже был использован ранее:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<response result="0">
    <action id="Payments.verifyPayment" result="0">
        <payment result="115" status="2" message="Платеж с client_id(1) уже существует"/>
    </action>
</response>
```
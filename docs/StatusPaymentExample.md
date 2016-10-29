# Пример кода для запроса состояния платежа

```php
<?php

use Freematiq\PayOut;

$gate = new PayOut();

/*
 * Необходимо прописать идентификатор пользователя, обязательно в кавычках. 
 */
$gate->setPoint('DDDD');

$resp = $gate->getPaymentStatus('123456-013494');
```

Данный запрос вернет xml который содержит информацию о состоянии платежа.

Если платёж был успешно оплачен, то будет получен такой ответ:

```xml
<response id="Agents.getPaymentStatus" result="0">
    <action>
        <payment uid="123456-013494" result="0" status="1" message="Платеж успешно проведен"/>
    </action>
</response>
```

Для запроса состояния платежа следует использовать идентификатор который был получен
при [создании платежа](CreatePaymentExample.md).

##Примеры ошибок

Передан некорректный идентификатор платежа:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<response id="Agents.error" result="116" message="Платеж не найден"/>
```
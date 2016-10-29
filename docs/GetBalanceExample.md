# Пример кода для получения баланса учётной записи

```php
<?php

use Freematiq\PayOut;

$gate = new PayOut();

/*
 * Необходимо прописать идентификатор пользователя, обязательно в кавычках. 
 */
$gate->setPoint('DDDD');

/*
 * Получение баланса. 
 */
$balance = $gate->getBalance();
```

Данный запрос вернет xml с рублёвым балансом.

```xml
<?xml version="1.0" encoding="UTF-8"?>
<response id="Agents.getBalance" result="0">
    <action>
        <balance currency="643">42</balance>
    </action>
</response>
```

Если требуется получить баланс всех доступных валют, то следует выполнить такой запрос.

```php
/*
 * Получение баланса для всех валют. 
 */
$resp = $gate->getBalance(PayOut::CURRENCY_ALL);
```

Данный запрос вернет xml с балансом для всех доступных валют.

```xml
<?xml version="1.0" encoding="UTF-8"?>
<response id="Agents.getBalance" result="0">
    <action>
        <balance currency="643">42</balance>
        <balance currency="840">100</balance>
        <balance currency="978">0.00</balance>
    </action>
</response>
```
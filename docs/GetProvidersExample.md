# Пример кода для получения списка доступных провайдеров

```php
<?php

use Freematiq\PayOut;

$gate = new PayOut();
/*
 * Не забыть прописать идентификатор пользователя, обязательно в кавычках. 
 */
$gate->setPoint('DDDD');

/*
 * Получить список провайдеров. 
 */
$resp = $gate->getProviders();
```

Данный запрос вернет xml со списком провайдеров. у каждого сервиса есть набор полей field, их нужно передавать при 
проверке данных платежа и проведении платежа в системе.

```xml
<?xml version="1.0" encoding="UTF-8"?>
<response result="0">
    <action id="Payments.getProviders" result="0" user_provider="DDDD">
        <provider fullName="Qiwi Кошелек" groupId="30" id="5002" shortName="Qiwi Кошелек"
                  icon="/images/services/service_icon_15_normal.png"
                  icon_hires="/images/services/service_icon_hd_15_big.png">
            <fields>
                <field name="account" title="Аккаунт" type="text"
                       description="Укажите номер телефона в международном формате без +">
                    <validator regexp="^\d{10,12}$"/>
                </field>
            </fields>
            <commissions>
                <commission currency="643" minAmount="10" maxAmount="75000">
                    <range from="10" type="0" value="2.85"/>
                </commission>
            </commissions>
            <tag_list/>
        </provider>
        <!--остальные провайдеры-->
    </action>
</response>
```
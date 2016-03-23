#Информация о работе с сервисом "Мобильные операторы, весь МИР"

Данный сервис является специфичным в том плане что пополнение счетов мобильных телефонов возможно только на 
фиксированную сумму.

Ещё одним специфичным моментом яляется то что списание средств при работе с этим сервисом производится исключительно
с долларового счёта.

##Алгоритм работы с сервисом

Основное отличие в работе с данным сервисом заключается в необходимости предварительно узнать информацию о доступных 
к пополнению суммам. 

Мы совершаем запрос по API чтобы узнать эту инфрмацию:

###XML запроса
```
<?xml version="1.0" encoding="UTF-8"?> 
<request> 
	<action id="Payments.getPrecheckStatus" > 
		<tocheck phone="+79234567890" service="9999" /> 
	</action> 
</request>
```

###PHP-код для выполнения запроса в случае использования данного API
```
$gate = new PayOut();
$gate->setPoint('8888'); //идентификатор пользователя

$payment = [
    'service_id'	=> 9999, //идентификатор сервиса
    'phone'=> '+79234567890', //номер телефона
];

$xml_answer = $gate->getPreCheckStatus($payment); //получение xml с результатами запроса
```

В ответ будет возвращён XML следующего вида:

###XML содержащий информацию о суммах пополнения
```
<?xml version="1.0" encoding="UTF-8"?>
<response id="Agents.getPrecheckStatus" result="0">
    <action>
        <country>Russia</country>
        <operator>Megafon-Siberia Russia</operator>
        <coupon_list>
            <coupon cost="0.88USD" charge="0.82USD">50RUB</coupon>
            <coupon cost="1.73USD" charge="1.62USD">100RUB</coupon>
            <coupon cost="1.9USD" charge="1.78USD">110RUB</coupon>
            <coupon cost="2.59USD" charge="2.42USD">150RUB</coupon>
            <coupon cost="3.44USD" charge="3.22USD">200RUB</coupon>
            <coupon cost="3.79USD" charge="3.54USD">220RUB</coupon>
            <coupon cost="5.16USD" charge="4.82USD">300RUB</coupon>
            <coupon cost="6.01USD" charge="5.62USD">350RUB</coupon>
            <coupon cost="6.87USD" charge="6.42USD">400RUB</coupon>
            <coupon cost="8.58USD" charge="8.02USD">500RUB</coupon>
            <coupon cost="17.13USD" charge="16.02USD">1000RUB</coupon>
            <coupon cost="34.25USD" charge="32.02USD">2000RUB</coupon>
        </coupon_list>
    </action>
</response>
```

Далее логика совершения платежа такая же как и в случае других сервисов - проверка информации о платеже, отправка 
запроса на оплату, проверка статуса платежа.

##Проверка информации

###XML запроса для проверки информации

```
<?xml version="1.0" encoding="UTF-8"?>
<request>
    <action id="Payments.verifyPayment">
        <payment id="10020">
            <serviceId>9999</serviceId>
            <fields>
                <account_phone_number>+79234567890</account_phone_number>
                <coupon_amount>50RUB</coupon_amount>
            </fields>
            <amount>0.82</amount>
            <currency>840</currency>
        </payment>
    </action>
</request>
```

###PHP-код для выполнения запроса в случае использования данного API

```
$payment = [
    'payment_id' => 10020,
    'service_id' => 9999,
    'fields' =>
        [
            'account_phone_number' => '+79234567890',
            'coupon_amount' => '50RUB',
        ],
    'amount' => 0.82,
    'currency' => 840,
];

$xml_answer = $gate->verifyPayment($payment);
```

Следует обратить внимание, что значение параметра 'coupon_amount' принимает значение купона, а в качестве суммы платежа 
указывается сумма зачисления в долларах. Также обязательным к заполнению является поле суммы, потому как данный
сервис работает только в долларах.

Если было получено подтверждение, что информация корректна, можно отправлять запрос на совершение платежа. И далее все
операции производятся аналогично всем прочим сервисам.
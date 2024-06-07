[Русская версия](#Модуль-оплаты-begateway-для-joomla-3x-и-joomshopping-4x)

# beGateway payment module for Joomla 3.x and JoomShopping 4.x/5.x

## System requirements

* PHP 5.6+
* [cURL extension](http://php.net/manual/en/book.curl.php)
* [Joomla](http://www.joomla.org/download.html) 3.x (the module was tested with version 3.9.22)
* [JoomShopping](http://joomshopping.pro/download/component.html) 4.x/5.x (the module was tested with version 4.18.5/5.4.0)

## The module installation

1. [Download joomshopping-begateway.zip](https://github.com/beGateway/joomshopping-payment-module/blob/master/joomshopping-begateway.zip?raw=true)
2. Go to Joomla's administration panel
3. Go to extension manager for JoomShopping (arrow #1)
  ![go to extension manager](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/go_to_extensions_manager.png)
4. Install the module package
  1. Open file upload dialogue (arrow #1)
  2. Select the module package file saved at the step 1.
  3. Upload and install the module (arrow #2)
  ![upload and install plugin](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/upload_and_install_plugin.png)

## The module configuration

1. Go to Joomla's administration panel
2. Go to the panel "Options" of JoomShopping (arrow #1)
  ![go to joomshop options](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/go_to_options.png)
3. Go to payment methods list (arrow #1)
  ![go to payment methods](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/go_to_payment_methods.png)
4. Press "Edit" button (arrow #1)
  ![go to edit payment method form](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/go_to_edit_payment_method_form.png)
5. Configure the module
  1. Open "Config" tab (arrow #1)
  2. Fill the settings form
  4. Save the payment method and close the form (arrow #2)

  ![edit payment method](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/edit_payment_method.png)
6. Publish the payment method
  1. Select the payment method in payment methods list (arrow #1)
  2. Publish it (arrow #2)
  ![publish payment method](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/publish_payment_method.png)

## Uninstall the module

1. Go to Joomla's administration panel
2. Go to the panel "Options" of JoomShopping (arrow #1)
  ![go to joomshop options](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/go_to_options.png)
3. Go to payment methods list (arrow #1)
  ![go to payment methods](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/go_to_payment_methods.png)
4. Delete the payment method
  1. Select the payment method in payment methods list (arrow #1)
  2. Delete the payment method (arrow #2)
  ![delete payment method](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/delete_payment_method.png)
5. To completly remove the module you have to delete files and folders in your Joomla's directory:
  * `components/vendor`
  * `components/com_jshopping/payments/pm_begateway`
  * `components/com_jshopping/lang/pm_begateway`

## Test data

If you setup the module with values as follows:

  * Payment page domain __checkout.begateway.com__
  * Shop Id __361__
  * Shop secret key __b8647b68898b084b836474ed8d61ffe117c9a01168d867f24953b776ddcb134d__
  * Check __Enable test mode__

Use the following test card to make successful test payment:

  * Card number: 4200000000000000
  * Name on card: JOHN DOE
  * Card expiry date: 01/30
  * CVC: 123

Use the following test card to make failed test payment:

  * Card number: 4005550000000019
  * Name on card: JOHN DOE
  * Card expiry date: 01/30
  * CVC: 123

## Widget style

### Styles that are being used by the widget

| Style name               |
|--------------------------|
| widget                   |
| header                   |
| headerPrice              |
| headerDescription        |
| headerDescriptionText    |
| headerClose              |
| footer                   |
| footerText               |
| footerLink               |
| footerSecurity           |
| main                     |
| methodsMenu              |
| methodsMenuText          |
| methodsMenuCard          |
| methodsMenuCardText      |
| methodsMenuList          |
| methodsMenuListMethod    |
| methodsMenuGrid          |
| methodsMenuGridMethod    |
| cardsMenu                |
| cardsMenuText            |
| cardsMenuCard            |
| cardsMenuCardText        |
| card                     |
| cardSides                |
| cardFace                 |
| cardFaceContent          |
| cardBack                 |
| cardBackMagneticLine     |
| cardBackCVC              |
| cardBackCVCText          |
| cardBackCVCInput         |
| cardPoints               |
| cardCustomer             |
| cardCustomerField        |
| cardButton               |
| eripContent              |
| eripTitle                |
| eripOrder                |
| eripOrderTitle           |
| eripOrderNumber          |
| eripBanks                |
| eripBanksTitle           |
| eripQRCode               |
| eripBanksComment         |
| eripBanksLinks           |
| eripBanksBank            |
| eripBanksMore            |
| paymentResult            |
| paymentResultStatus      |
| paymentResultStatusText  |
| paymentResultDetails     |
| paymentResultDetailsText |
| paymentResultButton      |
| method                   |
| methodContent            |
| methodTitle              |
| methodForm               |
| methodButton             |
| methodWaiting            |
| phoneLabel               |
| inputGroup               |
| inputGroupField          |
| inputGroupSelect         |
| stepBack                 |
| stepBackText             |

### Customizable CSS properties

The widget supports only properties listed below.

| Property        | Equal CSS property           |
|-----------------|------------------------------|
| color           | color                        |
| backgroundColor | background-color             |
| border          | border                       |
| borderRadius    | border-radius                |
| fontFamily      | font-family                  |
| fontSize        | font-size                    |
| fontSmoothing   | font-smoothing               |
| fontStyle       | font-style                   |
| fontVariant     | font-variant                 |
| fontWeight      | font-weight                  |
| lineHeight      | line-height                  |
| letterSpacing   | letter-spacing               |
| margin          | margin                       |
| padding         | padding                      |
| textAlign       | text-align                   |
| textDecoration  | text-decoration              |
| textShadow      | text-shadow                  |
| textTransform   | text-transform               |

Values of CSS properties may accept values compatible with CSS syntax.

You may use a browser Developer Tools (Inspect element) to know what CSS elements are in use and how they are nested.

Example

```javascript
header: {
  backgroundColor: '#fff',
  border: 'none'
},
headerPrice: {
  color: '#fff'
},
footer: {
  backgroundColor: '#fff',
  border: 'none'
},
cardButton: {
  backgroundColor: '#26d893',
  border: 'none'
},
methodButton: {
  backgroundColor: '#26d893',
  border: 'none'
},
paymentResultButton: {
  backgroundColor: '#26d893',
  border: 'none'
}
```

## Contributing

Issue pull requests or send feature requests.

[English version](#begateway-payment-module-for-joomla-3x-and-joomshopping-4x)

# Модуль оплаты beGateway для Joomla 3.x и JoomShopping 4.x/5.x

## Системные требования

* PHP 5.6+
* [cURL](http://php.net/manual/en/book.curl.php)
* [Joomla](http://www.joomla.org/download.html) 3.x (модуль был разработан и протестирован с версией 3.9.22)
* [JoomShopping](http://joomshopping.pro/download/component.html) 4.x/5.x (модуль был разработан и протестирован с версией 4.18.5/5.4.0)

## Установка

1. [Скачайте joomshopping-begateway.zip](https://github.com/beGateway/joomshopping-payment-module/blob/master/joomshopping-begateway.zip?raw=true)
2. Зайдите в панель администратора Joomla
3. Через меню _Компоненты_ перейдите в JoomShopping _Установка и обновление_ (стрелка #1)
  ![go to extension manager](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/ru/go_to_extensions_manager.png)
4. Установите пакет
  1. Откройте страницу _Загрузить файл пакета_ (стрелка #1)
  2. Выберите файл архива модуля, скаченного на шаге 1
  3. Загрузите и установите модуль (стрелка #2)
  ![upload and install plugin](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/ru/upload_and_install_plugin.png)

## Настройка модуля

1. Зайдите в панель администратора Joomla
2. Перейдите в панель _Опции_ JoomShopping (стрелка #1)
  ![go to joomshop options](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/ru/go_to_options.png)
3. Перейдите в _Способ оплаты_ (стрелка #1)
  ![go to payment methods](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/ru/go_to_payment_methods.png)
4. Нажните кнопку _Редактировать_ (стрелка #1)
  ![go to edit payment method form](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/ru/go_to_edit_payment_method_form.png)
5. Настройте модуль
  1. Выберите закладку _Конфигурация_ (стрелка #1)
  2. Введите настройки модуля
  4. Нажмите _Сохранить и закрыть_ (стрелка #2)
  ![edit payment method](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/ru/edit_payment_method.png)
6. Опубликуйте способ оплаты
  1. Выберите настроенный способ оплаты в списке доступных способов оплаты (стрелка #1)
  2. Опубликуйте его (стрелка #2)
  ![publish payment method](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/ru/publish_payment_method.png)

## Удалить модуль

1. Зайдите в панель администратора Joomla
2. Перейдите в панель _Опции_ JoomShopping (стрелка #1)
  ![go to joomshop options](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/ru/go_to_options.png)
3. Перейдите в _Способ оплаты_ (стрелка #1)
  ![go to payment methods](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/ru/go_to_payment_methods.png)
4. Удалить способ оплаты
  1. Выберите настроенный способ оплаты в списке доступных способов оплаты (стрелка #1)
  2. Удалите выбранный способ оплаты (стрелка #2)
  ![delete payment method](https://raw.githubusercontent.com/beGateway/joomshopping-payment-module/master/doc/img/ru/delete_payment_method.png)
5. Для полного удаления модуля удалите следующие файлы и директории в директории Joomla:
  * `components/vendor`
  * `components/com_jshopping/payments/pm_begateway`
  * `components/com_jshopping/lang/pm_begateway`

## Тестовые данные

Настройте модуль со следующими значениями

  * Домен страницы оплаты __checkout.begateway.com__
  * Id магазина __361__
  * Секретный ключ магазина __b8647b68898b084b836474ed8d61ffe117c9a01168d867f24953b776ddcb134d__
  * Отметьте __Включить тестовый режим модуля__

Используйте следующие данные карты для успешного тестового платежа:

  * Номер карты: 4200000000000000
  * Имя на карте: JOHN DOE
  * Месяц срока действия карты: 01/30
  * CVC: 123

Используйте следующие данные карты для неуспешного тестового платежа:

  * Номер карты: 4005550000000019
  * Имя на карте: JOHN DOE
  * Месяц срока действия карты: 01/30
  * CVC: 123

## Стиль виджета

### Стили, используемые в виджете

| Имя стиля                |
|--------------------------|
| widget                   |
| header                   |
| headerPrice              |
| headerDescription        |
| headerDescriptionText    |
| headerClose              |
| footer                   |
| footerText               |
| footerLink               |
| footerSecurity           |
| main                     |
| methodsMenu              |
| methodsMenuText          |
| methodsMenuCard          |
| methodsMenuCardText      |
| methodsMenuList          |
| methodsMenuListMethod    |
| methodsMenuGrid          |
| methodsMenuGridMethod    |
| cardsMenu                |
| cardsMenuText            |
| cardsMenuCard            |
| cardsMenuCardText        |
| card                     |
| cardSides                |
| cardFace                 |
| cardFaceContent          |
| cardBack                 |
| cardBackMagneticLine     |
| cardBackCVC              |
| cardBackCVCText          |
| cardBackCVCInput         |
| cardPoints               |
| cardCustomer             |
| cardCustomerField        |
| cardButton               |
| eripContent              |
| eripTitle                |
| eripOrder                |
| eripOrderTitle           |
| eripOrderNumber          |
| eripBanks                |
| eripBanksTitle           |
| eripQRCode               |
| eripBanksComment         |
| eripBanksLinks           |
| eripBanksBank            |
| eripBanksMore            |
| paymentResult            |
| paymentResultStatus      |
| paymentResultStatusText  |
| paymentResultDetails     |
| paymentResultDetailsText |
| paymentResultButton      |
| method                   |
| methodContent            |
| methodTitle              |
| methodForm               |
| methodButton             |
| methodWaiting            |
| phoneLabel               |
| inputGroup               |
| inputGroupField          |
| inputGroupSelect         |
| stepBack                 |
| stepBackText             |

### Настраиваемые CSS свойства

Никакие другие CSS свойства не поддерживаются.

| Параметр        | Соответствующее CSS свойство |
|-----------------|------------------------------|
| color           | color                        |
| backgroundColor | background-color             |
| border          | border                       |
| borderRadius    | border-radius                |
| fontFamily      | font-family                  |
| fontSize        | font-size                    |
| fontSmoothing   | font-smoothing               |
| fontStyle       | font-style                   |
| fontVariant     | font-variant                 |
| fontWeight      | font-weight                  |
| lineHeight      | line-height                  |
| letterSpacing   | letter-spacing               |
| margin          | margin                       |
| padding         | padding                      |
| textAlign       | text-align                   |
| textDecoration  | text-decoration              |
| textShadow      | text-shadow                  |
| textTransform   | text-transform               |

Значениями CSS свойств могут быть текстовые значения совместимые с CSS синтаксисом (см. пример выше).
Структуру html-документа виджета с используемыми стилями можно посмотреть с помощью Developer Tools браузера (Inspect element).

Пример

```javascript
header: {
  backgroundColor: '#fff',
  border: 'none'
},
headerPrice: {
  color: '#fff'
},
footer: {
  backgroundColor: '#fff',
  border: 'none'
},
cardButton: {
  backgroundColor: '#26d893',
  border: 'none'
},
methodButton: {
  backgroundColor: '#26d893',
  border: 'none'
},
paymentResultButton: {
  backgroundColor: '#26d893',
  border: 'none'
}
```

[Русская версия](#Модуль-оплаты-begateway-для-joomla-3x-и-joomshopping-4x)

# beGateway payment module for Joomla 3.x and JoomShopping 4.x

## System requirements

* PHP 5.3+
* [cURL extension](http://php.net/manual/en/book.curl.php)
* [Joomla](http://www.joomla.org/download.html) 3.x (the module was tested with version 3.4.8)
* [JoomShopping](http://joomshopping.pro/download/component.html) 4.x (the module was tested with version 4.11.3)

## The module installation

1. [Download joomshopping-begateway.zip](https://github.com/beGateway/joomshopping-payment-module/blob/master/joomshopping-begateway.zip?raw=true)
2. Go to Joomla's administration panel
3. Go to extension manager for JoomShopping (arrow #1)
  ![go to extension manager](master/doc/img/go_to_extensions_manager.png)
4. Install the module package
  1. Open file upload dialogue (arrow #1)
  2. Select the module package file saved at the step 1.
  3. Upload and install the module (arrow #2)
  ![upload and install plugin](master/doc/img/upload_and_install_plugin.png)

## The module configuration

1. Go to Joomla's administration panel
2. Go to the panel "Options" of JoomShopping (arrow #1)
  ![go to joomshop options](master/doc/img/go_to_options.png)
3. Go to payment methods list (arrow #1)
  ![go to payment methods](master/doc/img/go_to_payment_methods.png)
4. Press "Edit" button (arrow #1)
  ![go to edit payment method form](master/doc/img/go_to_edit_payment_method_form.png)
5. Configure the module
  1. Open "Config" tab (arrow #1)
  2. Fill the settings form
  4. Save the payment method and close the form (arrow #2)

  ![edit payment method](master/doc/img/edit_payment_method.png)
6. Publish the payment method
  1. Select the payment method in payment methods list (arrow #1)
  2. Publish it (arrow #2)
  ![publish payment method](master/doc/img/publish_payment_method.png)

## Uninstall the module

1. Go to Joomla's administration panel
2. Go to the panel "Options" of JoomShopping (arrow #1)
  ![go to joomshop options](master/doc/img/go_to_options.png)
3. Go to payment methods list (arrow #1)
  ![go to payment methods](master/doc/img/go_to_payment_methods.png)
4. Delete the payment method
  1. Select the payment method in payment methods list (arrow #1)
  2. Delete the payment method (arrow #2)
  ![delete payment method](master/doc/img/delete_payment_method.png)
5. To completly remove the module you have to delete files and folders in your Joomla's directory:
  * `components/vendor`
  * `components/com_jshopping/payments/pm_begateway`
  * `components/com_jshopping/lang/pm_begateway`

## Test data

If you setup the module with values as follows:

  * Payment gateway domain __demo-gateway.begateway.com__
  * Payment page domain __checkout.begateway.com__
  * Shop Id __361__
  * Shop secret key __b8647b68898b084b836474ed8d61ffe117c9a01168d867f24953b776ddcb134d__

Then you can use the test data to make a test payment:

* card number __4200000000000000__
* card name __John Doe__
* card expiry month __01__ to get a success payment
* card expiry month __10__ to get a failed payment
* CVC __123__

## Contributing

Issue pull requests or send feature requests.

[English version](#begateway-payment-module-for-joomla-3x-and-joomshopping-4x)

# Модуль оплаты beGateway для Joomla 3.x и JoomShopping 4.x

## Системные требования

* PHP 5.3+
* [cURL](http://php.net/manual/en/book.curl.php)
* [Joomla](http://www.joomla.org/download.html) 3.x (модуль был разработан и протестирован с версией 3.4.8)
* [JoomShopping](http://joomshopping.pro/download/component.html) 4.x (модуль был разработан и протестирован с версией 4.11.3)

## Установка

1. [Скачайте joomshopping-begateway.zip](https://github.com/beGateway/joomshopping-payment-module/blob/master/joomshopping-begateway.zip?raw=true)
2. Зайдите в панель администратора Joomla
3. Через меню _Компоненты_ перейдите в JoomShopping _Установка и обновление_ (стрелка #1)
  ![go to extension manager](master/doc/img/ru/go_to_extensions_manager.png)
4. Установите пакет
  1. Откройте страницу _Загрузить файл пакета_ (стрелка #1)
  2. Выберите файл архива модуля, скаченного на шаге 1
  3. Загрузите и установите модуль (стрелка #2)
  ![upload and install plugin](master/doc/img/ru/upload_and_install_plugin.png)

## Настройка модуля

1. Зайдите в панель администратора Joomla
2. Перейдите в панель _Опции_ JoomShopping (стрелка #1)
  ![go to joomshop options](master/doc/img/ru/go_to_options.png)
3. Перейдите в _Способ оплаты_ (стрелка #1)
  ![go to payment methods](master/doc/img/ru/go_to_payment_methods.png)
4. Нажните кнопку _Редактировать_ (стрелка #1)
  ![go to edit payment method form](master/doc/img/ru/go_to_edit_payment_method_form.png)
5. Настройте модуль
  1. Выберите закладку _Конфигурация_ (стрелка #1)
  2. Введите настройки модуля
  4. Нажмите _Сохранить и закрыть_ (стрелка #2)
  ![edit payment method](master/doc/img/ru/edit_payment_method.png)
6. Опубликуйте способ оплаты
  1. Выберите настроенный способ оплаты в списке доступных способов оплаты (стрелка #1)
  2. Опубликуйте его (стрелка #2)
  ![publish payment method](master/doc/img/ru/publish_payment_method.png)

## Удалить модуль

1. Зайдите в панель администратора Joomla
2. Перейдите в панель _Опции_ JoomShopping (стрелка #1)
  ![go to joomshop options](master/doc/img/ru/go_to_options.png)
3. Перейдите в _Способ оплаты_ (стрелка #1)
  ![go to payment methods](master/doc/img/ru/go_to_payment_methods.png)
4. Удалить способ оплаты
  1. Выберите настроенный способ оплаты в списке доступных способов оплаты (стрелка #1)
  2. Удалите выбранный способ оплаты (стрелка #2)
  ![delete payment method](master/doc/img/ru/delete_payment_method.png)
5. Для полного удаления модуля удалите следующие файлы и директории в директории Joomla:
  * `components/vendor`
  * `components/com_jshopping/payments/pm_begateway`
  * `components/com_jshopping/lang/pm_begateway`

## Тестовые данные

Если вы настроете модуль со следующими значениями

  * Домен платёжного шлюза __demo-gateway.begateway.com__
  * Домен страницы оплаты __checkout.begateway.com__
  * Id магазина __361__
  * Секретный ключ магазина __b8647b68898b084b836474ed8d61ffe117c9a01168d867f24953b776ddcb134d__

то вы сможете уже
осуществить тестовый платеж в вашем магазине. Используйте следующие
данные тестовой карты:

  * номер карты __4200000000000000__
  * имя на карте __John Doe__
  * месяц срока действия карты __01__, чтобы получить успешный платеж
  * месяц срока действия карты __10__, чтобы получить неуспешный платеж
  * CVC __123__

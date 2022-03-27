# iwa_formbuilder

Переписываемый кусок монолита, который генерирует сложные интерфейсы целиком из XML.

Изначально основанный на Joomla Forms код уже был ранее доработан и был добавлен следующий функционал:

- Автоматическая генерация из XML не только филдов, но и табов, дивов, групп полей, сплиттеров, аккордионов (целиком весь HTML формы)
- Использование XML позволило автоматически сохранять в базу и доставать из базы значения для полей. ничего программировать не нужно
- Реализованы фильтры полей перед сохранением в базу, после сохранения в базу и после получения из базы
- Добавлено скрытие полей в зависимости от значений других полей. showon (спасибо Joomla)
- Добавлено блокирование полей в зависимости от значений других полей. readonlyon (сделал на основе showon)
- Добавлено требование полей в зависимости от значений других полей. requireon (сделал на основе showon)
- Через JS унифицирован подход к чтению значения из любого филда, запись значения в филд и очистка значения
- Добавлен JS валидатор для всех видов полей. required и специфичные проверки
- Добавлен JS inputmask для текстового поля

Теперь legacy переписывается чтобы решить следующие проблемы:

- Вынести и переписать legacy код работы с формами в отдельный фреймворк-независимый модуль и подключить его сначало к старому legacy проекту на Joomla, а затем переписать legacy на фреймворк Laravel
- Добавить возможность генерировать HTML формы не только из XML(статичные), но из PHP(динамичные)
- Расширяемость филдов должна быть построена не только на наследовании, но и на вызове
- Один филд должен уметь предоставлять более одного значения в POST(а затем, после фильтра, для хранения в базе)
- Стандартизировать работу с филдами самых разных типов. Позволять легко добавлять и изменять реализации филдов, заменять на реализации свою.
- Валидировать не только на JS, но и на PHP
- Поддержка шаблонов

## Ход разработки

- [Этап 1: прототип XML и PHP файла интерфейса](readme/develop_step1.md)
- [Этап 2: наследования филдов и филд состоящий из других филдов](readme/develop_step2.md)

## TODO:

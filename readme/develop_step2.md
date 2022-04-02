# Этап 2: наследования филдов и филд состоящий из других филдов

http://local/demo/dev/?page=develop_step2&subpage=1
http://local/demo/dev/?page=develop_step2&subpage=2
http://local/demo/dev/?page=develop_step2&subpage=3
http://local/demo/dev/?page=develop_step2&subpage=4

### Заметки
- Override sabre-xml
- Шаблонизатор twig/twig для филдов
- Реализована поддержка наследования филдов, отрисовка в одном филде нескольких input'ов других филдов, а также отрисовка из филда целиком формы с другими филдами.
- Унифицирована Parse реализация XML и PHP
  - Service и Reader работают по одной логике
  - Reader теперь имплементируют единый интерфейс
- Отдельный класс Form\Parser для обработки формы разных форматов централизованно
- Отдельный класс Form\FormInput для отрисовки только input'ов

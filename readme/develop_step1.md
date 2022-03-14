# Этап 1: прототип XML и PHP формы

http://local/demo/dev/?page=develop_step1

Реализован прототип основная задача которого превращать XML и PHP в идентичное дерево объектов.

Вот так выглядит пример интерфейса в [XML](https://github.com/akaDJon/iwa_formbuilder/blob/master/src/php/pages/develop_step1/form.xml) формате:
```xml
<?xml version='1.0' encoding='utf-8'?>
<form version="2">

	<fieldset name='main'>

		<field_text
			name='text'
			label='текстовое поле'
		/>

		<field_list
			name='list'
			label='С описанием'
		>
			<option value='1'>Значение 1</option>
			<option value='2'>Значение 2</option>
			<option value='3'>Значение 3</option>
		</field_list>

	</fieldset>

</form>
```

Вот так выглядит пример интерфейса в [PHP-object](https://github.com/akaDJon/iwa_formbuilder/blob/master/src/php/pages/develop_step1/form.phpobject.php) формате:
```php
<?php

return new IWA_FormBuilder\Entity([
    'entity'   => 'form',
    'version'  => '2',
    'children' => [
        new IWA_FormBuilder\Entity([
            'entity'   => 'fieldset',
            'name'     => 'main',
            'children' => [
                new IWA_FormBuilder\Entity([
                    'entity' => 'field_text',
                    'name'   => 'text',
                    'label'  => 'текстовое поле',
                ]),
                new IWA_FormBuilder\Entity([
                    'entity'   => 'field_list',
                    'name'     => 'list',
                    'label'    => 'С описанием',
                    'children' => [
                        new IWA_FormBuilder\Entity([
                            'entity' => 'option',
                            'value'  => '1',
                            'text'   => 'Значение 1',
                        ]),
                        new IWA_FormBuilder\Entity([
                            'entity' => 'option',
                            'value'  => '2',
                            'text'   => 'Значение 2',
                        ]),
                        new IWA_FormBuilder\Entity([
                            'entity' => 'option',
                            'value'  => '3',
                            'text'   => 'Значение 3',
                        ]),
                    ],
                ]),
            ],
        ]),
    ],
]);
```

Имеются также примеры в форматах [JSON](https://github.com/akaDJon/iwa_formbuilder/blob/master/src/php/pages/develop_step1/form.json), [PHP-array](https://github.com/akaDJon/iwa_formbuilder/blob/master/src/php/pages/develop_step1/form.phparray.php) и [YAML](https://github.com/akaDJon/iwa_formbuilder/blob/master/src/php/pages/develop_step1/form.yaml)

И все этих примеры конвертируются в одно и тоже дерево объектов:
```php
^ IWA_FormBuilder\Entity\Form {#5 ▼
  +version: "2"
  +children: array:1 [▼
    0 => IWA_FormBuilder\Entity\Fieldset {#6 ▼
      +name: "main"
      +children: array:2 [▼
        0 => IWA_FormBuilder\Entity\FieldText {#7 ▼
          +name: "text"
          +label: "текстовое поле"
        }
        1 => IWA_FormBuilder\Entity\FieldList {#8 ▼
          +name: "list"
          +label: "С описанием"
          +children: array:3 [▼
            0 => IWA_FormBuilder\Entity\FieldList_Option {#9 ▼
              +value: "1"
              +text: "Значение 1"
            }
            1 => IWA_FormBuilder\Entity\FieldList_Option {#10 ▼
              +value: "2"
              +text: "Значение 2"
            }
            2 => IWA_FormBuilder\Entity\FieldList_Option {#11 ▼
              +value: "3"
              +text: "Значение 3"
            }
          ]
        }
      ]
    }
  ]
}
```

Так выглядит маппинг связи сущностей XML и PHP интерфейса с классами сущностей

```php
<?php

namespace IWA_FormBuilder;

class Map
{
    public static function get(): array
    {
        return [
            'form'       => \IWA_FormBuilder\Entity\Form::class,
            'fieldset'   => \IWA_FormBuilder\Entity\Fieldset::class,
            'field_text' => \IWA_FormBuilder\Entity\FieldText::class,
            'field_list' => \IWA_FormBuilder\Entity\FieldList::class,
        ];
    }
}
```

### Заметки
- XML парсится через sabre/xml, а YAML через symfony/yaml
- Скорость парсинга в порядке увеличения: 
  - PHP-object: 3.18 мс, 
  - PHP-array: 4.42 мс, 
  - Json: 4.64 мс, 
  - XML: 10.96 мс, 
  - Yaml: 12.10 мс,
- Удобство, лаконичность и читаемость однозначно за XML форматом. Плюс там еще будет контроль ошибок и автоподсказки через XSD
- Сразу создавать в PHP дерево объектов - это то от чего я умышленно ухожу. Предпочитаю абстракцию. Чтобы можно было замапить каждой сущности свой класс на лету
- Не очень нравится массивная структура в PHP форме ```IWA_FormBuilder\Entity('field_list'``` с его массивными ```IWA_FormBuilder\Entity('option'```. Возможно в будущем лучше переделать на простой массив

# Этап 1: прототип XML и PHP файла интерфейса

http://local/demo/dev/?page=develop_step1

Реализован прототип основная задача которого превращать интерфейс в форматах XML и PHP в идентичное дерево объектов.

Вот так выглядит пример интерфейса в [XML](https://github.com/akaDJon/iwa_formbuilder/blob/master/src/php/pages/develop_step1/form.xml) формате:
```xml
<?xml version='1.0' encoding='utf-8'?>
<form version="2">

	<fieldset name='main'>

		<field_text
			name='text'
			label='текстовое поле'
		/>

		<field_select
			name='list'
			label='С описанием'
		>
			<option value='1'>Значение 1</option>
			<option value='2'>Значение 2</option>
			<option value='3'>Значение 3</option>
		</field_select>

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
                    'entity'  => 'field_select',
                    'name'    => 'list',
                    'label'   => 'С описанием',
                    'options' => [
                        ['value' => '1', 'text' => 'Значение 1'],
                        ['value' => '2', 'text' => 'Значение 2'],
                        ['value' => '3', 'text' => 'Значение 3'],
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
^ IWA_FormBuilder\Entity\Model\Widget\Form {#5 ▼
  #entity: "form"
  #attributes: array:2 [▼
    "version" => "2"
    "name" => "__genid1"
  ]
  #children: array:1 [▼
    0 => IWA_FormBuilder\Entity\Model\Widget\Fieldset {#6 ▼
      #entity: "fieldset"
      #attributes: array:1 [▼
        "name" => "main"
      ]
      #children: array:2 [▼
        0 => IWA_FormBuilder\Entity\Model\Field\FieldText {#7 ▼
          #entity: "field_text"
          #attributes: array:3 [▼
            "name" => "text"
            "label" => "текстовое поле"
            "description" => ""
          ]
          #children: []
        }
        1 => IWA_FormBuilder\Entity\Model\Field\FieldList {#8 ▼
          #entity: "field_select"
          #attributes: array:4 [▼
            "name" => "list"
            "label" => "С описанием"
            "description" => ""
            "options" => array:3 [▼
              0 => array:2 [▼
                "value" => "1"
                "text" => "Значение 1"
              ]
              1 => array:2 [▼
                "value" => "2"
                "text" => "Значение 2"
              ]
              2 => array:2 [▼
                "value" => "3"
                "text" => "Значение 3"
              ]
            ]
          ]
          #children: []
        }
      ]
    }
  ]
}
```

Так выглядит маппинг связи сущностей XML и PHP интерфейса с классами сущностей

```php
<?php

namespace IWA_FormBuilder\Entity\Service;

class Map
{
    public static function get(): array
    {
        return [
            'form'       => \IWA_FormBuilder\Entity\Model\Widget\Form::class,
            'fieldset'   => \IWA_FormBuilder\Entity\Model\Widget\Fieldset::class,
            'field_text' => \IWA_FormBuilder\Entity\Model\Field\Text::class,
            'field_select' => \IWA_FormBuilder\Entity\Model\Field\Select::class,
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

# Этап 1: прототип XML и PHP формы

http://local/demo/dev/?page=develop_step1

Реализован прототип основная задача которого превращать XML и PHP в идентичное дерево объектов.

Вот так выглядит пример формы в XML:
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

Вот так выглядит пример формы в PHP:
```php
<?php

return new IWA_FormBuilder\Entity('form',
    [
        'version'  => '2',
        'children' => [
            new IWA_FormBuilder\Entity('fieldset',
                [
                    'name'     => 'main',
                    'children' => [
                        new IWA_FormBuilder\Entity('field_text',
                            [
                                'name'  => 'text',
                                'label' => 'текстовое поле',
                            ]
                        ),
                        new IWA_FormBuilder\Entity('field_list',
                            [
                                'name'     => 'list',
                                'label'    => 'С описанием',
                                'children' => [
                                    new IWA_FormBuilder\Entity('option',
                                        [
                                            'value' => '1',
                                            'text'  => 'Значение 1',
                                        ]
                                    ),
                                    new IWA_FormBuilder\Entity('option',
                                        [
                                            'value' => '2',
                                            'text'  => 'Значение 2',
                                        ]
                                    ),
                                    new IWA_FormBuilder\Entity('option',
                                        [
                                            'value' => '3',
                                            'text'  => 'Значение 3',
                                        ]
                                    ),
                                ],
                            ]
                        ),
                    ],
                ]
            ),
        ],
    ]
);
```

И оба этих примера превращаются в одно и тоже дерево объектов:
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
- XML конечно более локаничный и читабельный, но пока не вижу как можно сделать PHP такимже удобным
- Сразу создавать в PHP дерево объектов - это то от чего я умышленно ухожу. Предпочитаю обстракцию. Чтобы можно было замапить каждой сущности свой класс на лету
- В PHP форме не очень нравиться массивная структура ```IWA_FormBuilder\Entity('field_list'``` с его массивными ```IWA_FormBuilder\Entity('option'```. Возможно в будущем лучше переделать на простой массив

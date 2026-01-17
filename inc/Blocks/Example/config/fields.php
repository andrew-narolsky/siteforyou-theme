<?php

return [
    'key' => 'group_sfy_example',
    'title' => 'Example block',
    'fields' => [
        [
            'key' => 'field_example_title',
            'label' => 'Title',
            'name' => 'title',
            'type' => 'text',
        ],
        [
            'key' => 'field_example_text',
            'label' => 'Text',
            'name' => 'text',
            'type' => 'textarea',
        ],
        [
            'key' => 'field_example_image',
            'label' => 'Background image',
            'name' => 'image',
            'type' => 'image',
            'return_format' => 'id',
        ],
    ],
    'location' => [
        [
            [
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/sfy-example',
            ],
        ],
    ],
];
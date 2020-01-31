<?php

use App\Models\Tag;

return [
    'title'   => '标签',
    'single'  => '标签',
    'model'   => Tag::class,

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => '标签',
            'sortable' => false
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'name' => [
            'title'    => '标签',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '内容 ID',
        ],
        'name' => [
            'title' => '标签',
        ],
    ],
    'rules'   => [
        'name' => 'required'
    ],
    'messages' => [
        'name.required' => '请填写标签',
    ],
];

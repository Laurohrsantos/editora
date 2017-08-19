<?php

return [
    'acl' => [
        'role_author' => env('ROLE_AUTHOR', 'Author'),
        'permissions' => [
            'book_manage_all' => 'books-permission/manage_all'
        ],
        'controllers_annotations' => [
            __DIR__ . '/../Modules/CodeEduBook/Http/Controllers',
        ]
    ]
];

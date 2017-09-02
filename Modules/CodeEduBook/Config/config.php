<?php

return [
    'acl' => [
        'role_author' => env('ROLE_AUTHOR', 'Author'),
        'permissions' => [
            'book_manage_all' => 'books-permission/manage_all'
        ],
        'controllers_annotations' => [
            __DIR__  . '/../app/Http/Controllers',
        ]
    ],
    'book_storage' => env(' BOOK_STORAGE_DISK', 'book_local'),
    'book_thumbs' => 'storage/books/thumbs',
];
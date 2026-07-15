<?php

return [
    'required' => ':attribute は必須です。',
    'email' => '有効なメールアドレスを入力してください。',
    'string' => ':attribute は文字列で入力してください。',
    'min' => [
        'string' => ':attribute は :min 文字以上で入力してください。',
    ],

    'attributes' => [
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],

    'custom' => [
        'email' => [
            'required' => 'メールアドレスを入力してください。',
        ],
        'password' => [
            'required' => 'パスワードを入力してください。',
        ],
    ],

];

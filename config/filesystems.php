<?php

return [
    'default' => env('FILESYSTEM_DRIVER', 'local'),
    'cloud' => env('FILESYSTEM_CLOUD', 's3'),
    'disks' => [
        'local' => [
            'driver' => 's3',
            'root' => storage_path('app'),
        ],
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],
        'warden' => [
            'driver' => 'local',
            'root' => public_path('warden'),
            'url' => env('APP_URL') . '/warden',
            'visibility' => 'public',
        ],
        'ftp' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST'),
            'username' => env('FTP_USERNAME'),
            'password' => env('FTP_PASSWORD'),
            'port' => env('FTP_PORT'),
            'timeout' => 30,
            'ssl' => false,
            'passive' => true,
            'root' => env('FTP_ROOT'),
        ],
        'admin' => [
            'driver' => 'local',
            'root' => public_path('warden'),
            'visibility' => 'public',
            'url' => env('APP_URL').'/warden',
        ],
    ],
];

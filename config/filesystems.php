<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
       'GestionDocumentalEmpresa' => [
            'driver' => 'local',
            'root' => storage_path('app/public/documentos-empresa'),
            'url' => env('APP_URL').'/storage/app/public/documentos-empresa',
            'visibility' => 'public',
        ],

        'ClientFiles' => [
            'driver' => 'local',
            'root' => storage_path('app/public/clients_files'),
            'url' => env('APP_URL').'/storage/app/public/clients_files',
            'visibility' => 'public',
        ],
        
        'Images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images'),
            'url' => env('APP_URL').'/storage/app/public/images',
            'visibility' => 'public',
        ],
        's3' => [
            'driver'   => 's3',
            'key'      => env('AWS_ACCESS_KEY_ID'),
            'secret'   => env('AWS_SECRET_ACCESS_KEY'),
            'region'   => env('AWS_DEFAULT_REGION'),
            'bucket'   => env('AWS_BUCKET'),
            'url'      => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],
    
         'ftp' => [
                'driver'               => 'ftp',
                'host'                 => config('company.FTP_HOST'),
                'username'             => config('company.FTP_USER'),
                'password'             => config('company.FTP_PASS'),
                //'port'                 => '21',
                //'passive'              => true,
                //'ignorePassiveAddress' => true,
                //'ssl'                  => true,
                //'root'              => config('company.FTP_ROOT'),
                //'timeout'  => 30,
                //'root'     => '/',
                //'url'      => '/'
        ],

/*

'ftp' => [ 'driver' => 'ftp', 'host' => 'ftp.example.com', 'username' => 'your-username', 'password' => 'your-password', 'passive' => 'false', 'ignorePassiveAddress' => true, 'port' => 21, ]
*/
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];

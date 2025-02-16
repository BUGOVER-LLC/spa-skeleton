<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Lumen's queue API supports an assortment of src-ends via a single
    | API, giving you convenient access to each src-end using the same
    | syntax for every one. Here you may define a default connection.
    |
    */
    'default' => env('QUEUE_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information for each server that
    | is used by your application. A default configuration has been added
    | for each src-end shipped with Lumen. You are free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */
    'connections' => [
        'sync' => [
            'driver' => 'sync',
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => 'localhost',
            'queue' => 'default',
            'retry_after' => 90,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => env('QUEUE_REDIS_CONNECTION', 'default'),
            'queue' => 'default',
            'retry_after' => 90,
            'block_for' => null,
        ],

        'swoole' => [
            'driver' => 'swoole'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control which database and table are used to store the jobs that
    | have failed. You may change them to any database / table you wish.
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => env('QUEUE_FAILED_TABLE', 'failed_jobs'),
    ],
];

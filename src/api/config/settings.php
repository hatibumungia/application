<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Database connection settings
        "db" => [
            "DHost" => "127.0.0.1",
            "DBUser" => "root",
            "DBPassword" => "",
            "DBName" => "udomtrust_db",
        ],
    ],
];

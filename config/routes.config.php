<?php

use App\Core\ConsoleController;

return [
    'events_generate' => [
        'controller' => ConsoleController::class,
        'action' => 'generate'
    ],

    'events_handle' => [
        'controller' => ConsoleController::class,
        'action' => 'handle',
    ],

    'consume' => [
        'controller' => ConsoleController::class,
        'action' => 'consume',
    ]
];
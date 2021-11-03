<?php

declare(strict_types=1);

return [
    'handler' => [
        'http' => [
            \Hrb981027\TreasureBag\Exception\Handler\StandardExceptionHandler::class,
            App\Exception\Handler\AppExceptionHandler::class,
        ],
    ],
];

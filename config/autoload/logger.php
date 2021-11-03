<?php

declare(strict_types=1);

$defaultFormatter = [
    'class' => \Monolog\Formatter\LineFormatter::class,
    'constructor' => [
        'format' => null,
        'dateFormat' => 'Y-m-d H:i:s',
        'allowInlineLineBreaks' => true,
    ]
];

return [
    'default' => [
        'handles' => [
            [
                'class' => \Monolog\Handler\StreamHandler::class,
                'constructor' => [
                    'stream' => BASE_PATH . '/runtime/logs/hyperf-debug.log',
                    'level' => \Monolog\Logger::DEBUG,
                ],
                'formatter' => $defaultFormatter
            ],
            [
                'class' => \Monolog\Handler\RotatingFileHandler::class,
                'constructor' => [
                    'filename' => BASE_PATH . '/runtime/logs/hyperf-emergency.log',
                    'level' => \Monolog\Logger::EMERGENCY,
                ],
                'formatter' => [
                    'class' => Monolog\Formatter\JsonFormatter::class,
                    'constructor' => [
                        'batchMode' => Monolog\Formatter\JsonFormatter::BATCH_MODE_JSON,
                        'appendNewline' => true
                    ],
                ]
            ],
        ],
        'formatter' => $defaultFormatter,
    ],
    'api' => [
        'handler' => [
            'class' => \Monolog\Handler\RotatingFileHandler::class,
            'constructor' => [
                'filename' => BASE_PATH . '/runtime/logs/api-debug.log',
                'level' => \Monolog\Logger::DEBUG,
            ],
            //            'formatter' => $defaultFormatter,
            'formatter' => [
                'class' => \Monolog\Formatter\JsonFormatter::class,
                'constructor' => [
                    'format' => 'Y-m-d H:i:s',
                    'dateFormat' => 'Y-m-d H:i:s',
                    'allowInlineLineBreaks' => true,
                    'batchMode' => \Monolog\Formatter\JsonFormatter::BATCH_MODE_JSON,
                    'appendNewline' => true
                ],
            ]
        ],
    ]
];

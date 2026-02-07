<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Editor Link Template
    |--------------------------------------------------------------------------
    |
    | Define the editor which you use, or create a custom template.
    | Supported: vscode, phpstorm, sublime, cursor
    |
    */
    'editor' => env('PHPSTAN_VISUALIZER_EDITOR', 'vscode'),

    'templates' => [
        'vscode'   => 'vscode://file/%%file%%:%%line%%',
        'phpstorm' => 'phpstorm://open?file=%%file%%&line=%%line%%',
        'sublime'  => 'subl://open?url=file://%%file%%&line=%%line%%',
        'cursor'   => 'cursor://file/%%file%%:%%line%%',
    ],

    /*
    |--------------------------------------------------------------------------
    | Report File Path
    |--------------------------------------------------------------------------
    |
    | Set the save location of the JSON report by PHPStan.
    |
    */
    'report_path' => 'phpstan/report.json',
];
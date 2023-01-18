<?php

return [
    'get' => [
        [
            'url' => "/import_posts",
            'controllerName' => "App\VoyagerDataTransport\Http\Controllers\ImportPosts",
            'actionName' => "index",
            'alias' => "voyager.browse_import_posts",
        ],
        [
            'url' => "/export_posts",
            'controllerName' => "App\VoyagerDataTransport\Http\Controllers\ExportPosts",
            'actionName' => "export",
            'alias' => "voyager.browse_export_posts",
        ],
    ],
    'post' => [
        [
            'url' => "/import_posts/upload",
            'controllerName' => "App\VoyagerDataTransport\Http\Controllers\ImportPosts",
            'actionName' => "upload",
            'alias' => "voyager.import_posts.upload",
        ],
        [
            'url' => "/export_posts/download",
            'controllerName' => "App\VoyagerDataTransport\Http\Controllers\ExportPosts",
            'actionName' => "download",
            'alias' => "voyager.export_posts.download",
        ],
    ],
];

<?php

return [
    /*
     * these configs for filepond inside tasks module
    |--------------------------------------------------------------------------
    | FilePond Permanent Disk
    |--------------------------------------------------------------------------
    |
    | Set the FilePond default disk to be used for permanent file storage.
    |
    */
    'disk' => env('TASKS_FILEPOND_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | FilePond Temporary Disk
    |--------------------------------------------------------------------------
    |
    | Set the FilePond temporary disk and folder name to be used for temporary
    | storage. This disk will be used for temporary file storage and cleared
    | upon running the "artisan filepond:clear" command. It is recommended to
    | use local disk for temporary storage when you want to take advantage of
    | controller level validation. File validation from third party storage is
    | not yet supported. However, global 'validation_rules' defined in this
    | config will work fine.
    |
    */
    'temp_disk' => 'local',
    'temp_folder' => 'filepond/temp',

    /*
    |--------------------------------------------------------------------------
    | FilePond Routes Middleware
    |--------------------------------------------------------------------------
    |
    | Default middleware for FilePond routes.
    |
    */
    'middleware' => [
        'web', 'auth:',
        //           'auth:sanctum'
    ],

    /*
    |--------------------------------------------------------------------------
    | Soft Delete FilePond Model
    |--------------------------------------------------------------------------
    |
    | Determine whether to enable or disable soft delete in FilePond model.
    |
    */
    'soft_delete' => true,

    /*
    |--------------------------------------------------------------------------
    | File Delete After (Minutes)
    |--------------------------------------------------------------------------
    |
    | Set the minutes after which the FilePond temporary storage files will be
    | deleted while running 'artisan filepond:clear' command.
    |
    */
    'expiration' => 30,

    /*
    |--------------------------------------------------------------------------
    | FilePond Controller
    |--------------------------------------------------------------------------
    |
    | FilePond controller determines how the requests from FilePond library is
    | processed.
    |
    */
    'controller' => Modules\Tasks\Http\Controllers\API\V1\MediaUploadController::class,

    /*
    |--------------------------------------------------------------------------
    | Global Validation Rules
    |--------------------------------------------------------------------------
    |
    | Set the default validation for filepond's ./process route. In other words
    | temporary file upload validation.
    |
    */
    'validation_rules' => [
        'required',
        'file',
        'max:5000',
    ],

    /*
    |--------------------------------------------------------------------------
    | FilePond Server Paths
    |--------------------------------------------------------------------------
    |
    | Configure url for each of the FilePond actions.
    | See details - https://pqina.nl/filepond/docs/patterns/api/server/
    |
    | use in front server="api/v1/tasks/media_upload" without server url
    */
    'server' => [
        'url' => env('TASKS_FILEPOND_URL', 'medai_upload'),
    ],
];

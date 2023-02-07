<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tracker Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used across application for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    /*
     * we will customize this trans keys , because we do not need to save plain text translations in DB.
     *  because this will save one language just ,, but we need to keep trans key just.
     *  then when we will extract we will translate them to current locale
     * IMPORTANT: you should never change key ,just change label , this label will used as a key in another palces
     * and all trans files here will be english
     * values here must same keys in Modules/Tasks/Resources/lang/ar/model_history.php
     * we will save last trans key not all trns path, to get translation from any translation file path
     */

    'created' => 'created',
    'updating' => 'updated',
    'deleting' => 'deleted',
    'archived' => 'archived',
    'force_deleting' => 'force_deleted',
    'restored' => 'restored',
    'assigned_users_created' => 'assigned_users_created',
    'assigned_users_updated' => 'assigned_users_updated',
    'task_status_created' => 'task_status_created',
    'task_status_updated' => 'task_status_updated',
    'task_comment_created' => 'task_comment_created',
    'task_comment_updated' => 'task_comment_updated',

    //you may added your own model name language line here
    'models' => [
        'task' => 'Task',
        'workspace' => 'Task',
        '' => '',
    ]

    /*
        'created' => 'Created :model :label',
        'updating' => 'Updating :model :label',
        'deleting' => 'Deleting :model :label',
        'archived' => 'Archived :model :label',
        'force_deleting' => 'Force Deleting :model :label',
        'restored' => 'Restored :model :label',
        //you may added your own model name language line here
        'models' => [
            'task' => 'Task',
            'workspace' => 'Task',
            '' => '',
        ]
    */
];

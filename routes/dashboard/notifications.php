<?php

use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\PushSubscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| all system notifications routes will be here
|--------------------------------------------------------------------------
*/

// Notifications
Route::post('notifications', [NotificationController::class, 'store']);
Route::get('notifications', [NotificationController::class, 'index']);
Route::patch('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
Route::post('notifications/mark_all_read', [NotificationController::class, 'markAllRead'])->name('mark_all_notifications_as_read');
Route::post('notifications/{id}/dismiss', [NotificationController::class, 'dismiss']);

// Push Subscriptions
Route::post('subscriptions', [PushSubscriptionController::class, 'update']);
Route::post('subscriptions/delete', [PushSubscriptionController::class, 'destroy']);

// Manifest file (optional if VAPID is used)
// not needed currently
//Route::get('manifest.json', function () {
//    return [
//        'name' => config('app.name'),
//        'gcm_sender_id' => config('webpush.gcm.sender_id'),
//    ];
//});

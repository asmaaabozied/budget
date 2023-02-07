<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\NotificationRead;
use App\Events\NotificationReadAll;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use NotificationChannels\WebPush\PushSubscription;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get user's notifications.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $timePhase = $request->has('timePhase') ? $request->get('timePhase') : '';

        // Limit the number of returned notifications, or return all
        $query = $user->unreadNotifications()
                ->when($timePhase, function ($q) use ($timePhase) {
                    if ($timePhase === 'today') {
                        $q->whereDate('created_at', \Illuminate\Support\Carbon::today());
                    } elseif ($timePhase === 'yesterday') {
                        $q->whereDate('created_at', \Illuminate\Support\Carbon::yesterday());
                    } elseif ($timePhase === 'older') {
                        $q->whereDate('created_at', '<', \Illuminate\Support\Carbon::yesterday());
                    }
                });

        $limit = (int) $request->input('limit', 0);
        if ($limit) {
            $query = $query->limit($limit);
        }

        $notifications = $query->get()->each(function ($n) {
            $n->created_formatted = $n->created_at->diffForHumans();
            $n->translated_notification_title = trans($n->data['notification_title']);
        });

        $total = $query->count();

        if (request()->expectsJson()) {
            return response()->json([
                'notifications' => $notifications,
                'total' => $total,
            ]);
        }

        return compact('notifications', 'total');
    }

    /**
     * Create a new notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // will used for manually notifications from admin
//        auth()->user()->notify(new NotificationClassName);

        return response()->json('Notification sent.', 201);
    }

    /**
     * Mark user's notification as read.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = auth()->user()
                                ->unreadNotifications()
                                ->where('id', $id)
                                ->first();

        if (is_null($notification)) {
            return response()->json('Notification not found.', 404);
        }

        $notification->markAsRead();

        event(new NotificationRead(auth()->user()->id, $id));
    }

    /**
     * Mark all user's notifications as read.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markAllRead(Request $request)
    {
        auth()->user()
                ->unreadNotifications()
                ->get()->each(function ($n) {
                    $n->markAsRead();
                });

        event(new NotificationReadAll(auth()->user()->id));
    }

    /**
     * Mark the notification as read and dismiss it from other devices.
     *
     * This method will be accessed by the service worker
     * so the user is not authenticated and it requires an endpoint.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dismiss(Request $request, $id)
    {
        if (empty($request->endpoint)) {
            return response()->json('Endpoint missing.', 403);
        }

        $subscription = PushSubscription::findByEndpoint($request->endpoint);
        if (is_null($subscription)) {
            return response()->json('Subscription not found.', 404);
        }

        $notification = $subscription->subscribable->notifications()->where('id', $id)->first();
        if (is_null($notification)) {
            return response()->json('Notification not found.', 404);
        }

        $notification->markAsRead();

        event(new NotificationRead($subscription->subscribable->id, $id));
    }
}

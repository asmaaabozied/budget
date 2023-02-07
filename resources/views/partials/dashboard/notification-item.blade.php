@if(isset($item->data['space_id']))
<a href="{{ url(config('app.dashboard_url').'/dashboard/tasks#/workspace/'.$item->data['space_id'].'/t/'.$item->data['link']) }}" target="_blank" data-notification-id="{{ $item->id }}" data-read="0"
   class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2 notification-item">
@else
<a href="{{ url(config('app.dashboard_url').'/dashboard'.$item->data['action_url']) }}" target="_blank" data-notification-id="{{ $item->id }}" data-read="0"
   class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2 notification-item">
@endif
    <div class="card-body">
               <span class="float-end noti-close-btn text-muted notification-item-close">
{{--                   <i class="mdi mdi-close" ></i>--}}
               </span>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <div class="notify-icon bg-primary">
                    @if(isset($item->data['user_image_path'] ))
                        <img src="{{ $item->data['user_image_path'] }}" class="rounded-circle avatar-xs" alt=" {{ $item->data['user_full_name'] }}" >
                    @else
                        <i class=""> {{ $item->data['user_full_name'] }} </i>
                    @endif
                </div>
            </div>
            <div class="flex-grow-1 text-truncate ms-2">
                <h5 class="noti-item-title fw-semibold font-12">  {{ __($item->data['notification_title']) }} <small
                            class="fw-normal text-muted ms-1">  {{ $item->created_at->diffForHumans() }} </small></h5>
                <small class="noti-item-subtitle text-muted"> {{ $item->data['task_title'] }} </small>
{{--                <small class="noti-item-subtitle text-muted">  {{ __('notifications.by') }} : {{ $item->data['user_full_name'] }} </small>--}}
            </div>
        </div>
    </div>
</a>
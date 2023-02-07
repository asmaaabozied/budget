@inject('carbon', 'Carbon\Carbon')

    <li class="dropdown notification-list" id="notification-list">
        <a class="nav-link dropdown-toggle arrow-none notification-indicator" data-bs-toggle="dropdown" href="#"
            role="button" aria-haspopup="false" aria-expanded="false">
            <i class="ri-notification-3-line noti-icon position-relative"></i>
            <span data-count="0" id="notifications-counter"
                class="noti-icon-badge0 position-absolute0 notification-indicator-number">
                 </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
            <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 font-16 fw-semibold"> @lang('notifications.title') </h6>
                    </div>
                    <div class="col-auto">
                        <a href="javascript: void(0);" id="read-all" class="text-dark text-decoration-underline">
                            <small> @lang('notifications.mark_all_as_red') </small>
                        </a>
                    </div>
                </div>
            </div>

            <div class="px-3" style="max-height: 300px;" data-simplebar>

{{--                <h5 class="text-muted font-13 fw-normal mt-2"> @lang('notifications.today') </h5>--}}
                <!-- item-->
                <div id="unread_notifications_sub_wrapper">
                </div>
            </div>

            <!-- All-->
            @if(auth()->user()->unreadNotifications()->count() <= 0) <span
                class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                @lang('notifications.no_new_notifications')
                </span>
                @else
                <span class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                    @lang('notifications.scroll_mouse_to_read')
                </span>
                @endif

        </div>
    </li>

    <script type="text/javascript">
    var notificationsWrapper = document.getElementById('notification-list');
    var notificationsToggle = notificationsWrapper.getElementsByTagName("a")[0];
    var notificationsCountElem = notificationsWrapper.getElementsByTagName("span")[0];
    var notificationsCount = parseInt(notificationsCountElem.dataset.count);
    var notificationsWrapper = document.getElementById('unread_notifications_sub_wrapper');
    mainSystemChannel.bind('App\\Events\\NotificationRead', function(data) {
        getUnreadNotifications();
    });

    mainSystemChannel.bind('App\\Events\\NotificationReadAll', function(data) {
        getUnreadNotifications();
        // will used to clean all notifications in navbar
    });

    workspaceChannel.bind('Modules\\Tasks\\Events\\TaskUpdated', function(data) {
        console.log('update notifications TaskUpdated ');
        getUnreadNotifications();
        // TO DO , append new notification data to current notifications as html content
    });

    workspaceChannel.bind('Modules\\Tasks\\Events\\TaskAdded', function(data) {
        getUnreadNotifications();
    });

    workspaceChannel.bind('Modules\\Tasks\\Events\\TaskCommentAdded', function(data) {
        getUnreadNotifications();
    });

    workspaceChannel.bind('Modules\\Tasks\\Events\\TaskMediaUpdated', function(data) {
        getUnreadNotifications();
    });

    workspaceChannel.bind('Modules\\Tasks\\Events\\TaskStatusUpdated', function(data) {
        getUnreadNotifications();
    });

    function getUnreadNotifications() {
        getNotifications();
    }

    // to do , hide old notifications and append new as html content
    function getNotifications(timePhase = null) {
        // must be here not in public js files
        jQuery.ajax({
            url: "/api/v1/notifications",
            method: 'get',
            data: {
                timePhase:timePhase, // if we need to filter according date
            },
            success: function(result) {
                // update counter
                let currentNotificationsCounter = notificationsCountElem.dataset.count;
                notificationsCountElem.innerText = parseInt(result.total);
                notificationsCountElem.dataset.count = parseInt(result.total);
                console.log('this is notificationsCountElem count',parseInt(result.total));
                appendNewNotification(result.notifications);
            }
        }).done(function(msg) {
            return msg;
        }).fail(function() {
            console.log('failed to fetch user notifications ');
        });
    }

    function appendNewNotification(notifications) {
        let link = "{{ url(config('app.dashboard_url')) }}";
        notifications.forEach(item => {
            let existingNotifications = notificationsWrapper.innerHTML;

            let newNotificationHtml = `
        <a onmouseover="markAsRead(this)" href="${link}"  target="_blank" data-notification-id="${ item.id }" data-read="0"
           class="p-0 notify-item card unread-noti shadow-none mb-2 notification-item">

            <div class="card-body">  <span class="float-end noti-close-btn text-muted notification-item-close">  </span>
                  <div class="d-flex align-items-center">
                      <div class="flex-shrink-0">
                            <div class="notify-icon bg-primary">
                                <img src="${ item.data['user_image_path'] }" class="rounded-circle avatar-xs" alt="${ item.data['user_full_name'] }" >
                            </div>
                      </div>
                            <div class="flex-grow-1 text-truncate ms-2">
                                 <h5 class="noti-item-title fw-semibold font-12">  "${item.translated_notification_title}"

                                 <small class="fw-normal text-muted ms-1"> "${item.created_formatted}"    </small>  </h5>
                                  <small class="noti-item-subtitle text-muted"> "${item.data['task_title']}" </small>

                            </div>
                 </div>
            </div>
        </a>
    `;
            notificationsWrapper.innerHTML = (newNotificationHtml + existingNotifications);
        });
    }

    window.addEventListener('load', (event) => {
        getUnreadNotifications();
    });

    function markAsRead(e) {
        let notificationId = e.dataset.notificationId;
        console.log('this is e.dataset.read', e.dataset.read);
        if(e.dataset.read == 0) {
            readNotification(notificationId);
            e.dataset.read = 1;
        }
    }

    function readNotification(notificationId) {
        jQuery.ajax({
            url: `/api/v1/notifications/${notificationId}/read`,
            method: 'patch',
            data: {},
            success: function(result){
                console.log('successfully read all ',result);
            }});
    }

    </script>
    <style lang="">
    .notification-indicator::before {
        position: absolute;
        content: "";
        right: 0.125rem;
        top: 1.3rem;
        height: 1rem;
        width: 1rem;
        border-radius: 50%;
        background: #d81a1a;
        z-index: 1;
    }

    .notification-indicator-number {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        z-index: 1;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        position: absolute;
        right: 0.125rem;
        top: 1.3rem;
        height: 1rem;
        width: 1rem;
        font-size: .67rem;
        color: #fff;
        font-weight: 700;
    }

    .text-title {

        font-size: 14px;
    }
    </style>
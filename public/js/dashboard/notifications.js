jQuery(document).ready(function(){
    console.log('conetent loaded', true);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    // check user subscription
    registerServiceWorker();

    // read all notifications
    jQuery('#read-all').click(function(e){
        e.preventDefault();
        console.log('this is read all');
        // readAllNotifications();
    });

    jQuery('.notification-item-close').click(function(e) {
        let notificationId = this.dataset.notificationId;
        console.log('this is notification-item notification-id-close',this);
        console.log('this is DASHBOARD_URL',dashboardUrl );
        readNotification(notificationId);
    });

}); // close document ready

function readAllNotifications(notificationId) {

    jQuery.ajax({
        url: "/api/v1/notifications/mark_all_read",
        method: 'post',
        data: {},
        success: function(result){
            console.log('successfully read all ',result);
        }});
}

function registerServiceWorker() {

    console.log('Service workers start work worker')

    if (!('serviceWorker' in navigator)) {
        console.log('Service workers aren\'t supported in this browser. worker')
        return
    }

    navigator.serviceWorker.register('/sw.js')
        .then(() => initialiseServiceWorker())
}

function initialiseServiceWorker () {
    if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
        console.log('Notifications aren\'t supported. worker')
        return
    }

    if (Notification.permission === 'denied') {
        console.log('The user has blocked notifications. worker')
        return
    }

    if (!('PushManager' in window)) {
        console.log('Push messaging isn\'t supported. worker')
        return
    }

    navigator.serviceWorker.ready.then(registration => {
        registration.pushManager.getSubscription()
            .then(subscription => {
                this.pushButtonDisabled = false

                if (!subscription) {
                    return
                }

                this.updateSubscription(subscription)

                this.isPushEnabled = true
            })
            .catch(e => {
                console.log('Error during getSubscription() worker', e)
            })
    })

} // close initialiseServiceWorker


/**
 * Subscribe for push notifications.
 */
function subscribe () {
    navigator.serviceWorker.ready.then(registration => {
        const options = { userVisibleOnly: true }
        const vapidPublicKey = window.Laravel.vapidPublicKey

        if (vapidPublicKey) {
            options.applicationServerKey = this.urlBase64ToUint8Array(vapidPublicKey)
        }

        registration.pushManager.subscribe(options)
            .then(subscription => {
                this.isPushEnabled = true
                this.pushButtonDisabled = false

                this.updateSubscription(subscription)
            })
            .catch(e => {
                if (Notification.permission === 'denied') {
                    console.log('Permission for Notifications was denied')
                    this.pushButtonDisabled = true
                } else {
                    console.log('Unable to subscribe to push.', e)
                    this.pushButtonDisabled = false
                }
            })
    })
} // close subscribe

/**
 * Unsubscribe from push notifications.
 */
function unsubscribe () {
    navigator.serviceWorker.ready.then(registration => {
        registration.pushManager.getSubscription().then(subscription => {
            if (!subscription) {
                this.isPushEnabled = false
                this.pushButtonDisabled = false
                return
            }

            subscription.unsubscribe().then(() => {
                this.deleteSubscription(subscription)

                this.isPushEnabled = false
                this.pushButtonDisabled = false
            }).catch(e => {
                console.log('Unsubscription error: ', e)
                this.pushButtonDisabled = false
            })
        }).catch(e => {
            console.log('Error thrown while unsubscribing.', e)
        })
    })
} // close unsubscribe

/**
 * Toggle push notifications subscription.
 */
function togglePush () {
    if (this.isPushEnabled) {
        this.unsubscribe()
    } else {
        this.subscribe()
    }
} // close togglePush


/**
 * Send a request to the server to update user's subscription.
 *
 * @param {PushSubscription} subscription
 */
function updateSubscription (subscription) {
    const key = subscription.getKey('p256dh')
    const token = subscription.getKey('auth')
    const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0]

    const data = {
        endpoint: subscription.endpoint,
        publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
        authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
        contentEncoding
    }

    this.loading = true

    axios.post('/subscriptions', data)
        .then(() => { this.loading = false })
} // close updateSubscription

/**
 * Send a requst to the server to delete user's subscription.
 *
 * @param {PushSubscription} subscription
 */
function deleteSubscription (subscription) {
    this.loading = true

    axios.post('/subscriptions/delete', { endpoint: subscription.endpoint })
        .then(() => { this.loading = false })
} // close deleteSubscription

/**
 * https://github.com/Minishlink/physbook/blob/02a0d5d7ca0d5d2cc6d308a3a9b81244c63b3f14/app/Resources/public/js/app.js#L177
 *
 * @param  {String} base64String
 * @return {Uint8Array}
 */
function urlBase64ToUint8Array (base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4)
    const base64 = (base64String + padding)
        .replace(/-/g, '+')
        .replace(/_/g, '/')

    const rawData = window.atob(base64)
    const outputArray = new Uint8Array(rawData.length)

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i)
    }

    return outputArray;

} // close urlBase64ToUint8Array
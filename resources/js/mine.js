$(document).ready(function() {
    var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
        encrypted: true,
        cluster: "ap1",
    });
    var channel = pusher.subscribe("NotificationEvent");
    channel.bind("send-notification", async function(data) {
        let pending = parseInt($("#notifications").find(".pending").html());
        if (Number.isNaN(pending)) {
            $("#notifications").append(
                '<span class="pending badge bg-primary badge-number">1</span>'
            );
        } else {
            $("#notifications")
                .find(".pending")
                .html(pending + 1);
        }
        let notificationItem = `
        <li data-id="{{ $notification->id }}"
            class="notification-item {{ $notification->unread() ? 'unread' : '' }}">
            <a class="text-decoration-none" href="">
                <p class="mb-1">{{ $notification->data['title'] }}</p>
                <small>{{ $notification->data['content'] }}</small>
            </a>
        </li>`;
        $("#notification-list").prepend(notificationItem);
    });
});

$(document).ready(function() {
    var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
        encrypted: true,
        cluster: "ap1",
    });
    var channel = pusher.subscribe("NotificationEvent");
    channel.bind("send-notification", function(data) {
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

        let url = window.location.origin + '/student/mark-at-read/' + data.id;
        let notificationItem = `
        <li 
            class="notification-item unread">
            <a class="text-decoration-none" href="` + url + `"> 
                <p class="mb-1">` + data.data.title + `</p> 
            </a> 
            </li>`;
        $("#notification-list").prepend(notificationItem);
    });
});

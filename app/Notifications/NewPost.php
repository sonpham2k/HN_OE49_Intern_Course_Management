<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Pusher\Pusher;

class NewPost extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $following;
    protected $post;
    protected $data;

    public function __construct(User $following, Post $post)
    {
        $this->following = $following;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $options = [
            'cluster' => 'ap1',
            'useTLS' => true,
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $data = [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'following_id' => $this->following->id,
                'following_name' => $this->following->name,
                'post_id' => $this->post->id,
                'title' => $this->post->title,
                'content' => $this->post->content,
            ],
        ];

        $pusher->trigger('NotificationEvent', 'send-notification', $data);

        return $data;
    }
}

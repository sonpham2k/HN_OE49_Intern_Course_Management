<?php

namespace App\Repositories\Notify;

use App\Repositories\BaseRepository;
use Illuminate\Notifications\DatabaseNotification;

class NotifyRepository extends BaseRepository implements NotifyRepositoryInterface
{
    public function getModel()
    {
        return DatabaseNotification::class;
    }

    public function getNotify($id)
    {
        return auth()->user()->notifications->where('id', $id)->firstOrFail();
    }

    public function getID(DatabaseNotification $noti)
    {
        return $noti->data->post_id;
    }

    public function markAsRead(DatabaseNotification $noti)
    {
        $noti->markAsRead();
    }

    public function getListUnRead()
    {
        return auth()->user()->unreadNotifications;
    }
}

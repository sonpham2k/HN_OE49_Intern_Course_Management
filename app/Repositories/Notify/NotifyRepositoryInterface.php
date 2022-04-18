<?php

namespace App\Repositories\Notify;

use App\Repositories\RepositoryInterface;
use Illuminate\Notifications\DatabaseNotification;

interface NotifyRepositoryInterface extends RepositoryInterface
{
    public function getNotify($id);

    public function getID(DatabaseNotification $noti);

    public function markAsRead(DatabaseNotification $noti);

    public function getListUnRead();
}

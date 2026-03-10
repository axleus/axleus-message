<?php

declare(strict_types=1);

namespace Axleus\Message;

trait NotificationCapableTrait
{
    protected bool $notify = true;

    protected bool $notifyNow = false;

    public function setNotify(bool $notify = true): NotificationCapableInterface
    {
        $this->notify = $notify;

        return $this;
    }

    public function getNotify(): bool
    {
        return $this->notify;
    }

    public function setNotifyNow(bool $notifyNow = true): NotificationCapableInterface
    {
        $this->setNotify();
        $this->notifyNow = $notifyNow;

        return $this;
    }

    public function getNotifyNow(): bool
    {
        return $this->notifyNow;
    }
}

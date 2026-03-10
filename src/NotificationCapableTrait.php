<?php

declare(strict_types=1);

/**
 * This file is part of the Axleus Axleus Message package.
 *
 * Copyright (c) 2026 Joey Smith <jsmith@webinertia.net>
 * and contributors.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

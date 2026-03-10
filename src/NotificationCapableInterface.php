<?php

declare(strict_types=1);

namespace Axleus\Message;

interface NotificationCapableInterface
{
    public const MESSAGE_SUCCESS = 'success';
    public const MESSAGE_FAILURE = 'failure';

    public function getNotify(): bool;

    public function getNotifyNow(): bool;
}

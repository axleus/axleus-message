<?php

declare(strict_types=1);

namespace Axleus\Message;

interface SystemMessengerAwareInterface
{
    public function getSystemMessenger(): SystemMessengerInterface;
}

<?php

declare(strict_types=1);

namespace Axleus\Message;

trait SystemMessengerAwareTrait
{
    protected SystemMessengerInterface $systemMessenger;

    public function setSystemMessenger(SystemMessengerInterface $systemMessenger): SystemMessengerAwareInterface
    {
        $this->systemMessenger = $systemMessenger;

        return $this;
    }

    public function getSystemMessenger(): SystemMessengerInterface
    {
        return $this->systemMessenger;
    }
}

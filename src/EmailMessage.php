<?php

declare(strict_types=1);

namespace Axleus\Message;

class EmailMessage extends SystemMessage implements EmailMessageCapableInterface
{
    public function setMessage(string $message): self
    {
        $this->setNotify(true);
        $this->setParam('message', $message);
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->getParam('message');
    }
}

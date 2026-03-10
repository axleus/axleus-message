<?php

declare(strict_types=1);

namespace Axleus\Message;

trait MessageIconCapableTrait
{
    protected ?MessageIcon $messageIcon = null;

    public function setMessageIcon(?MessageIcon $messageIcon): MessageIconCapableInterface
    {
        $this->messageIcon = $messageIcon;

        return $this;
    }

    public function getMessageIcon(): ?MessageIcon
    {
        return $this->messageIcon;
    }
}

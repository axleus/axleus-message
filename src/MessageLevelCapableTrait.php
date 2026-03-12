<?php

declare(strict_types=1);

namespace Axleus\Message;

trait MessageLevelCapableTrait
{
    public function setMessageLevel(MessageLevel $messageLevel): MessageLevelCapableInterface
    {
        $this->messageLevel = $messageLevel;
        return $this;
    }

    public function getMessageLevel(): MessageLevel
    {
        return $this->messageLevel ?? MessageLevel::Info;
    }
}

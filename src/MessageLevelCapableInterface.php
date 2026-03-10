<?php

declare(strict_types=1);

namespace Axleus\Message;

interface MessageLevelCapableInterface
{
    public function setMessageLevel(MessageLevel $messageLevel): MessageLevelCapableInterface;
    
    public function getMessageLevel(): MessageLevel;
}

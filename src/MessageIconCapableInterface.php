<?php

declare(strict_types=1);

namespace Axleus\Message;

interface MessageIconCapableInterface
{
    public function getMessageIcon(): ?MessageIcon;
}

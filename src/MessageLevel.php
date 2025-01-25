<?php

declare(strict_types=1);

namespace Axleus\Message;

enum MessageLevel: string
{
    case Success = 'success';
    case Danger  = 'danger';
    case Warning = 'warning';
    case Info    = 'info';
}

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

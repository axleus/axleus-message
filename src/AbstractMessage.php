<?php

declare(strict_types=1);

namespace Axleus\Message;

abstract class AbstractMessage implements MessageInterface
{
    protected string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function jsonSerialize(): mixed
    {
        return $this->getMessage();
    }

    public function __toString(): string
    {
        return $this->getMessage();
    }

}

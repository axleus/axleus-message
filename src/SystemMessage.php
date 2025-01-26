<?php

declare(strict_types=1);

namespace Axleus\Message;

use Laminas\EventManager\Event;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SystemMessage extends Event implements SystemMessageCapableInterface
{
    public function setRequest(ServerRequestInterface $request): self
    {
        $this->setParam('request', $request);
        return $this;
    }

    public function getRequest(): ?ServerRequestInterface
    {
        return $this->getParam('request');
    }

    public function setResponse(ResponseInterface $response): self
    {
        $this->setParam('response', $response);
        return $this;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->getParam('response');
    }

    public function setMessage(string $message): self
    {
        $this->setParam('message', $message);
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->getParam('message');
    }

    public function setHops(int $hops = 1): self
    {
        $this->setParam('hops', $hops);
        return $this;
    }

    public function getHops(): int
    {
        return $this->getParam('hops', 1);
    }

    public function setNow(bool $now = true): self
    {
        $this->setParam('now', $now);
        return $this;
    }

    public function getNow(): bool
    {
        return $this->getParam('now', false);
    }

    public function setNotify(bool $flag = true): self
    {
        $this->setParam('notify', $flag);
        return $this;
    }

    public function getNotify(): bool
    {
        return $this->getParam('notify', false);
    }

    public function setLevel(MessageLevel|string $level): self
    {
        $this->setParam('level', $level);
        return $this;
    }

    public function getLevel(): MessageLevel|string
    {
        return $this->getParam('level', MessageLevel::Info);
    }
}

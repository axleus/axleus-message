<?php

declare(strict_types=1);

namespace Axleus\Message\Middleware;

use Axleus\Message\MessageListener;
use Axleus\Message\SystemMessenger;
use Axleus\Message\SystemMessengerInterface;
use Axleus\Message\View\Helper\SystemMessenger as Helper;
use Mezzio\Session\SessionMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class MessageMiddleware implements MiddlewareInterface
{
    public function __construct(
        private MessageListener $messageListener,
        private Helper $helper
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // create an instance of the SystemMessenger
        $systemMessenger = new SystemMessenger(
            $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE),
            SystemMessengerInterface::SESSION_KEY
        );
        // inject the SystemMessenger into the listener instance
        $this->messageListener->setSystemMessenger($systemMessenger);
        // inject SystemMessenger into the helper instance
        $this->helper->setMessenger($systemMessenger);
        // next in the stack
        return $handler->handle($request->withAttribute(SystemMessengerInterface::class, $systemMessenger));
    }
}

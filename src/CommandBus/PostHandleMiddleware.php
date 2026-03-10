<?php

declare(strict_types=1);

namespace Axleus\Message\CommandBus;

use Axleus\Message\SystemMessengerInterface;
use Axleus\Message\NotificationCapableInterface;
use Axleus\Message\MessageLevelCapableInterface;
use Axleus\Message\MessageLevel;
use Webware\CommandBus\Command\CommandResultInterface;
use Webware\CommandBus\Command\CommandStatus;
use Webware\CommandBus\CommandInterface;
use Webware\CommandBus\CommandHandlerInterface;
use Webware\CommandBus\MiddlewareInterface;

final readonly class PostHandleMiddleware implements MiddlewareInterface
{
    private const SUCCESS = NotificationCapableInterface::MESSAGE_SUCCESS;
    private const FAILURE = NotificationCapableInterface::MESSAGE_FAILURE;

    public function __construct(
        private SystemMessengerInterface $systemMessenger,
        private array $config
    ) {
    }

    public function process(CommandInterface $command, CommandHandlerInterface $handler): CommandResultInterface
    {
        if (
            $command instanceof CommandResultInterface
            && $command instanceof NotificationCapableInterface
            ) {

                $status    = $command->getStatus();
                $notify    = $command->getNotify();
                $notifyNow = $command->getNotifyNow();

                if (! $notify) {
                    return $command;
                }

                $message = match ($status) {
                    CommandStatus::Success => $this->config[$command::class][self::SUCCESS] ?? null,
                    CommandStatus::Failure => $this->config[$command::class][self::FAILURE] ?? null,
                    default => null,
                };

                if ($message) {
                    $messageLevel = $command instanceof MessageLevelCapableInterface 
                        ? $command->getMessageLevel() 
                        : MessageLevel::Info;

                    if ($notifyNow) {
                        $this->systemMessenger->sendNow(
                            $message,
                            $messageLevel
                        );
                    } else {
                        $this->systemMessenger->send($message, $messageLevel);
                    }
                }

                return $command;
            }

            return $handler->handle($command);
    }

}

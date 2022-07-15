<?php

namespace App\Diet\Application;

use App\Diet\Application\Exception\CommandHandlerNotFoundException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CommandBus implements CommandBusInterface
{
    private ContainerInterface $container;

    public function __construct(
        ContainerInterface $container
    ) {
        $this->container = $container;
    }

    public function dispatch(object $command): void
    {
        $handlerName = $this->makeHandlerName($command);

        if (! $this->container->has($handlerName)) {
            throw new CommandHandlerNotFoundException($handlerName . ' does not exist!');
        }

        $handler = $this->container->get($handlerName);
        $handler->handle($command);
    }

    private function makeHandlerName(object $command): string
    {
        return get_class($command) . 'Handler';
    }
}

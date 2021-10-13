<?php

declare(strict_types=1);

namespace User\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class RegisterHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RegisterHandler
    {
        return new RegisterHandler($container->get(TemplateRendererInterface::class));
    }
}

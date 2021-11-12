<?php

declare(strict_types=1);

namespace eFaktury;

use eFaktury\Model\Table\ifisEinvoicesStackTable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class MainHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @var ifisEinvoicesStackTable
     */
    private $ifisEinvoicesStackTable;

    public function __construct( ifisEinvoicesStackTable $ifisEinvoicesStackTable, TemplateRendererInterface $renderer)
    {
        $this->ifisEinvoicesStackTable = $ifisEinvoicesStackTable;
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'e-faktury::main',
            [
                'tableInvoices' => $this->ifisEinvoicesStackTable->getFetchAll()
            ] // parameters to pass to template
        ));
    }
}

<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Server\MiddlewareInterface;
use Valuation\Model\Table\ValuationTable;

class ValuationHandler implements MiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    private $valuationTable;

    public function __construct(
        ValuationTable $valuationTable,
        TemplateRendererInterface $renderer)
    {
        $this->valuationTable = $valuationTable;
        $this->renderer = $renderer;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler) : ResponseInterface
    {
        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::valuation',
            [
                'echo' => $this->valuationTable->fetchAllResources()
            ] // parameters to pass to template
        ));
    }

    public function setConfidentialityAction(){
        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::valuation',
            [
                //'echo' => $this->valuationTable->fetchAllResources()
            ] // parameters to pass to template
        ));
        //return new JsonResponse(['ack' => time()]);
    }

    public function createAction()
    {
        echo "pako";
        # ok now I am in the ProfileCOntroller
        # the reason I am here is because I want us to now display the profile picture

        // $id = (int) $this->params()->fromRoute('id');
        // $info = $this->usersTable->fetchAccountById((int) $id);
        // if (! $info) {
        //     return $this->notFoundAction();
        // }

        // return new ViewModel(['data' => $info]);

        return new HtmlResponse($this->renderer->render(
            'valuation::impact',
            [
                //'echo' => $this->valuationTable->fetchAllResources()
            ] // parameters to pass to template
        ));
    }
}

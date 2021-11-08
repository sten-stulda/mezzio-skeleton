<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Valuation\Base\BaseHandler;
use Valuation\Model\Table\IntegrityTable;
use Valuation\Model\Table\ValuationTable;

class IntegrityHandler extends BaseHandler
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /** @var IntegrityTable */
    private $integrityTable;

    /** @var ValuationTable */
    private $valuationTable;

    public function __construct(
        ValuationTable $valuationTable,
        IntegrityTable $integrityTable,
        TemplateRendererInterface $renderer)
    {
        $this->valuationTable = $valuationTable;
        $this->integrityTable = $integrityTable;
        $this->renderer = $renderer;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

        # check if the request is a form post
        if ($request->getMethod() === 'POST') {
            $requestBoby = $request->getParsedBody();
            $dataForm = json_decode($requestBoby['json'],true);
            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['setIntegrity'])) {
                $this->valuationTable->updateIntegrityValuation($dataForm);
                return new JsonResponse(['message' => 'uloženo']);
            } else {
                return new JsonResponse(['error' => $requestBoby]);
            }
        }

        /** id */
        $id = (int) $request->getAttribute('id') ? : 0;

        /** data model */
        $valuation = $this->valuationTable->getValuationById($id);
        $assets = $this->integrityTable->fetchAll();

        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::integrity',
            [
                'id' => $id,
                'valuation' => $valuation,
                'assets' => $assets,
                'description' => $this->integrityTable->fetchAll(),
                'radio' => $this->integrityTable->fetchAll(),
                'colorLevel' => $this->getLevelColor(),
                'levelName' => $this->getLevelName()
            ] // parameters to pass to template
        ));
    }
}

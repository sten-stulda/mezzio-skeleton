<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Valuation\Base\BaseHandler;
use Valuation\Model\Table\ImpactTable;
use Valuation\Model\Table\ValuationTable;

class ImpactHandler extends BaseHandler
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /** @var ImpactTable */
    private $impactTable;

    /** @var ValuationTable */
    private $valuationTable;

    public function __construct(
        ValuationTable $valuationTable,
        ImpactTable $impactTable,
        TemplateRendererInterface $renderer)
    {
        $this->valuationTable = $valuationTable;
        $this->impactTable = $impactTable;
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
            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['setImpact'])) {
                $this->valuationTable->updateImpactValuation($dataForm);
                return new JsonResponse(['message' => 'uloženo']);
            } else {
                return new JsonResponse(['error' => $requestBoby]);
            }
        }

        /** id */
        $id = (int) $request->getAttribute('id') ? : 0;

        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::impact',
            [
                'id' => $id,
                'valuation' => $this->valuationTable->getValuationById($id),
                'assets' => $this->impactTable->fetchAll(),
                'description' => $this->impactTable->fetchAll(),
                'radio' => $this->impactTable->fetchAll(),
                'colorLevel' => $this->getLevelColor(),
                'levelName' => $this->getLevelName()
            ] // parameters to pass to template
        ));
    }
}

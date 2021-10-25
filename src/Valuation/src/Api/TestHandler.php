<?php

declare(strict_types=1);

namespace Valuation\Api;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Template\TemplateRendererInterface;
use Valuation\Model\Table\ConfidentialityTable;
use Valuation\Model\Table\ValuationTable;

class TestHandler implements RequestHandlerInterface
{
    /**
     * @var ValuationTable
     */
    private $valuationTable;

    /**
     * @var ConfidentialityTable
     */
    private $confidentialityTable;

    public function __construct(
        ConfidentialityTable $confidentialityTable,
        ValuationTable $valuationTable,
        TemplateRendererInterface $renderer
    ) {
        $this->confidentialityTable = $confidentialityTable;
        $this->valuationTable = $valuationTable;
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** id */
        $id = (int) $request->getAttribute('id') ?: null;

        if (!empty($id)) {
            $dataFetch = $this->valuationTable->getValuationById($id);
            
            $dataFetch = $this->confidentialityTable->fetchAllData();//int $id

            if (!empty($dataFetch)) {
                foreach ($dataFetch as $key => $value) {
                    $data[$key] = $value;
                }
            } else {
                $data = ['error' => 'zaznam s id neni v db'];
            }
        } else {
            $data = ['error' => 'Neni id'];
        }


        return new JsonResponse($data);
    }
}

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
use Valuation\Model\Table\ConfidentialityTable;
use Valuation\Model\Table\ValuationTable;

class ConfidentialityHandler extends BaseHandler
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /** @var ValuationTable */
    private $valuationTable;

    /** @var ConfidentialityTable */
    private $confidentialityTable;


    public function __construct(
        ValuationTable $valuationTable,
        ConfidentialityTable $confidentialityTable,
        TemplateRendererInterface $renderer)
    {
        $this->valuationTable = $valuationTable;
        $this->confidentialityTable = $confidentialityTable;
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
            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['setConfidentiality'])) {
                $this->valuationTable->updateConfidentialityValuation($dataForm);
                return new JsonResponse(['message' => 'uloženo']);
            } else {
                return new JsonResponse(['error' => 'problem']);
            }
        }

        /** id */
        $id = (int) $request->getAttribute('id') ? : null;

        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::confidentiality',
            [
                'id' => $id,
                'valuation' => $this->valuationTable->getValuationById($id),
                'assets' =>  $this->confidentialityTable->getFetchAllData(),
                'description' => $this->confidentialityTable->getFetchAllData(),
                'radio' => $this->confidentialityTable->getFetchAllData(),
                'colorLevel' => $this->getLevelColor(),
                'levelName' => $this->getLevelName()
            ] // parameters to pass to template
        ));
    }
}

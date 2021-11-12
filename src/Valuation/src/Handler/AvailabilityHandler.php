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
use Valuation\Model\Table\AvailabilityTable;
use Valuation\Model\Table\ValuationTable;

class AvailabilityHandler extends BaseHandler
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /** @var ValuationTable */
    private $valuationTable;

    /** @var AvailabilityTable */
    private $availabilityTable;

    public function __construct(
        ValuationTable $valuationTable,
        AvailabilityTable $availabilityTable,
        TemplateRendererInterface $renderer
    ) {
        $this->valuationTable = $valuationTable;
        $this->availabilityTable = $availabilityTable;
        $this->renderer = $renderer;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

        # check if the request is a form post
        if ($request->getMethod() === 'POST') {
            $requestBoby = $request->getParsedBody();
            $dataForm = json_decode($requestBoby['json'], true);
            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['setAvailability'])) {
                $this->valuationTable->updateAvailabilityValuation($dataForm);
                return new JsonResponse(['message' => 'uloženo']);
            } else {
                return new JsonResponse(['error' => 'problem']);
            }
        }

        /** id */
        $id = (int) $request->getAttribute('id') ?: 0;

        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::availability',
            [
                'id' => $id,
                'valuation' => $this->valuationTable->getValuationById($id),
                'assets' => $this->availabilityTable->fetchAll(),
                'description' => $this->availabilityTable->fetchAll(),
                'radio' => $this->availabilityTable->fetchAll(),
                'colorLevel' => $this->getLevelColor(),
                'levelName' => $this->getLevelName()
            ] // parameters to pass to template
        ));
    }
}

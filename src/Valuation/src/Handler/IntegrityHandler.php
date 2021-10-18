<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Server\MiddlewareInterface;
use Valuation\Model\Table\IntegrityTable;
use Valuation\Model\Table\ValuationTable;

class IntegrityHandler implements MiddlewareInterface
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
            $dataForm = $request->getParsedBody();
            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['setIntegrity'])) {
                $this->valuationTable->updateIntegrityValuation($dataForm);
                return new RedirectResponse('/valuation/integrity/' . $dataForm['aktiva_id']);
            } else {

                return new RedirectResponse('/valuation/integrity/' . $dataForm['aktiva_id']);
            }
        }

        /** id */
        $id = (int) $request->getAttribute('id') ? : 0;

        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::integrity',
            [
                'id' => $id,
                'valuation' => $this->valuationTable->getValuationById($id),
                'assets' => $this->integrityTable->fetchAll(),
                'description' => $this->integrityTable->fetchAll(),
                'radio' => $this->integrityTable->fetchAll(),
                'colorLevel' => $this->getLevelColor(),
                'levelName' => $this->getLevelName()
            ] // parameters to pass to template
        ));
    }

    public function getLevelColor()
    {
        $colorLevel = [];
        $colorLevel[1] = 'green';
        $colorLevel[2] = 'yellow';
        $colorLevel[3] = 'orange';
        $colorLevel[4] = 'red';

        return $colorLevel;
    }

    public function getLevelName()
    {
        $colorName = [];
        $colorName[1] = 'Nízká';
        $colorName[2] = 'Střední';
        $colorName[3] = 'Vysoká';
        $colorName[4] = 'Kritická';

        return $colorName;
    }
}

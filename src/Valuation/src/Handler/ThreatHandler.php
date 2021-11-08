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
use Valuation\Model\Table\ResultingRateTable;
use Valuation\Model\Table\ThreatTable;
use Valuation\Model\Table\ValuationTable;

class ThreatHandler implements MiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /** @var ThreatTable */
    private $threatTable;

    /** @var ValuationTable */
    private $valuationTable;

    /** @var ResultingRateTable */
    private $resultingRateTable;

    public function __construct(
        ValuationTable $valuationTable,
        ThreatTable $threatTable,
        ResultingRateTable $resultingRateTable,
        TemplateRendererInterface $renderer)
    {
        $this->valuationTable = $valuationTable;
        $this->threatTable = $threatTable;
        $this->resultingRateTable = $resultingRateTable;
        $this->renderer = $renderer;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

        if ($request->getMethod() === 'POST') {
            $dataForm = $request->getParsedBody();

            if (!empty($dataForm['complete_evaluation'])) {

                /** jaké jsou hodnoty */
                $data = $this->valuationTable->getValuationById((int) $dataForm['aktiva_id']);
                if (!empty($data['confidentiality_value']) && !empty($data['integrity_value']) && !empty($data['availability_value'])) {

                    /** spočítání hodnoty aktiva */
                    $value = (3 ** ($data['confidentiality_value'] - 1)) + (3 ** ($data['integrity_value'] - 1)) + (3 ** ($data['availability_value'] - 1));

                    $asset_value = [
                        'aktiva_id' => $dataForm['aktiva_id'],
                        'asset_value' => $value
                    ];
                    $this->valuationTable->setAssetValue($asset_value);

                    $data = $this->valuationTable->getValuationById((int) $dataForm['aktiva_id']);
                    if (!empty($data['impact_value']) && !empty($data['vulnerability_value']) && !empty($data['threat_value']) && !empty($data['asset_value'])) {

                        $resultData = [
                            'level_of_threat' => $data['threat_value'],
                            'level_of_vulnerability' => $data['vulnerability_value'],
                            'level_of_impact' => $data['impact_value']
                        ];

                        $resulting = $this->resultingRateTable->getResultValue((array) $resultData);

                        $degreeRisk = $data['asset_value'] * $resulting['value'];

                        $dataDegreeOfRisk = [
                            'aktiva_id' => $dataForm['aktiva_id'],
                            'result_of_degree_of_risk' => $degreeRisk
                        ];

                        $this->valuationTable->setDegreeOfRisk($dataDegreeOfRisk);
                    }

                    return new RedirectResponse('/valuation');
                }
            }

            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['setThreat'])) {
                $this->valuationTable->updateThreatValuation($dataForm);
                return new RedirectResponse('/valuation/threat/' . $dataForm['aktiva_id']);
            } else {

                return new RedirectResponse('/valuation/threat/' . $dataForm['aktiva_id']);
            }
        }

        /** id */
        $id = (int) $request->getAttribute('id') ? : 0;

        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::threat',
            [
                'id' => $id,
                'valuation' => $this->valuationTable->getValuationById($id),
                'assets' => $this->threatTable->fetchAll(),
                'description' => $this->threatTable->fetchAll(),
                'radio' => $this->threatTable->fetchAll(),
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
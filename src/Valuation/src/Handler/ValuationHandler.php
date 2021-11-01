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
use Valuation\Model\Table\ResultingRateTable;
use Valuation\Model\Table\ValuationTable;

class ValuationHandler extends BaseHandler
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @var ValuationTable
     */
    private $valuationTable;

    /** @var ResultingRateTable */
    private $resultingRateTable;

    public function __construct(
        ValuationTable $valuationTable,
        ResultingRateTable $resultingRateTable,
        TemplateRendererInterface $renderer
    ) {
        $this->valuationTable = $valuationTable;
        $this->resultingRateTable = $resultingRateTable;
        $this->renderer = $renderer;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

        $status = $request->getMethod();
        $flashMessages = null;
        $dataForm = [];

        # check if the request is a form post
        if ($request->getMethod() === 'POST') {

            $json = file_get_contents("php://input");
            $dataForm = json_decode($json, true);

            //$requestBoby = $request->getParsedBody();
            //$dataForm = json_decode($requestBoby['json'], true);

            /** confidentiality */
            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['confidentiality_value'])) {
                $this->valuationTable->updateConfidentialityValuation([
                    'aktiva_id' => $dataForm['aktiva_id'],
                    'setConfidentiality' => $dataForm['confidentiality_value']
                ]);
                $this->complete_evaluation($dataForm);
                return new JsonResponse(['ok' => $dataForm]);
            }

            /** integrity */
            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['integrity_value'])) {
                $this->valuationTable->updateIntegrityValuation([
                    'aktiva_id' => $dataForm['aktiva_id'],
                    'setIntegrity' => $dataForm['integrity_value']
                ]);
                $this->complete_evaluation($dataForm);
                return new JsonResponse(['ok' => $dataForm]);
            }

            /** availability */
            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['availability_value'])) {
                $this->valuationTable->updateAvailabilityValuation([
                    'aktiva_id' => $dataForm['aktiva_id'],
                    'setAvailability' => $dataForm['availability_value']
                ]);
                $this->complete_evaluation($dataForm);
                return new JsonResponse(['ok' => $dataForm]);
            }

            /** impact */
            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['impact_value'])) {
                $this->valuationTable->updateImpactValuation([
                    'aktiva_id' => $dataForm['aktiva_id'],
                    'setImpact' => $dataForm['impact_value']
                ]);
                $this->complete_evaluation($dataForm);
                return new JsonResponse(['ok' => $dataForm]);
            }

            /** vulnerability */
            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['vulnerability_value'])) {
                $this->valuationTable->updateVulnerabilityValuation([
                    'aktiva_id' => $dataForm['aktiva_id'],
                    'setVulnerability' => $dataForm['vulnerability_value']
                ]);
                $this->complete_evaluation($dataForm);
                return new JsonResponse(['ok' => $dataForm]);
            }

            /** threat */
            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['threat_value'])) {
                $this->valuationTable->updateThreatValuation([
                    'aktiva_id' => $dataForm['aktiva_id'],
                    'setThreat' => $dataForm['threat_value']
                ]);
                $this->complete_evaluation($dataForm);
                return new JsonResponse(['ok' => $dataForm]);
            }

            //return new JsonResponse($dataForm);

            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['columns']) && !empty($dataForm['value'])) {

                if ($dataForm['columns'] == 'setConfidentiality') {
                    $this->valuationTable->updateConfidentialityValuation([
                        'aktiva_id' => $dataForm['aktiva_id'],
                        'setConfidentiality' => $dataForm['value']
                    ]);
                }

                if ($dataForm['columns'] == 'setIntegrity') {
                    $this->valuationTable->updateIntegrityValuation([
                        'aktiva_id' => $dataForm['aktiva_id'],
                        'setIntegrity' => $dataForm['value']
                    ]);
                }

                if ($dataForm['columns'] == 'setAvailability') {
                    $this->valuationTable->updateAvailabilityValuation([
                        'aktiva_id' => $dataForm['aktiva_id'],
                        'setAvailability' => $dataForm['value']
                    ]);
                }

                if ($dataForm['columns'] == 'setImpact') {
                    $this->valuationTable->updateImpactValuation([
                        'aktiva_id' => $dataForm['aktiva_id'],
                        'setImpact' => $dataForm['value']
                    ]);
                }

                if ($dataForm['columns'] == 'setVulnerability') {
                    $this->valuationTable->updateVulnerabilityValuation([
                        'aktiva_id' => $dataForm['aktiva_id'],
                        'setVulnerability' => $dataForm['value']
                    ]);
                }

                if ($dataForm['columns'] == 'setThreat') {
                    $this->valuationTable->updateThreatValuation([
                        'aktiva_id' => $dataForm['aktiva_id'],
                        'setThreat' => $dataForm['value']
                    ]);
                }

                $data['message'] = $this->complete_evaluation($dataForm);
                $data['getValue'] = $this->valuationTable->getValuationById((int) $dataForm['aktiva_id']);
                return new JsonResponse(['result' => $data]);
            }

            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['getValueModal'])) {
                $data['getValue'] = $this->valuationTable->getValuationById((int) $dataForm['aktiva_id']);
                //$data['resultingRateTable'] = $this->resultingRateTable->getResultValue();
                return new JsonResponse(['result' => $data]);
            }
        }

        // // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::valuation',
            [
                'pako' => $dataForm,
                'echo' => $this->valuationTable->fetchAllResources(),
                'testPOST' => $dataForm,
                'status' => $status,
                'flashMessages' => $flashMessages,
                'colorLevel' => $this->getLevelColor(),
                'levelName' => $this->getLevelName()
            ] // parameters to pass to template
        ));
    }

    public function complete_evaluation($aktiva_id)
    {
        /** jaké jsou hodnoty */
        $data = $this->valuationTable->getValuationById((int) $aktiva_id['aktiva_id']);
        if (!empty($data['confidentiality_value']) && !empty($data['integrity_value']) && !empty($data['availability_value'])) {

            /** spočítání hodnoty aktiva */
            $value = (3 ** ($data['confidentiality_value'] - 1)) + (3 ** ($data['integrity_value'] - 1)) + (3 ** ($data['availability_value'] - 1));

            $asset_value = [
                'aktiva_id' => $aktiva_id['aktiva_id'],
                'asset_value' => $value
            ];
            $this->valuationTable->setAssetValue($asset_value);

            /** hodnoty z tabulky */
            $data = $this->valuationTable->getValuationById((int) $aktiva_id['aktiva_id']);            
            if (!empty($data['impact_value']) && !empty($data['vulnerability_value']) && !empty($data['threat_value']) && !empty($data['asset_value'])) {

                $resultData = [
                    'level_of_impact' => $data['impact_value'],
                    'level_of_vulnerability' => $data['vulnerability_value'],
                    'level_of_threat' => $data['threat_value']
                ];

                $resulting = $this->resultingRateTable->getResultValue((array) $resultData);

                $degreeRisk = $data['asset_value'] * $resulting['value'];

                $dataDegreeOfRisk = [
                    'aktiva_id' => $aktiva_id['aktiva_id'],
                    'result_of_degree_of_risk' => $degreeRisk
                ];

                $this->valuationTable->setDegreeOfRisk($dataDegreeOfRisk);
            }
        }
    }
}

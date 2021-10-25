<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Csrf\CsrfMiddleware;
use Mezzio\Flash\FlashMessageMiddleware;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Server\MiddlewareInterface;
use Valuation\Base\BaseHandler;
use Valuation\Model\Table\ValuationTable;

class ValuationHandler extends BaseHandler
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    private $valuationTable;

    public function __construct(
        ValuationTable $valuationTable,
        TemplateRendererInterface $renderer
    ) {
        $this->valuationTable = $valuationTable;
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

            



            //$requestBoby = $request->getParsedBody();
            $dataForm = json_decode(file_get_contents('php://input'), true);

            //$requestBoby = $request->getParsedBody();
            //$dataForm = json_decode($requestBoby['json'], true);
         
            // if (!empty($dataForm['aktiva_id']) && !empty($dataForm['aktiva_column']) && !empty($dataForm['aktiva_value'])) {
            //     return new JsonResponse(['ok' => $dataForm]);
            // } else {
            //     return new JsonResponse(['error' => $dataForm]);
            // }
            return new JsonResponse($dataForm);
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
        $data = $this->valuationTable->getValuationById((int) $aktiva_id);
        if (!empty($data['confidentiality_value']) && !empty($data['integrity_value']) && !empty($data['availability_value'])) {

            /** spočítání hodnoty aktiva */
            $value = (3 ** ($data['confidentiality_value'] - 1)) + (3 ** ($data['integrity_value'] - 1)) + (3 ** ($data['availability_value'] - 1));

            $asset_value = [
                'aktiva_id' => $aktiva_id,
                'asset_value' => $value
            ];
            $this->valuationTable->setAssetValue($asset_value);

            $data = $this->valuationTable->getValuationById((int) $aktiva_id);
            if (!empty($data['impact_value']) && !empty($data['vulnerability_value']) && !empty($data['threat_value']) && !empty($data['asset_value'])) {

                $resultData = [
                    'level_of_threat' => $data['threat_value'],
                    'level_of_vulnerability' => $data['vulnerability_value'],
                    'level_of_impact' => $data['impact_value']
                ];

                $resulting = $this->resultingRateTable->getResultValue((array) $resultData);

                $degreeRisk = $data['asset_value'] * $resulting['value'];

                $dataDegreeOfRisk = [
                    'aktiva_id' => $aktiva_id,
                    'result_of_degree_of_risk' => $degreeRisk
                ];

                $this->valuationTable->setDegreeOfRisk($dataDegreeOfRisk);
            }
        }
    }
}

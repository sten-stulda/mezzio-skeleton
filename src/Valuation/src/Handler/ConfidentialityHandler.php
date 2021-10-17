<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Album\Form\AlbumForm;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Valuation\Form\ConfidentialityValuationForm;
use Valuation\Model\Table\ConfidentialityTable;
use Valuation\Model\Table\ValuationTable;

class ConfidentialityHandler implements RequestHandlerInterface
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

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        /** id */
        $id = (int) $request->getAttribute('id') ? : 0;

        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::confidentiality',
            [
                'id' => $id,
                'valuation' => $this->valuationTable->getValuationById($id),
                'assets' => $this->confidentialityTable->fetchAll(),
                'description' => $this->confidentialityTable->fetchAll(),
                'radio' => $this->confidentialityTable->fetchAll(),
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

    public function testAction()
    {
        # ok now I am in the ProfileCOntroller
        # the reason I am here is because I want us to now display the profile picture

        //$id = (int) $this->params()->fromRoute('id');
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

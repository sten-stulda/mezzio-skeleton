<?php

declare(strict_types=1);

namespace Valuation\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Valuation\Model\Table\ValuationTable;

class ValuationController extends AbstractActionController
{
    private $valuationTable;

    public function __construct(ValuationTable $valuationTable)
    {
        $this->valuationTable = $valuationTable;
    }

    public function testAction()
    {
        // $id = (int) $this->params()->fromRoute('id', 0);
        // if (!$id) {
        //     return $this->redirect()->toRoute('album');
        // }

        // $request = $this->getRequest();
        // if ($request->isPost()) {
        //     $del = $request->getPost('del', 'No');

        //     if ($del == 'Yes') {
        //         $id = (int) $request->getPost('id');
        //         $this->table->deleteAlbum($id);
        //     }

        //     // Redirect to list of albums
        //     return $this->redirect()->toRoute('album');
        // }

        // return [
        //     'id'    => $id,
        //     'album' => $this->table->getAlbum($id),
        // ];

        return $this->redirect()->toRoute('valuation.home');

        return new ViewModel();
    }

}
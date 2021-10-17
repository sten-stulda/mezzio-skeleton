<?php 

declare(strict_types=1);

namespace Valuation\Model\Table;

use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Adapter\Adapter;

class ValuationTable extends AbstractTableGateway
{
    protected $table = 'valuation';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function fetchAllResources()
    {
        $sqlQuery = $this->sql->select();
        $sqlStmt = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result = $sqlStmt->execute();

        return $result;
    }

    public function getValuationById(int $id)
    {
        $sqlQuery = $this->sql->select()->where(['aktiva_id' => $id]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute()->current();
        return $result;
    }

    public function updateConfidentialityValuation(array $data)
    {
        $sqlQuery = $this->sql->update()->set(['confidentiality_value' => $data['confidentiality']])->where(['aktiva_id' => $data['aktiva_id']]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute();
        return $result;
    }

    
}

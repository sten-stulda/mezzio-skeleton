<?php

declare(strict_types=1);

namespace Valuation\Model\Table;

use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Adapter\Adapter;

class ConfidentialityTable extends AbstractTableGateway
{
    protected $table = 'confidentiality';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function getFetchAllData()
    {
        $sqlQuery = $this->sql->select();
        $sqlStmt = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result = $sqlStmt->execute();
        return $result;
    }

    public function getConfidentialityById(int $id)
    {
        $sqlQuery = $this->sql->select()->where(['id' => $id]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute()->current();
        return $result;
    }

}

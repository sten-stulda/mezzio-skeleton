<?php

declare(strict_types=1);

namespace Valuation\Model\Table;

use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Adapter\Adapter;

class ResultingRateTable extends AbstractTableGateway
{
    protected $table = 'resulting_rate';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function getResultValue(array $data)
    {
        $sqlQuery = $this->sql->select()->where($data);
        $sqlStmt = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result = $sqlStmt->execute()->current();
        return $result;
    }
}

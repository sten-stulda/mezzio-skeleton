<?php

declare(strict_types=1);

namespace Valuation\Model\Table;

use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Adapter\Adapter;

class AvailabilityTable extends AbstractTableGateway
{
    protected $table = 'availability';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function fetchAll()
    {
        $sqlQuery = $this->sql->select();
        $sqlStmt = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result = $sqlStmt->execute();
        return $result;
    }
}

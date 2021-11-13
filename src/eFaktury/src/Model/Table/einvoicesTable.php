<?php

declare(strict_types=1);

namespace eFaktury\Model\Table;

use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Adapter\Adapter;

class einvoicesTable extends AbstractTableGateway
{
    protected $table = 'einvoices';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function getFetchAll()
    {
        $sqlQuery = $this->sql->select();
        $sqlStmt = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result = $sqlStmt->execute();
        return $result;
    }
}

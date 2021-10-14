<?php 

declare(strict_types=1);

namespace Valuation\Model\Table;

use Laminas\Crypt\Password\Bcrypt;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Adapter\Adapter;
use Laminas\Filter;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\I18n;
use Laminas\InputFilter;
use Laminas\Validator;
use Valuation\Model\Entity\ValuationEntity;

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

        // $entity = new ValuationEntity();
        // $method = new ClassMethodsHydrator();
        // $method->hydrate($result, $entity);
        return $result;
    }

    
}

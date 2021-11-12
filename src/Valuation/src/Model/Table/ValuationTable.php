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
        $sqlQuery = $this->sql->update()->set(['confidentiality_value' => $data['setConfidentiality']])->where(['aktiva_id' => $data['aktiva_id']]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute();
        return $result;
    }

    public function updateIntegrityValuation(array $data)
    {
        $sqlQuery = $this->sql->update()->set(['integrity_value' => $data['setIntegrity']])->where(['aktiva_id' => $data['aktiva_id']]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute();
        return $result;
    }

    public function updateAvailabilityValuation(array $data)
    {
        $sqlQuery = $this->sql->update()->set(['availability_value' => $data['setAvailability']])->where(['aktiva_id' => $data['aktiva_id']]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute();
        return $result;
    }

    public function updateImpactValuation(array $data)
    {
        $sqlQuery = $this->sql->update()->set(['impact_value' => $data['setImpact']])->where(['aktiva_id' => $data['aktiva_id']]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute();
        return $result;
    }

    public function updateVulnerabilityValuation(array $data)
    {
        $sqlQuery = $this->sql->update()->set(['vulnerability_value' => $data['setVulnerability']])->where(['aktiva_id' => $data['aktiva_id']]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute();
        return $result;
    }

    public function updateThreatValuation(array $data)
    {
        $sqlQuery = $this->sql->update()->set(['threat_value' => $data['setThreat']])->where(['aktiva_id' => $data['aktiva_id']]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute();
        return $result;
    }

    public function setAssetValue(array $data)
    {
        $sqlQuery = $this->sql->update()->set(['asset_value' => $data['asset_value']])->where(['aktiva_id' => $data['aktiva_id']]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute();
        return $result;
    }

    public function setDegreeOfRisk(array $data)
    {
        $sqlQuery = $this->sql->update()->set(['result_of_degree_of_risk' => $data['result_of_degree_of_risk']])->where(['aktiva_id' => $data['aktiva_id']]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute();
        return $result;
    }
    
}

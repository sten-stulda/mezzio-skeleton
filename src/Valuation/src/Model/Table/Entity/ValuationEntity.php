<?php 

declare(strict_types=1);

namespace Valuation\Model\Entity;

class ValuationEntity 
{
    protected $id;
    protected $aktiva_id;
    protected $level1;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getAktivaId()
    {
        return $this->aktiva_id;
    }

    public function setAktivaId($aktiva_id)
    {
        $this->aktiva_id = $aktiva_id;
        return $this;
    }

     public function getLevel()
    {
        return $this->level1;
    }

    public function setLevel($level1)
    {
        $this->level1 = $level1;
        return $this;
    }

}
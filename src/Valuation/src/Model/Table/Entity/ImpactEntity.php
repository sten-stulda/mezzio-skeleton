<?php

declare(strict_types=1);

namespace Valuation\Model\Entity;

class ConfidentialityEntity
{
    protected $id;
    protected $description;
    protected $description_level_1;
    protected $description_level_2;
    protected $description_level_3;
    protected $description_level_4;


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of description_level_1
     */ 
    public function getDescription_level_1()
    {
        return $this->description_level_1;
    }

    /**
     * Set the value of description_level_1
     *
     * @return  self
     */ 
    public function setDescription_level_1($description_level_1)
    {
        $this->description_level_1 = $description_level_1;

        return $this;
    }

    /**
     * Get the value of description_level_2
     */ 
    public function getDescription_level_2()
    {
        return $this->description_level_2;
    }

    /**
     * Set the value of description_level_2
     *
     * @return  self
     */ 
    public function setDescription_level_2($description_level_2)
    {
        $this->description_level_2 = $description_level_2;

        return $this;
    }

    /**
     * Get the value of description_level_3
     */ 
    public function getDescription_level_3()
    {
        return $this->description_level_3;
    }

    /**
     * Set the value of description_level_3
     *
     * @return  self
     */ 
    public function setDescription_level_3($description_level_3)
    {
        $this->description_level_3 = $description_level_3;

        return $this;
    }

    /**
     * Get the value of description_level_4
     */ 
    public function getDescription_level_4()
    {
        return $this->description_level_4;
    }

    /**
     * Set the value of description_level_4
     *
     * @return  self
     */ 
    public function setDescription_level_4($description_level_4)
    {
        $this->description_level_4 = $description_level_4;

        return $this;
    }
}
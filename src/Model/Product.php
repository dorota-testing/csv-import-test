<?php

namespace Model;

class Product
{
    private $code;
    private $name;
    private $description;
    private $stock;
    private $price;
    private $discontinued = '';

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param string
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param string
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }
    /**
     * @param int
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * @param int
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return str
     */
    public function getDiscontinued()
    {
        return $this->discontinued;
    }

    /**
     * @param string 
     */
    public function setDiscontinued($discontinued)
    {
        $this->discontinued = $discontinued;
    }
}

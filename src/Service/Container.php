<?php
namespace Service;
class Container
{
    private $configuration;
    private $database; //this is to start object Database
    private $productImport; 
    private $csvImport; 

    public function __construct(array $arrConfig)
    {
        $this->configuration = $arrConfig;
    }

    /**
     * @return Database
     */
    public function getDatabase()
    {
        if ($this->database === null) { //this prevents instantiation if already exists
            $this->database = new Database($this->configuration);
        }
        return $this->database;
    } 

    /**
     * @return CsvImport
     */
    public function getCsvImport()
    {
        if ($this->csvImport === null) { //this prevents instantiation if already exists
            $this->csvImport = new CsvImport();
        }
        return $this->csvImport;
    } 

    /**
     * @return ProductImport
     */
    public function getProductImport()
    {
        if ($this->productImport === null) { //this prevents instantiation if already exists
            $this->productImport = new ProductImport($this->configuration, $this->getDatabase(), $this->getCsvImport());
        }
        return $this->productImport;
    }  
}
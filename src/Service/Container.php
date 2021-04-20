<?php
namespace Service;
class Container
{
    private $configuration;
    private $database; //this is to start object Database
    private $userHandler; //this is to start object userHandler

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
     * @return UserHandler
     */
    public function getUserHandler()
    {
        if ($this->userHandler === null) { //this prevents instantiation if already exists
            $this->userHandler = new UserHandler($this->configuration, $this->getDatabase());
        }
        return $this->userHandler;
    } 
}
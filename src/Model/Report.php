<?php

namespace Model;

class Report
{
    private $totalItems = 0;
    private $itemsSuccessful = 0;
    private $itemsSkippedError = 0;
    private $itemsSkippedLess = 0;
    private $itemsSkippedOver = 0;
    private $itemsDuplicate = 0;
    private $errorDetails = [];
    private $mode = 'test';

    /**
     * @return int
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }
    /**
     * @param int $totalItems
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
    }
    /**
     * @return int
     */
    public function incrementTotalItems()
    {
        $this->totalItems++;
    }

    /**
     * @return int
     */
    public function getItemsSuccessful()
    {
        return $this->itemsSuccessful;
    }
    /**
     * @param int $itemsSuccessful
     */
    public function setItemsSuccessful($itemsSuccessful)
    {
        $this->itemsSuccessful = $itemsSuccessful;
    }

    public function incrementItemsSuccessful()
    {
        $this->itemsSuccessful++;
    }

    /**
     * @return int
     */
    public function getItemsSkippedError()
    {
        return $this->itemsSkippedError;
    }
    /**
     * @param int $itemsSkippedError
     */
    public function setItemsSkippedError($itemsSkippedError)
    {
        $this->itemsSkippedError = $itemsSkippedError;
    }

    public function incrementItemsSkippedError()
    {
        $this->itemsSkippedError++;
    }
    /**
     * @return int
     */
    public function getItemsSkippedLess()
    {
        return $this->itemsSkippedLess;
    }
    /**
     * @param int 
     */
    public function setItemsSkippedLess($itemsSkippedLess)
    {
        $this->itemsSkippedLess = $itemsSkippedLess;
    }
    public function incrementItemsSkippedLess()
    {
        $this->itemsSkippedLess++;
    }
    /**
     * @return int
     */
    public function getTotalSkipped()
    {
        return $this->itemsSkippedError  
        + $this->itemsSkippedLess 
        + $this->itemsSkippedOver
        + $this->itemsDuplicate;
    }

    /**
     * @return int
     */
    public function getItemsSkippedOver()
    {
        return $this->itemsSkippedOver;
    }
    /**
     * @param int 
     */
    public function setItemsSkippedOver(int $itemsSkippedOver)
    {
        $this->itemsSkippedOver = $itemsSkippedOver;
    }
    public function incrementItemsSkippedOver()
    {
        $this->itemsSkippedOver++;
    }

    /**
     * @return int
     */
    public function getItemsDuplicate()
    {
        return $this->itemsDuplicate;
    }
    /**
     * @param int 
     */
    public function setItemsDuplicate(int $itemsDuplicate)
    {
        $this->itemsDuplicate = $itemsDuplicate;
    }
    public function incrementItemsDuplicate()
    {
        $this->itemsDuplicate++;
    }

    /**
     * @return array
     */
    public function getErrorDetails()
    {
        return $this->errorDetails;
    }
    /**
     * @param array 
     */
    public function setErrorDetails(array $errorDetails)
    {
        $this->errorDetails = $errorDetails;
    }
    /**
     * @param string 
     */
    public function addErrorDetails(string $errorDetails)
    {
        $this->errorDetails[] = $errorDetails;
    }

    
    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }
    /**
     * @param string
     */
    public function setMode(string $mode)
    {
        $this->mode = $mode;
    }

    /**
     * @return string
     */
    public function printReport()
    {
        $mode = ($this->mode == 'test' ? ' in test mode' : '');
        $success = ($this->mode == 'test' ? 'marked successful' : 'succesfully inserted in the database');
        $error = implode("\n", $this->getErrorDetails());
        printf("
The file was processed%s.\n
\n
Total of %s products was processed.\n
Of which %s products was %s, and %s skipped.\n
* %s items was skipped because price was under £5 and stock under 10.\n
* %s items was skipped because price was over £1000.\n
* %s items was skipped because Product Code was duplicate of already saved item.\n
* %s items was skipped because of import error.\n
\n
Items with import error:\n
%s
            ", 
            $mode, 
            $this->getTotalItems(), 
            $this->getItemsSuccessful(), 
            $success,
            $this->getTotalSkipped(), 
            $this->getItemsSkippedLess(),
            $this->getItemsSkippedOver(),
            $this->getItemsDuplicate(),
            $this->getItemsSkippedError(),
            $error
        );
    }
}

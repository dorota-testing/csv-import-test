<?php
namespace Model;
class User {
    private $id;
    private $email;
    private $forename;
    private $surname;
    private $password;
    private $role;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    } 

    /**
     * @return str
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param int $str
     */
    public function setEmail($email)
    {
        $this->email = $email;
    } 
    
    /**
     * @return str
     */
    public function getForename()
    {
        return $this->forename;
    }
    /**
     * @param int $str
     */
    public function setForename($forename)
    {
        $this->forename = $forename;
    }
    
     /**
     * @return str
     */
    public function getSurname()
    {
        return $this->surname;
    }
    /**
     * @param int $str
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return str
     */
    public function getFullname()
    {
        return $this->forename .' '. $this->surname;
    } 

     /**
     * @return str
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param int $str
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

     /**
     * @return str
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * @param int $int 0-inactive, 1-admin, 2-regular
     */
    public function setRole($role)
    {
        $this->role = $role;
    } 
     /**
     * @return str
     */
    public function getRoleName()
    {
        if($this->role == 0)
        {
            return "inactive";
        } else if ($this->role == 1) {
            return "admin";
        } else if ($this->role == 2) {
            return "regular";
        }
    }    
    public function isActive()
    {
        if($this->role > 0)
        {
            return true;
        } else {
            return false;
        }
    }     
}
<?php



namespace App\Models;

class Customer {
 
    private $username;
    private $fullname;
    private $email;
    
    function __construct($username,$fullname,$email) {
        $this->setUsername($username);
        $this->setFullname($fullname);
        $this->setEmail($email);
    }


    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function setFullname($fullname){
        $this->fullname = $fullname;
    }
    
    public function getFullname(){
        return $this->fullname;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    
    
}

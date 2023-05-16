<?php

class RegisterUserController extends RegisterUser{    
    private $name;
    private $email;
    private $password;
    private $confirm_password;

    public function __construct($name, $email, $password, $confirm_password)
    {        
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
    }

    public function store()
    {
        // Validations
        if(!$this->empytInput()){
            Page::route('/register.php?error=emptyinput');
        }
        if(!$this->invalidEmail()){
            Page::route('/register.php?error=emptyinput');
        }
        if(!$this->passwordMatch()){
            Page::route('/register.php?error=passwordnotmatch');
        }
        if($this->emailTakenCheck()){
            Page::route('/register.php?error=useremailtaken');
        }
        
        $this->setUser($this->name, $this->email, $this->password);
    }

    private function empytInput(){
        $result = null;
        if(empty($this->name) || empty($this->email) || empty($this->password) ||
         empty($this->confirm_password)){
             $result = false;             
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidEmail(){
        $result = null;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
             $result = false;             
        }else{
            $result = true;
        }
        return $result;
    }

    private function passwordMatch()
    {
        $result = null;
        if($this->password !== $this->confirm_password){
             $result = false;             
        }else{
            $result = true;
        }
        return $result;
    }

    private function emailTakenCheck()
    {
        return $this->checkUser($this->email);
    }    
}
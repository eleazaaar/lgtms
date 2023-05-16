<?php

class RegisterUser extends Database{

    protected function setUser($name, $email, $password){
        $sql = "INSERT INTO lgt_users (name, email, password) VALUES(:name,:email,:pass);";
        $pdo = $this::connection();     
        $stmt = $pdo->prepare($sql);     

        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        
        $params = [
            ':name'=>$name,
            ':email'=>$email,
            ':pass'=>$hash_password,
        ];
        if($stmt->execute($params)){
            Page::route('/index.php?message=success');
        }
        Page::route('/register.php?message=somethingwentwrong');
    }

    // Check weather if email already exists
    protected function checkUser($email)
    {
        $sql = "SELECT id FROM lgt_users WHERE email=:email";   
        $pdo = $this::connection();     
        $stmt = $pdo->prepare($sql);        
        $stmt->execute([':email'=>$email]);

        $result = $stmt->fetchAll();        
        return (count($result)>0);
    }

    private function getUserByEmail($email)
    {
        $sql = "SELECT id FROM lgt_users WHERE email=:email";   
        $pdo = $this->connection();     
        $stmt = $pdo->prepare($sql);        
        $stmt->execute([':email'=>$email]);

        $result = $stmt->fetchAll();
        return $result;        
    }
}
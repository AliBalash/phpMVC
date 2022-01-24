<?php

class User
{

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register($data)
    {
//        prepare statement
        $this->db->query("INSERT INTO users (username,email,password,role) VALUES (:username,:email,:password,:role)");
//        bind param whit value
        $this->db->bind(":username" , $data['username']);
        $this->db->bind(":email" , $data['email']);
        $this->db->bind(":password" , $data['password']);
        $this->db->bind(":role" , $data['role']);

//        execute function
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function findUserByEmail($email)
    {
//          Prepared statement
        $this->db->query("SELECT * from users where email = :email");
//          email param will bind whit email variable
        $this->db->bind(':email', $email);

//        check email already register
        if (count($this->db->resultSet()) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function login($data)
    {
        $this->db->query('SELECT * FROM users WHERE (username =:username AND email =:email)');
        $this->db->bind(':username',$data['username']);
        $this->db->bind(':email',$data['email']);
        $row = $this->db->single();
        if ($row){
            $hashPassword = $row->password;
            if (password_verify($data['password'],$hashPassword)){
                return $row;
            }else{
                return false;
            }
        }



    }

}















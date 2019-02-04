<?php
namespace App\Models;

use Framework\Model;

class User extends Model
{
    protected $table = 'users';

    private $id;
    private $username;
    private $email;
    private $password;

    function __construct($id,$username,$email,$password){
        $this->id =$id;
        $this->username =$username;
        $this->email =$email;
        $this->password =$password;

    }

    public static function getModel(array $res){
        return new User($res['id'] ,$res['username'] ,$res['email'] ,$res['password']);
    }

    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

}

<?php
namespace App\Controllers;

use Framework\Controller;
use App\Models\User;
use App\Repository\UserRepository;

/**
 * Class UserController
 */
class UserController extends Controller
{


    private $userRepostory;

    public function __construct($params){
        parent::__construct($params);
        $this->userRepository = new UserRepository();
    }

    public function editPage(){
        $userId=  $_SESSION['logged'];
        $user = $this->userRepository->getUserById($userId);
        return $this->view("user/edit.html",['user' => $user]);
    }

    public function loginAction() {   
            $errros =[];
    
                if(isset($_POST['edit-submit'])) {
                $validEdit =true;
    
                if(!isset($_POST['username']) || $_POST['username'] == ''){
                    $errors[] = "A username must be introduced!";
                    $validEdit =false;
                }
                                     
                if(!isset($_POST['password']) || $_POST['password'] == ''){
                    $errors[] = "A password must be introduced!";
                    $validEdit =false;
                }
    
                if(!isset($_POST['confirmPassword']) || $_POST['confirmPassword'] == ''){
                    $errors[] = "Please retype password!";
                    $validEdit =false;
                } else {
                    if($_POST['confirmPassword'] !== $_POST['password'] ){
                        $errors[] = "Passwords did not match";
                    }
                }
    
                if($validEdit){
                    $userId =$_SESSION['logged'] ;
                    $user = new User($userId, $_POST['username'],$_POST['email'], $_POST['password']);
                    $userId=$this->doEdit($user);
                    header('Location: /');
                }
    
            }
            return $this->view("login/register.html", ['errors'=>$errors]);
        }

        public function doEdit($user){
            $this->userRepository->edit($user);
        }

}

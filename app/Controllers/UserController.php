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
        $user = $this->userRepository.getUserById($userId);
    }

    public function loginAction() {   
            $errros =[];
    
                if(isset($_POST['edit-submit'])) {
                $validLogin =true;
    
                if(!isset($_POST['username']) || $_POST['username'] == ''){
                    $errors[] = "A username must be introduced!";
                    $validLogin =false;
                }
    
                if(!isset($_POST['email']) || $_POST['email']=='' ){
                    $errors[] = "An e-mail must be introduced!";
                    $validLogin =false;
                }
                       
                if(!isset($_POST['password']) || $_POST['password'] == ''){
                    $errors[] = "A password must be introduced!";
                    $validLogin =false;
                }
    
                if(!isset($_POST['confirmPassword']) || $_POST['confirmPassword'] == ''){
                    $errors[] = "Please retype password!";
                    $validLogin =false;
                } else {
                    if($_POST['confirmPassword'] !== $_POST['password'] ){
                        $errors[] = "Passwords did not match";
                    }
                }
    
                if($validLogin){
                    $userId =$_SESSION['logged'] ;
                    $user = new User($userId, $_POST['username'],$_POST['email'], $_POST['password']);
                    $userId=$this->doEdit($user);
                    return $this->view("login/login.html", ['errors'=>['Profile eddited sucessful, please login now!']]);
                }
    
            }
            return $this->view("login/register.html", ['errors'=>$errors]);
        }

        public function doEdit($user){
            $this->userRepository->edit($user);
        }

}

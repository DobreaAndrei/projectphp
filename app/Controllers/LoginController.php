<?php
namespace App\Controllers;

use App\Repository\UserRepository;

use Framework\Controller;
use App\Models\User;

/**
 * Class LoginController
 */
class LoginController extends Controller
{
    
    private $userRepostory;

    public function __construct(){
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function loginPage(){
        return $this->view("login/login.html");
    }

    public function registerPage(){
        return $this->view("login/register.html");
    }

    public function loginAction() {   
        $errros =[];

            if(isset($_POST['login-submit'])) {
            $validLogin =true;

            if(!isset($_POST['email']) || $_POST['email']=='' ){
                $errors[] = "An e-mail must be introduced!";
                $validLogin =false;
            }
                   
            if(!isset($_POST['password']) || $_POST['password'] == ''){
                $errors[] = "A password must be introduced!";
                $validLogin =false;
            }

            if($validLogin){
                $userId=$this->doLogin($_POST['email'],$_POST['password']);
                if($userId){
                    $_SESSION['logged'] =$userId;
                    header('Location: /');
                }else{
                    $errors[] ="The email or password introduced does not exists!";
                }
            }

        }
        return $this->view("login/login.html", ['errors'=>$errors]);
    }

    public function registerAction(){
        $errros =[];

            if(isset($_POST['register-submit'])) {
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
                $user = new User(null, $_POST['username'],$_POST['email'], $_POST['password']);
                $userId=$this->doCreate($user);
                return $this->view("login/login.html", ['errors'=>['Registration sucessful, please login now!']]);
            }

        }
        return $this->view("login/register.html", ['errors'=>$errors]);
    }

    public function logoutAction(){
        session_unset();
        header('Location: /');
    }

    private function doLogin($email,$password) {
        $user = $this->userRepository->checkLogin($email,$password);
        if($user){
        return $user->getId();
        }
        return false;
    }
 
    private function doCreate($user) {
        $this->userRepository->create($user);
    }
     
}

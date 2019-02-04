<?php
namespace App\Controllers;

use Framework\Controller;

/**
 * Class PageController
 */
class PageController extends Controller
{
    public function aboutUsAction()
    {
        return $this->view("pages/about-us.html");
    }

    public function home(){
        if(!$_SESSION['logged'] == ''){
           header('Location: /updates');
        }        
        return $this->view("login/login.html");
    }

}

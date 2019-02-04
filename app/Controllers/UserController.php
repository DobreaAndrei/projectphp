<?php
namespace App\Controllers;

use Framework\Controller;
use App\Models\User;

/**
 * Class UserController
 */
class UserController extends Controller
{
    public function showAction($id)
    {
        $user = (new User)->get($id);

        return $this->view('user/show.html', ["user" => $user]);
    }

}

<?php
namespace App\Guards;

use Framework\Guard;

class Authenticated implements Guard
{
    public function handle(array $params = null)
    {
        if (!isset($_SESSION['logged'])) {
            $this->reject();
            return false; 
        }
        return true;
            
    }

    public function reject()
    {
        header("Location: /login");
    }
}

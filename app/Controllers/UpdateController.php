<?php
namespace App\Controllers;

use App\Repository\UpdateRepository;

use Framework\Controller;
use App\Models\Update;

/**
 * Class LoginController
 */
class UpdateController extends Controller
{
    
    private $updateRepository;

    private  $userId;

    private $updates;

    private $editUpdateId;

    public function __construct(){
        parent::__construct();
        $this->updateRepository = new UpdateRepository();
    }

    public function updatesPage(){
        $userId=$_SESSION['logged'];
        $updates = $this->getUpdatesByUserId($userId);
        return $this->view("updates/updates.html",['updates' => $updates]);
    }
  
    public function logoutAction(){
        session_unset();
        header('Location: /');
    }

    private function doUpdate($update) {
        $this->updateRepository->update($update);
    }
 
    private function createPage(){
        return $this->view("updates/add.html");
    }

    private function editPage(){
        return $this->view("update/edit.html");
    }

    private function createUpdate(){
        $errros =[];

        if(isset($_POST['save-submit'])) {
        $validAdd =true;

        if(!isset($_POST['applicationName']) || $_POST['applicationName'] == ''){
            $errors[] = "An application name must be introduced!";
            $validAdd =false;
        }

        if(!isset($_POST['every']) || $_POST['every']=='' ){
            $errors[] = "An every must be introduced!";
            $validAdd =false;
        }
               
        if(!isset($_POST['lastUpdate']) || $_POST['lastUpdate'] == ''){
            $errors[] = "A last update must be introduced!";
            $validAdd =false;
        }

        if($validAdd){
            $update = new Update(null, $_POST['applicationName'],$_POST['applicationName'], $_POST['lastUpdate'],0, $userId);
            $updates[] = $this->doCreate($update);
            $this->updatesPage();
            return $this->view("updates/add.html", ['errors'=>['Edit successfully!'],'updates' => $updates]);
        }

    }
    return $this->view("login/register.html", ['errors'=>['Edit failed!']]);
    }

    private function editUpdate(){
        $errros =[];

        if(isset($_POST['save-submit'])) {
        $validAdd =true;

        if(!isset($_POST['applicationName']) || $_POST['applicationName'] == ''){
            $errors[] = "An application name must be introduced!";
            $validAdd =false;
        }

        if(!isset($_POST['every']) || $_POST['every']=='' ){
            $errors[] = "An every must be introduced!";
            $validAdd =false;
        }
               
        if(!isset($_POST['lastUpdate']) || $_POST['lastUpdate'] == ''){
            $errors[] = "A last update must be introduced!";
            $validAdd =false;
        }

        if($validAdd){
            $update = new Update(null, $_POST['applicationName'],$_POST['applicationName'], $_POST['lastUpdate'],0, $userId);
            $updates[] = $this->doEdit($update);
            return $this->view("updates/add.html", ['errors'=>['Save successfully!'],'updates' => $updates]);
        }

    }
    return $this->view("login/register.html", ['errors'=>$errors]);
    }



    private function doCreate($update) {
        $this->updateRepository->create($update);
    }

    private function doEdit($update) {
        $this->updateRepository->edit($update);
    }
     
    private function doDeleted($update){
        $this->updateRepository->delete($update);
    }

    private function getUpdatesByUserId($userId){
        return $this->updateRepository->getUpdateByUserId($userId);
    }
}

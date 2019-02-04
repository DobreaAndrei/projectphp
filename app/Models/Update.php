<?php
namespace App\Models;

use Framework\Model;

class Update extends Model
{
    protected $table = 'updates';

    private $applicationName;
    private $every;
    private $id;
    private $lastUpdate;
    private $status;
    private $userId;

    function __construct($id,$applicationName,$every,$lastUpdate,$status,$userId){
        $this->id =$id;
        $this->applicationName =$applicationName;
        $this->every =$every;
        $this->lastUpdate =$lastUpdate;
        $this->status =$status;
        $this->userId =$userId;

    }

    public static function getModel(array $res){
        return new Update($res['id'] ,$res['application_name'] ,$res['every'] ,$res['last_update'],$res['status'] ,$res['user_id']);
    }

    public function getId(){
        return $this->id;
    }

    public function getApplicationName(){
        return $this->applicationName;
    }

    public function getEvery(){
        return $this->every;
    }

    public function getLastUpdate(){
        return $this->lastUpdate;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getUserId(){
        return $this->userId;
    }

}

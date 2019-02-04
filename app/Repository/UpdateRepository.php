<?php

namespace App\Repository;

use Framework\Db;
use App\Models\Update;


class UpdateRepository{

    protected $db;

    function __construct(){
        $this->db = Db::getInstance();
    }

    public function create($update){
        try {

            $req = $this->db->prepare('INSERT INTO updates(user_id,application_name,every,
            last_update,status) VALUES(:user_id, :application_name, :every,:last_update,:status)');
            $req->bindParam(':user_id', $update->getUserId());
            $req->bindParam(':application_name', $update->getApplicationName());
            $req->bindParam(':every', $update->getEvery());
            $req->bindParam(':last_update', $update->getLastUpdate());
            $req->bindParam(':status', $update->getStatus());

            $req->execute();
        } catch (PDOException $e) {

        }
    }

    public function delete($update){

        try {

            $req = $this->db->prepare('UPDATE updates set status = 1 WHERE id=:id');
            $req->bindParam(':id', $update->getId());
            $req->execute();
        } catch (PDOException $e) {

        }
    }

    public function edit($update){
        
        try {

            $req = $this->db->prepare('UPDATE updates set application_name= :application_name,
            every= :every,
            last_update= :last_update  WHERE id=:id');
            $req->bindParam(':id', $update->getId());
            $req->bindParam(':application_name', $update->getApplicationName());
            $req->bindParam(':every', $update->getEvery());
            $req->bindParam(':last_update', $update->getLastUpdate());
  
            $req->execute();
        } catch (PDOException $e) {

        }
    }

    public function update($update){
        
        try {

            $req = $this->db->prepare('UPDATE updates set status = 1 WHERE id=:id');
            $req->bindParam(':id', $update->getId());
            $req->bindParam(':last_update', $update->getLastUpdate());

            $req->execute();
        } catch (PDOException $e) {

        }
    }


    public function getUpdateByUserId($userId){

        // we make sure $id is an integer
        $id = intval($userId);

        $req = $this->db->prepare('SELECT * FROM updates WHERE user_id = :user_id and status= 0');
        $req->execute(array('user_id' => $userId));
        $resp = $req->fetchAll();
        $updates =[];
        foreach($resp as $row){
            $updates[] = Update::getModel($row);
        }
        return $updates;
    }

    public function getUpdateById($updateId){

        $id = intval($updateId);

        $req = $this->db->prepare('SELECT * FROM updates WHERE id = :id');
        $req->execute(array('id' => $id));
        $res = $req->fetch();
    
        if($res)
        $update = Update::getModel($res);

        return $update;
    }
    

}
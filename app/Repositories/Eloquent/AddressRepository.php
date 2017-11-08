<?php
namespace App\Repositories\Eloquent;

use App\Address;

class AddressRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Address::class;
    }


    function findByUser($id){
        $address = $this->model->where('user_id',$id)->get();
        return $address;

    }



}
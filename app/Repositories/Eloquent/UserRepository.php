<?php
namespace App\Repositories\Eloquent;

use App\User;

class UserRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return User::class;
    }

    public function update($user,array $attributes){
        $user = $this->model->find($user->id);
        $user->name = $attributes['name'];
        $user->save();
        return $user;
    }


}
<?php 

namespace Core\Facades;

use App\Models\User as UserModel;

class User extends Facades {
    
    public static  function getInstance() {

        return UserModel::class;
    }
}

?>
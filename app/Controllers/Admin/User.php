<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class User extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];
    public function getindex($id = null)
    {
        $um = Model("UserModel");
        $upm = Model("UserPermissionModel");
        if ($id == null) {
            $users = $um->getPermissions();
            return $this->view("/admin/user/index.php", ["users" => $users], true);
        } else {
            $permissions = $upm->getAllPermissions();
            if ($id == "new") {
                return $this->view("/admin/user/user", ["permissions" => $permissions], true);
            }
            $user = $um->getUserById($id);
            if ($user) {
                return $this->view("/admin/user/user", ['user' => $user, 'permissions' => $permissions], true);
            } else {
                $this->error("User ID could not be found in database");
                $this->redirect("/admin/user");
            }
        }
    }
}